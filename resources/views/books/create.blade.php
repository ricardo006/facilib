@extends('layouts.app')

@section('title', 'Cadastrar Livro')

@section('content')
    <div class="tool-items d-flex justify-content-between align-items-center mb-3">
        <div class="text-left">
            <h4>Cadastrar Livro</h4>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                    @error('nome')
                        <div class="text-danger">{{ $message }} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor') }}">
                    @error('autor')
                        <div class="text-danger">{{ $message }} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="numero_registro" class="form-label">Número de Registro</label>
                    <input type="text" class="form-control" id="numero_registro" name="numero_registro" value="{{ old('numero_registro') }}">
                    @error('numero_registro')
                        <div class="text-danger">{{ $message }} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="situacao" class="form-label">Situação</label>
                    <select class="form-control" id="situacao" name="situacao">
                        <option value="Disponível">Disponível</option>
                        <option value="Emprestado">Emprestado</option>
                    </select>
                    @error('situacao')
                        <div class="text-danger">{{ $message }} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="genero_id" class="form-label">Gênero</label>
                    <select class="form-control" id="genero_id" name="genero_id">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->nome }}</option>
                        @endforeach
                    </select>
                    @error('situacao')
                        <div class="text-danger">{{ $message }} </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>
@endsection
