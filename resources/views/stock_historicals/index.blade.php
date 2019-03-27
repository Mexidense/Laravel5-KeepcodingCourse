@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title ?? 'Stock historicals' }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Value</th>
                                    <th>SMA 6</th>
                                    <th>SMA 70</th>
                                    <th>SMA 200</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockHistorical as $stockHistItem)
                                    <tr>
                                        <th>{{ $stockHistItem->date}}</th>
                                        <th>{{ $stockHistItem->value}}</th>
                                        <th>{{ $stockHistItem->avg_6}}</th>
                                        <th>{{ $stockHistItem->avg_70}}</th>
                                        <th>{{ $stockHistItem->avg_200}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
