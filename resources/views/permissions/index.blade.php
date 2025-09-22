@extends('layouts.app')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluide background_css">
        
        <h1 class="app-page-title">Liste des permissions</h1>
        <div>
            <div class="justify-content-center">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Liste des Permissions
                            <span style="float: right">
                                <a class="btn btn-primary text-white" href="{{ route('permissions.create') }}">Nouvelle Permission</a>
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
                                    $i = 1
                                @endphp
                                @foreach ($data as $key => $permission)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a class="btn btn-success text-white" href="{{ route('permissions.show',$permission->id) }}">Détails</a>
                                            @can('role-edit')
                                                <a class="btn btn-primary text-white" href="{{ route('permissions.edit',$permission->id) }}">Modifier</a>
                                            @endcan
                                            @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger text-white']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    @php
                                        $i+=1
                                    @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->appends($_GET)->links('layout.paginator') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection