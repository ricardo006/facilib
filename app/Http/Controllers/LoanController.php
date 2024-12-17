<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
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

        $book = Book::find($request->book_id );

        $existingLoan = Loan::where('book_id', $book->id)
            ->where('status', ['Em andamento', 'Emprestado'])
            ->first();
        
        if( $existingLoan )
            return redirect()->route('loans.create')->with('error', 'Este livro já está emprestado');

        $loan = Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'data_devolucao' => $request->data_devolucao,
            'data_devolucao_real' => null, 
            'status' => 'Em andamento',
        ]);

        $book = Book::find($request->book_id);
        $book->situacao = 'Emprestado';
        $book->save();

        return redirect()->route('loans.index')->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Em andamento,Atrasado,Devolvido'
        ]);

        $loan = Loan::where('id', $id)->first();

        $status = $loan->data_devolucao < now() && $loan->status != 'Devolvido' 
            ? 'Atrasado' 
            : $request->status;

        Loan::where('id', $id)->update([
            'status' => $status,
            'data_devolucao_real' => $request->status === 'Devolvido' ? now() : null,
        ]);

        if ($request->status === 'Devolvido') {
            $loan = Loan::where('id', $id)->first();
            $loan->book->update([
                'situacao' => 'Disponível',
            ]);
        }

        return redirect()->back()->with('success', 'Status de empréstimo atualizado com sucesso!');
    }
}
