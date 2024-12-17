@extends('layouts.app')

@section('title', 'Bem-vindo à Biblioteca')

@section('content')
    <div class="text-center mt-5">
        <h1 class="display-4">Bem-vindo à Biblioteca Virtual</h1>
        <p class="lead">Aqui você pode cadastrar usuários, livros e consultar a classificação dos livros.</p>

        <!-- Usando o grid do Bootstrap para tornar os cards responsivos -->
        <div class="mt-4 row justify-content-center">
            <!-- Card Cadastrar Usuário -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-usuario" style="width: 100%;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cadastrar Usuário</h5>
                        <p class="card-text">Cadastre novos usuários para a biblioteca.</p>
                        <a href="{{ route('users.create') }}" class="btn btn-cadusuario">Cadastrar</a>
                    </div>
                </div>
            </div>

            <!-- Card Cadastrar Livros -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-livros" style="width: 100%;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cadastrar Livros</h5>
                        <p class="card-text">Cadastre livros na nossa biblioteca virtual.</p>
                        <a href="{{ route('books.create') }}" class="btn btn-cadlivros">Cadastrar</a>
                    </div>
                </div>
            </div>

            <!-- Card Classificação dos Livros -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-class-livros" style="width: 100%;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Classificação dos Livros</h5>
                        <p class="card-text">Veja a classificação dos livros cadastrados.</p>
                        <a href="{{ route('books.index') }}" class="btn btn-classificacao">Ver Classificação</a>
                    </div>
                </div>
            </div>

            <!-- Card Novo Empréstimo -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-emprestimo" style="width: 100%;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Novo Empréstimo</h5>
                        <p class="card-text">Faça seu novo empréstimo de livro aqui, agende a data de devolução.</p>
                        <a href="{{ route('loans.create') }}" class="btn btn-emprestimo">Novo Empréstimo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
