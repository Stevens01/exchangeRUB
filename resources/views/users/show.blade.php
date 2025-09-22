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
                            Utilisateur
                                <span style="float: right">
                                    <a class="btn btn-primary text-white" href="{{ route('users.index') }}">Retour</a>
                                </span>
                            
                        </div>
                        <div class="card-body">
                            <div class="item me-3">
                                <div class="item-label"><strong>Nom:</strong></div>
                                <div class="item-data">{{ $user->name }}</div>
                            </div>
                            
                            <div class="item  py-3">
                                <div class="item-label"><strong>Mail:</strong></div>
                                <div class="item-data"> {{ $user->email }}</div>
                            </div>
                                
                             <div class="item  py-3">
                                <div class="item-label"><strong>Numero passport:</strong></div>
                                <div class="item-data"> {{ $user->num_passport }}</div>
                            </div>

                            <div class="item">
                                <div class="item-label"><strong>Rôle:</strong></div>
                                <div class="item-data">{{$user->roles[0]->name}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection