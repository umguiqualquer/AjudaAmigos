@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">

        <div class="card-header hstack gap-2">
            <span>Listar Usuários</span>

            <span class="ms-auto">
                <a href="{{ route('user.generate-pdf') }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-file-pdf"></i>Gerar PDF</a>

                <a href="{{ route('user.create') }}" class="btn btn-success btn-sm">Cadastrar</a>
            </span>
        </div>

        <div class="card-mb-4 border-light shadow">
            <div class="card-header">
                <span>Pesquisar</span>
            </div>
        

        <div class="card-body">
            <form action="{{ route('user.index')}}">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label for="name" class="form-label">Nome</label>
                        <input for="text" name="name" class="form-control" id="name" value="{{ request('name')}}" placeholder="Nome do usuário">
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input for="text" name="email" class="form-control" id="email" value="{{ request('email')}}" placeholder="E-mail do usuário">
                    </div>

                    <div class="col-md-4 col-sm-12 mt-4 pt-3">
                        <button type="submit" class="btn btn-info btn-sn">Pesquisar</button>
                        <a href="{{route('user.index')}}" class="btn btn-warning btn-sm">Limpar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


        <div class="card-body">

            <x-alert />

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Perfil</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @forelse ($user->getRoleNames() as $role)
                            @empty
                            @endforelse
                            <td>{{$role}}</td>

                            <td class="text-center">


                            @can('show-user')
                                <a href="{{ route('user.show', ['user' => $user->id]) }}"
                                    class="btn btn-primary btn-sm">Visualizar</a>
                            @endcan
                            @can('edit-user')
                                <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                    class="btn btn-warning btn-sm">Editar</a>
                            @endcan
                                @can('destroy-user')
                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm me-1"
                                            onclick="confirmDelete({{ $user->id }})">Apagar</button>
                                </form>
                            @endcan

                            
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
