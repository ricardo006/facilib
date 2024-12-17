@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="tool-items d-flex justify-content-between align-items-center mb-3">
        <div class="text-left">
            <h4>Gerenciar Usuários</h4>
        </div>
        <div class="text-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar Novo Usuário</a>
        </div>
    </div>

    <!-- Exibir mensagens de sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-users">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Número de Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->numero_cadastro }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection