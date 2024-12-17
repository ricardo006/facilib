@extends('layouts.app')

@section('title', 'Registrar Empréstimo')

@section('content')

    <div class="tool-items d-flex justify-content-between align-items-center mb-3">
        <div class="text-left">
            <h4>Registrar Empréstimo</h4>
        </div>
    </div>
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if($noAvailableBooks)
        <div class="alert alert-warning">
            Não existe livro disponível para empréstimo.
        </div>
    @else
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Usuário</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book_id" class="form-label">Livro</label>
                <select class="form-control" id="book_id" name="book_id" required>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="data_devolucao" class="form-label">Data de Devolução</label>
                <input type="date" class="form-control" id="data_devolucao" name="data_devolucao" required>
            </div>
            
            <!-- Campo hidden para status -->
            <input type="hidden" name="status" value="Em andamento">
            
            <button type="submit" class="btn btn-primary">Registrar Empréstimo</button>
        </form>
    @endif
@endsection
