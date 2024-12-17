<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view("books.index", compact("books"));
    }

    public function create()
    {
        $genres = Genre::all();
        return view("books.create", compact("genres"));
    }

    public function store(Request $request)
    {
        $messages = [
            'nome.required' => 'Por favor, informe o nome do livro.',
            'autor.required' => 'O campo autor é obrigatório.',
            'numero_registro.required' => 'O número de registro não pode ficar vazio.',
            'numero_registro.unique' => 'Este número de registro já está cadastrado.',
            'situacao.required' => 'Selecione a situação do livro.',
            'genero_id.required' => 'É necessário escolher um gênero.',
            'genero_id.exists' => 'O gênero selecionado é inválido.',
        ];
        
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'numero_registro' => 'required|string|max:255',
            'situacao' => 'required|string',
            'genero_id' => 'required|exists:genres,id',
        ], $messages);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success','Livro cadastrado com sucesso!');
    }

    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('books.edit', compact('book','genres'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'nome'=> 'required',
            'autor'=> 'required',
            'numero_registro' => 'required|unique:books,numero_registro,' . $book->id,
            'situacao' => 'required',
            'genero_id' => 'required|exists:genres,id',
        ]);

        $book ->update($request->all());
        return redirect()->route('books.index')->with('success','Livro atualizado com sucesso!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success','');
    }
}


