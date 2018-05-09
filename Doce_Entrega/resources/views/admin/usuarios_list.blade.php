@extends('adminlte::page')
@section('title', 'Cadastro de Usuarios')

@section('content_header')

<div class='col-lg-11'>
    <h2> Lista de Usuários </h2>
</div>
<div class='col-sm-1'>
    <a href='#' class='btn btn-primary'
    role='button'> Novo </a>
</div>

    <table class="table table-hover " >
        <thead>
            <tr>
                <th class="col-sm-5">Nome</th>
                <th class="col-sm-5">Email</th>
                <th class="col-sm-5">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $u)
            <tr>
                <td> {{$u->nome}} </td>
                <td> {{$u->email}} </td>
                
              
                <td> <a href='#'
                        class='btn btn-info' 
                        role='button'> Alterar </a>
                     <form style="display: inline-block"
                           method="post"
                           action="{{route('usuarios.destroy', $u->id)}}"
                           onsubmit="return confirm('Confirma Exclusão?')">
                           {{ method_field('delete') }}
                           {{ csrf_field() }}
                           <button type="submit"
                                   class="btn btn-danger"> Excluir </button>
                                   
                     </form>  
                </td>
              
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection