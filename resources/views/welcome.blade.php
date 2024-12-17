@extends('layouts.app')

@section('title', 'Bem-vindo à Biblioteca')

@section('content')
    <div class="text-center mt-5">
        <h1 class="display-4">Bem-vindo à Biblioteca Virtual</h1>
        <p class="lead">Aqui você pode cadastrar usuários, livros e consultar a classificação dos livros.</p>

        <!-- Links para navegação -->
        <div class="mt-4">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Cadastrar Usuário</a>
            <a href="{{ route('books.create') }}" class="btn btn-success">Cadastrar Livros</a>
            <a href="{{ route('books.index') }}" class="btn btn-warning">Classificação dos Livros</a>
            <a href="{{ route('loans.create') }}" class="btn btn-danger">Novo Empréstimo</a>
        </div>
    </div>
@endsection
