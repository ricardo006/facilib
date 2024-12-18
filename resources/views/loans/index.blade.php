@extends('layouts.app')

@section('title', 'Empréstimos')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="tool-items d-flex justify-content-between align-items-center">
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
                        <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-primary btn-sm text-white">Ver</a>

                        @if ($loan->status != 'Devolvido' && $loan->status != 'Atrasado')
                            <!-- Botões para atualizar status -->
                            <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Devolvido">
                                <button type="submit" class="btn btn-success btn-sm">Devolvido</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
