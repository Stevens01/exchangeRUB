@extends('layouts.app')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluide ">
        
        <h1 class="app-page-title">Infomations détaillées</h1>
        <div> 
            <div class="justify-content-center">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Permission
                            <span style="float: right">
                                <a class="btn btn-primary text-white" href="{{ route('permissions.index') }}">Retour</a>
                            </span>
                        
                    </div>
                    <div class="card-body">
                        <div class="lead">
                            <strong>Titre:</strong>
                            {{ $permission->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection