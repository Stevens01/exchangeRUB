@extends('layouts.app')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluide background_css">
        <style>
            .background_css {
                background: url("http://127.0.0.1:8000/images/images/disaster/explosion.webp") no-repeat center center fixed;
                background-size: cover; 
                background-repeat: no-repeat;
                top: 0;
                left: 0;
                width: 100%;
                padding: 20px;
            }
    
            .card {
                background: rgba(255, 255, 255, 0.9);
                padding: 80px;
                margin-left: 15%;
                border-radius: 10px;
                box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
                
            }
        </style>
        <h1 class="app-page-title">Modifier un rôle</h1>
        <div>
            <div class="justify-content-center">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Opps!</strong> Informations mal renseignées<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Modifier un rôle
                        <span style="float: right">
                            <a class="btn btn-primary text-white" href="{{ route('roles.index') }}">Liste des rôles</a>
                        </span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($role, ['route' => ['roles.update', $role->id],'method' => 'PATCH']) !!}
                            <div class="form-group mb-4">
                                <strong>Titre</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Titre','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group mb-4">
                                <strong>Permissions:</strong>
                                <br/>
                                @foreach($permission as $value)
                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary text-white">Soumettre</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection