@extends('layouts.app')

@section('title', 'Livros')

@section('content')
    @foreach (['success', 'error'] as $msg)
        @if(session($msg))
            <div class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    <div class="tool-items d-flex justify-content-between align-items-center">
        <div class="text-left">
            <h4>Livros</h4>
        </div>
        <div class="text-right">
            <a href="{{ route('books.create') }}" class="btn btn-addlivro mb-3">Adicionar Livro</a>
        </div>
    </div>

    <table class="table table-books">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Autor</th>
                <th>Número de Registro</th>
                <th>Situação</th>
                <th>Gênero</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->nome }}</td>
                    <td>{{ $book->autor }}</td>
                    <td>{{ $book->numero_registro }}</td>
                    <td>{{ $book->situacao }}</td>
                    <td>{{ $book->genre->nome }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-edit btn-sm">Editar</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-excluir btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
