<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event as FacadesEvent;
use Psy\Readline\Hoa\Event as HoaEvent;
use Symfony\Contracts\EventDispatcher\Event as EventDispatcherEvent;

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

        $imagePath = '';

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $request->image->move(public_path('img/users'), $imageName);
                $imagePath = $imageName;
            }


    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'image' => $imagePath,
    ]);


    //Redirecionar para página de cadastro
    return redirect()->route('user.index')->with('sucess', 'Usuário cadastro com sucesso');

    }

    }

