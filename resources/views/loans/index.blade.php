@extends('layouts.app')

@section('title', 'Empréstimos')

@section('content')
    <div class="tool-items d-flex justify-content-between align-items-center mb-3">
        <div class="text-left">
            <h4>Empréstimos</h4>
        </div>
        <div class="text-right">
            <a href="{{ route('loans.create') }}" class="btn btn-primary">Novo Empréstimo</a>
        </div>
    </div>
    
    <table class="table table-emprestimos">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Livro</th>
                <th>Data de Devolução</th>
                <th>Status</th>
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
                        <span class="badge 
                            @if ($loan->status == 'Devolvido') bg-success 
                            @elseif ($loan->status == 'Atrasado') bg-danger 
                            @else bg-warning 
                            @endif">
                            {{ $loan->status }}
                        </span>
                    </td>
                    <td>
                        <!-- Botões para atualizar status -->
                        <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Devolvido">
                            <button type="submit" class="btn btn-success btn-sm">Devolvido</button>
                        </form>
                        <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-info btn-sm">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
