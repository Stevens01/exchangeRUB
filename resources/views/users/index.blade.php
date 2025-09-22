@extends('layouts.app')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-fluide ">
            <h1 class="app-page-title">Utilisateurs</h1>
            <div>
                <div class="justify-content-center">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div>
                    @endif

                    @if (\Session::has('warning'))
                        <div class="alert alert-warning">
                            <p>{{ \Session::get('warning') }}</p>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            Liste des utilisateurs
                            <span style="float: right;">
                                <a class="btn btn-primary text-white" href="{{ route('users.create') }}">Nouvel utilisateur</a>
                            </span>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th> User </th>
                                        <th> Nom </th>
                                        <th> Adresse mail </th>
                                        <th> num_passport </th>
                                        <th> Rôles </th>
                                        <th> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $user)
                                            <tr>
                                                <td class="py-1">
                                                <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> </td>
                                                <td> {{ $user->name }} </td>
                                                <td> {{ $user->email }} </td>
                                                <td> {{ $user->num_passport }} </td>
                                                <td> 
                                                    @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $val)
                                                            <label class="badge badge-dark">{{ $val }}</label>
                                                        @endforeach
                                                    @endif 
                                                </td>
                                                <td>
                                                    <a class="btn btn-success text-white" href="{{ route('users.show',$user->id) }}">Détails</a>
                                                    
                                                    <a class="btn btn-primary text-white" href="{{ route('users.edit',$user->id) }}">Modifier</a>
                                                   
                                                    
                                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger text-white']) !!}
                                                    {!! Form::close() !!}
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              </div>
                                {{ $data->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection