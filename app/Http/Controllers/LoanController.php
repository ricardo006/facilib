<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    protected $loanService;

    // Injetando LoanService
    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        $loans = Loan::with(['user', 'book'])->get();
        return view("loans.index", compact("loans"));
    }

    public function create()
    {
        $users = User::all();
        $books = Book::where('situacao', 'Disponível')->get();

        $noAvailableBooks = $books->isEmpty();

        return view('loans.create', compact('users','books', 'noAvailableBooks'));
    }

    public function show(Loan $loan)
    {
        $user = User::find($loan->user_id);
        return view('loans.show', compact('loan','user'));
    }

    public function store(Request $request)
    {
        $messages = [
            'data_devolucao.after_or_equal' => 'A data de devolução não pode ser anterior à data atual.',
            'status.in' => 'O status fornecido é inválido. Use "Em andamento", "Atrasado" ou "Devolvido".',
            'user_id.required' => 'O usuário é obrigatório.',
            'book_id.required' => 'O livro é obrigatório.',
            'data_devolucao.required' => 'A data de devolução é obrigatória.',
            'data_devolucao.date' => 'A data de devolução deve ser uma data válida.',
            'data_devolucao.date_format' => 'A data de devolução deve estar no formato YYYY-MM-DD.',
            'user_id.exists' => 'O usuário selecionado não existe.',
            'book_id.exists' => 'O livro selecionado não existe.',
        ];

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'data_devolucao' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'status' => 'required|in:Em andamento,Atrasado,Devolvido',
        ], $messages);

        $loan = $this->loanService->createLoan($request);

        return redirect()->route('loans.index')->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Em andamento,Atrasado,Devolvido'
        ]);

        $loan = Loan::where('id', $id)->first();

        $loan->loanService->updateLoanStatus($request, $loan);

        return redirect()->back()->with('success', 'Status de empréstimo atualizado com sucesso!');
    }
}
