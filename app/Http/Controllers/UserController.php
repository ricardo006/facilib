<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'numero_cadastro.required' => 'O campo número cadastro é obrigatório.',
        ];

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'numero_cadastro'   => 'required|unique:users',
        ], $messages);

        $user = User::create($request->all());

        return redirect()->route('users.index')->with('success','Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'numero_cadastro.required' => 'O campo número cadastro é obrigatório.',
        ];

        $validatedData = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'numero_cadastro'   => 'required|unique:users,numero_cadastro,' . $user->id,
        ], $messages);

        $user ->update($validatedData);
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $hasActiveLoans = $user->loans()->whereIn('status', ['Em andamento', 'Emprestado'])->exists();
        
        if ($hasActiveLoans) 
            return redirect()->route('users.index')->with('error', 'Não é possível excluir o usuário enquanto houver livros emprestados com status "Em andamento" ou "Emprestado".');

        $user = User::find($user->id);
        $user->delete();
        
        // Exibir mensagem
        return redirect()->route('users.index')->with('success','Usuário excluído com sucesso!');
    }
}
