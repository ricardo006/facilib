@extends('layouts.app')

@section('title', 'Registrar Empréstimo')

@section('content')

    <div class="tool-items d-flex justify-content-between align-items-center mb-3">
        <div class="text-left">
            <h4>Registrar Empréstimo</h4>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($noAvailableBooks)
        <div class="alert alert-warning">
            Não existe livro disponível para empréstimo.
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuário</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="book_id" class="form-label">Livro</label>
                        <select class="form-control" id="book_id" name="book_id">
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->nome }}</option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="data_devolucao" class="form-label">Data de Devolução</label>
                        <input type="date" class="form-control" id="data_devolucao" name="data_devolucao">
                        @error('data_devolucao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Campo hidden para status -->
                    <input type="hidden" name="status" value="Em andamento">

                    <button type="submit" class="btn btn-primary w-100">Registrar Empréstimo</button>
                </form>
            </div>
        </div>
    @endif
@endsection
