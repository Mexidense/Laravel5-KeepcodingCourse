@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title ?? 'Stocks' }}</div>
                    @if (Session::has('status_message'))
                        <p class="alert alert-success">{{ Session::get('status_message') }}</p>
                    @endif
                    @if (Session::has('error_message'))
                        <p class="alert alert-warning">{{ Session::get('error_message') }}</p>
                    @endif
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($stocks as $stock)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-6">
                                            {{ $stock->id }} - {{ $stock->name }} - {{ $stock->acronym }}
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="float-right">
                                                <div class="btn-group">
                                                    @if (Auth::check())
                                                        @if (in_array($stock->id, $user_stocks))
                                                            <form method="post" action="{{ route('user_stocks.destroy') }}">
                                                                {{ csrf_field() }}
                                                                {{ method_field('delete') }}
                                                                <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                                                <button type="submit" class="btn btn-danger">Unsubscribe</button>
                                                            </form>
                                                        @else
                                                            <form method="post" action="{{ route('user_stocks.store') }}">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                                                <button type="submit" class="btn btn-primary">Subscribe</button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="btn-group">
                                                    <a href="/stock_historical/{{ $stock->id }}" class="btn btn-success">View graph</a>
                                                </div>
                                            </div>
                                        </div>
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
