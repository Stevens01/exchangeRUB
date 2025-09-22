@extends('layouts.app')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-fluide">
           
            <h1 class="app-page-title">Utilisateurs</h1>
            <div>
                <div class="justify-content-center">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            Modifier les informations d'un utilisateur
                            <span style="float: right">
                                <a class="btn btn-primary text-white" href="{{ route('users.index') }}">
                                    Liste des utilisateurs
                                </a>
                            </span>
                        </div>
                        <div class="card-body">
                            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method'=>'PATCH']) !!}
                                <div class="form-group mb-4">
                                    <strong>Nom:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Nom','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group mb-4">
                                    <strong>Adresse mail :</strong>
                                    {!! Form::text('email', null, array('placeholder' => 'Adresse mail','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group mb-4">
                                    <strong>Numéro du Passport :</strong>
                                    {!! Form::text('num_passport', null, array('placeholder' => 'Numéro du Passport','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group mb-4">
                                    <strong>Image du Passport :</strong>
                                    {!! Form::image('img_passport', null, array('placeholder' => 'Image du Passport','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group mb-4">
                                    <strong>Mot de passe:</strong>
                                    {!! Form::password('password', array('placeholder' => 'Mot de passe','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group mb-4">
                                    <strong>Confirmer le mot de passe:</strong>
                                    {!! Form::password('password_confirmation', array('placeholder' => 'Confirmer le mot de passe','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group mb-4">
                                    <strong>Roles:</strong>
                                    {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control pb-5 pt-3','multiple')) !!}
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