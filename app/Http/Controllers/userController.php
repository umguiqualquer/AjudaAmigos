<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index(){

        //Mostrar a lista
        $user = User::orderBy('id')->get();

        return view('user.index', ['user' => $user]);
    }

    public function create(){
        return view('user.create');
    }

    public function show(User $user){
        return view('user.show', ['user' => $user]);
    }

    public function edit(User $user){
        return view('user.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user){

        $request-> validated();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('user.index')->with('sucess', 'Usuário atualizado com sucesso');

    }

    public function destroy(User $user){
        $user->delete();

        return redirect()->route('user.index')->with('sucess', 'Usuário excluido com sucesso');
    }

    public function store(UserRequest $request){

        $request-> validated();


    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);


    //Redirecionar para página de cadastro
    return redirect()->route('user.index')->with('sucess', 'Usuário cadastro com sucesso');

    }
}
