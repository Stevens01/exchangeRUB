@extends('layouts.app')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluide ">
        <h1 class="app-page-title">Ajouter une permission</h1>
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
                        Ajouter une permission
                        <span style="float: right">
                            <a class="btn btn-primary text-white" href="{{ route('permissions.index') }}">Liste des permissions</a>
                        </span>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
                            <div class="form-group">
                                <strong>Titre:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Titre','class' => 'form-control')) !!}
                            </div>
                            <button type="submit" class="btn btn-primary text-white mt-3">Soumettre</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection