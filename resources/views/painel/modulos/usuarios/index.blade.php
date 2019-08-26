<!-- dashboard.blade.php -->
@extends('painel.templates.dashboard')

@section('content')	

<div class="title-pg">
    <h1 class="title-pg">Listagem dos Usuários</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
        <form class="form form-inline">
            <input type="text" name="nome" placeholder="Nome:" class="form-control">
            <input type="text" name="email" placeholder="E-mail:" class="form-control">

            <button class="btn btn-search">Pesquisar</button>
        </form>
    </div>

    <div class="class-btn-insert">
        <a href="{{route('usuarios.create')}}" class="btn-insert">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>
    
    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Biografia</th>
            <th width="150">Ações</th>
        </tr>

        @forelse ($users as $user)
            <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->biography }}</td>
            <td>
                <a href="{{route('usuarios.show', $user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                <a href="{{route('usuarios.edit', $user->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>

            </td>
            </tr>
        @empty
            <tr>
                <td>Nenhum registro encontrado!!</td>
            </tr>
        @endforelse

    </table>

    {{$users->links()}}

   

</div><!--Content Dinâmico-->
@endsection


