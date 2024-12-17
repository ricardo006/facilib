@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
    <div class="tool-items d-flex justify-content-between align-items-center mb-3">
        <div class="text-left">
            <h4>Editar Livro</h4>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $book->nome) }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor', $book->autor) }}">
                    @error('autor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="numero_registro" class="form-label">Número de Registro</label>
                    <input type="text" class="form-control @error('numero_registro') is-invalid @enderror" id="numero_registro" name="numero_registro" value="{{ old('numero_registro', $book->numero_registro) }}">
                    @error('numero_registro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="situacao" class="form-label">Situação</label>
                    <select class="form-control @error('situacao') is-invalid @enderror" id="situacao" name="situacao">
                        <option value="Disponível" {{ old('situacao', $book->situacao) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                    </select>
                    @error('situacao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="genero_id" class="form-label">Gênero</label>
                    <select class="form-control @error('genero_id') is-invalid @enderror" id="genero_id" name="genero_id">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genero_id', $book->genero_id) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('genero_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>
@endsection
