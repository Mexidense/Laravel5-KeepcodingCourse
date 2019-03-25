@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title ?? 'Stocks' }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($stocks as $stock)
                                <li class="list-group-item row">
                                    <div class="col-lg-6 col-xs-6">
                                        {{ $stock->id }} - {{ $stock->name }} - {{ $stock->acronym }}
                                    </div>
                                    <div class="col-lg-6 col-xs-6">

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
