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
                            <p>{{$market->name}} -- {{$market->description}} -- {{$market->active}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
