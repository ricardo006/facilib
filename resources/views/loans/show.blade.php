@extends('layouts.app')

@section('title', 'Detalhes do Empréstimo')

@section('content')

    <div class="tool-items d-flex justify-content-between align-items-center">
        <div class="text-left">
            <h4>Detalhes do Empréstimo</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h5>Informações do Usuário</h5>
                <p><strong>Nome:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>

            <div class="mb-3">
                <h5>Informações do Livro Emprestado</h5>
                <p>{{ $loan->book->nome }}</p>
                <p><strong>Status do Empréstimo:</strong> {{ $loan->status }}</p>
                <p><strong>Data de Empréstimo:</strong> {{ $loan->created_at }}</p>
                <p><strong>Data de Devolução:</strong> {{ $loan->data_devolucao }}</p>
            </div>
        </div>
    </div>

@endsection
