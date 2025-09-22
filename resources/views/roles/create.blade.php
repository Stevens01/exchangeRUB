@extends('layouts.app')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-fluide">
            <h1 class="app-page-title">Ajouter un rôle</h1>
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
                            Créer un rôle
                            <span style="float: right">
                                <a class="btn btn-primary text-white" href="{{ route('roles.index') }}">Liste des rôles</a>
                            </span>
                        </div>
                        <div class="card-body">
                            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                                <div class="form-group mb-4">
                                    <strong>Intitulé:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Intitulé','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group mb-4">
                                    <strong>Permissions:</strong>
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
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