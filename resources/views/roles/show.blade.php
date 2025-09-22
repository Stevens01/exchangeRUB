@extends('layouts.app')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluide">
        
        <h1 class="app-page-title">Informations détaillées</h1>
        <div>
            <div class="justify-content-center">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Rôle
                        
                            <span style="float: right">
                                <a class="btn btn-primary text-white" href="{{ route('roles.index') }}">Retour</a>
                            </span>
                        
                    </div>
                    <div class="card-body">
                        <div class="lead">
                            <strong>Titre : </strong>
                            {{ $role->name }}
                        </div>
                        <div class="lead">
                            <strong>Permissions:</strong>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $permission)
                                    <label class="badge badge-success">{{ $permission->name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection