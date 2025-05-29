<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event as FacadesEvent;
use Psy\Readline\Hoa\Event as HoaEvent;
use Symfony\Contracts\EventDispatcher\Event as EventDispatcherEvent;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;

class userController extends Controller
{
    public function index(Request $request){

        // //Mostrar a lista
        // $user = User::orderBy('id')->get();

        // return view('user.index', ['user' => $user]);


        //Para pesquisar nome ou email da pessoa na lista

        $users = User::when($request->has('name'),function ($whenQuery) use ($request){
        $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })

        ->when($request->has('email'), function ($whenQuery) use ($request) {
            $whenQuery->where('email', 'like', '%' . $request->email . '%');
        })

        ->orderBy('id')
        ->paginate(10)
        ->withQueryString();

        return view('user.index', [
            'menu'=> 'users',
            'users' => $users,
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

    public function painel(){
        return view('dashboard.index');
    }






    public function create(){
        $roles = Role::pluck('name')->all();
        return view('user.create', ['menu' => 'users', 'roles' => $roles]);
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



        if ($request->filled('roles')) {
            $user->syncRoles([$request->roles]);
        }



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


    public function generatePdf(){


        //$users = User::where('id', 100)->orderByDesc('id')->get();
        $users = User::orderBy('id')->get();

        $pdf = PDF::loadView('user.generatePdf', ['users' => $users])->setPaper('a4', 'portrait');

        return $pdf->download('list_users.pdf');

    }

}