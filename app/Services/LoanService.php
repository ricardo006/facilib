<?php

namespace App\Services;

use App\Models\User;
use App\Models\Book;
use App\Models\Loan;

use Illuminate\Http\Request;

class LoanService
{
    // Verificar se livro já está emprestado 
    public function isBookLoaned($bookId)
    {
        return Loan::where('book_id', $bookId)
        ->whereIn('status', ['Em andamento', 'Emprestado'])    
        ->exists();
    }

    // Registrar um novo empréstimo
    public function createLoan(Request $request)
    {
        $book = Book::find($request->book_id);

        if ($this->isBookLoaned($book->id)) 
            return redirect()->route('loans.create')->with('error', 'Este livro já está emprestado.');
        
        $loan = Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'data_devolucao' => $request->data_devolucao,
            'data_devolucao_real' => null,
            'status' => 'Em andamento',
        ]);

        $book->situacao = 'Emprestado';
        $book->save();

        return $loan;
    }

    // Atualizar status de empréstimo
    public function updateLoanStatus(Request $request, $loan)
    {
        $status = $loan->data_devolucao < now() && $loan->status != 'Devolvido'
            ? 'Atrasado'
            : $request->status;
        
        $loan->update([
            'status' => $status,
            'data_devolucao_real' => $request->status === 'Devolvido' ? now() : null,
        ]);

        // Quando devolvido, atualiza o livro para Disponível
        if ($request->status === 'Devolvido')
            $loan->book->update(['situacao' => 'Disponível']);

        return $loan;
    }
}