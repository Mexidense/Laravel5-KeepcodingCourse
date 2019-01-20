@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('market.create') }}" method="post">
            {{ csrf_field() }}
            <div class="input">
                Name:
                <input type="text" name="name" id="market-name">
            </div>
            <div class="input">
                Description:
                <input type="text" name="description" id="market-description">
            </div>
            <div class="input">
                <input type="checkbox" name="active" id="market-active">
            </div>
            <div class="input">
                <button type="submit">Send</button>
            </div>
        </form>
    </div>
@endsection
