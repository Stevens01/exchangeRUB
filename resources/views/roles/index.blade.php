@extends('layouts.app')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluide">
       
        <h1 class="app-page-title">Liste des rôles</h1>
        <div>
            <div class="justify-content-center">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Rôles
                            <span style="float: right">
                                <a class="btn btn-primary text-white" href="{{ route('roles.create') }}">Nouveau rôle</a>
                            </span>
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Titre</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($data as $key => $role)
                                    <tr>
                                        <td>{{ $i}}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a class="btn btn-success text-white" href="{{ route('roles.show',$role->id) }}">Détails</a>
                                            
                                                <a class="btn btn-primary text-white" href="{{ route('roles.edit',$role->id) }}">Modifier</a>
                                            
                                           
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger text-white']) !!}
                                                {!! Form::close() !!}
                                          
                                        </td>
                                    </tr>
                                    @php
                                        $i+=1
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection