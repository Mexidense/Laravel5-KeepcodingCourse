@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success">
                            {{ Session::get('status_message') }}
                        </p>
                    @endif
                    <div class="card-header">{{ $title ?? 'Markets' }}</div>
                    <div class="card-body">
                        @foreach ($markets as $market)
                            <div class="row">
                                <div class="col-lg-6 col-xs-6">
                                    {{ $market->name }} - {{ $market->description }} -
                                    {{ $market->active ? 'Activo' : 'Inactivo' }}
                                </div>
                                <div class="col-lg-6 col-xs-6">
                                    <div class="float-right">
                                        <a href="/market/{{ $market->id }}" class="btn btn-info">Ver</a>
                                        <a href="/market/{{ $market->id }}/edit" class="btn btn-warning">Edit</a>
                                        <form class="float-right" method="POST" action="{{ route('market.destroy', [$market->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger" type="submit">Borrar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
