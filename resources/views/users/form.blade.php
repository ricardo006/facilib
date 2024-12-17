@extends('layouts.app')

@section('title', isset($user) ? 'Editar Usuário' : 'Criar Usuário')

@section('content')
    <h1>{{ isset($user) ? 'Editar Usuário' : 'Criar Usuário' }}</h1>

    <!-- Exibe os erros de validação -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário -->
    <form 
        action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" 
        method="POST">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" id="name" name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', $user->name ?? '') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email', $user->email ?? '') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="numero_cadastro" class="form-label">Número de Cadastro</label>
            <input type="text" id="numero_cadastro" name="numero_cadastro" 
                class="form-control @error('numero_cadastro') is-invalid @enderror" 
                value="{{ old('numero_cadastro', $user->numero_cadastro ?? '') }}">
            @error('numero_cadastro')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($user) ? 'Salvar Alterações' : 'Criar Usuário' }}
        </button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
