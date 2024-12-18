<?php

namespace App\Services;

use App\Models\User;
use App\Models\Book;
use App\Models\Loan;

class BookService
{
    // Verificar se existe empréstimo do livro
    public function isBookLoaned(Book $book)
    {
        return Loan::where("book_id", $book->id)
            ->where("status", ['Em andamento', 'Emprestado'])
            ->exists();
    }
}