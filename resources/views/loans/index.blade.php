@extends('layouts.app')

@section('title', 'Empréstimos')

@section('content')
    <h1>Empréstimos</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Livro</th>
                <th>Data de Devolução</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->book->nome }}</td>
                    <td>{{ $loan->data_devolucao }}</td>
                    <td>
                        <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-info btn-sm">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
