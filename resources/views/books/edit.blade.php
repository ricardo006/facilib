@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
    <div class="tool-items d-flex justify-content-between align-items-center mb-3">
        <div class="text-left">
            <h4>Editar Livro</h4>
        </div>
    </div>
    
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $book->nome }}" required>
        </div>
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" value="{{ $book->autor }}" required>
        </div>
        <div class="mb-3">
            <label for="numero_registro" class="form-label">Número de Registro</label>
            <input type="text" class="form-control" id="numero_registro" name="numero_registro" value="{{ $book->numero_registro }}" required>
        </div>
        <div class="mb-3">
            <label for="situacao" class="form-label">Situação</label>
            <select class="form-control" id="situacao" name="situacao" required>
                <option value="Disponível" {{ $book->situacao == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                <option value="Emprestado" {{ $book->situacao == 'Emprestado' ? 'selected' : '' }}>Emprestado
            </select>
        </div>

        <div class="mb-3">
            <label for="genero_id" class="form-label">Gênero</label>
            <select class="form-control" id="genero_id" name="genero_id" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $book->genero_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection