@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ $title ?? 'Edit market' }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <b>Ha ocurrido un error!</b>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class='form-horizontal' action="{{ route('market.edit', $market->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label for="market-name" class="col-md-4 form-control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="market-name" class="form-control"
                                           value="{{ old('name', $market->name) }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="market-description" class="col-md-4 form-control-label">Descripción</label>
                                <div class="col-md-6">
                                    <input type="text" name="description" id="market-description" class="form-control"
                                           value="{{ old('description', $market->description) }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label for="market-active" class="">
                                            <input type="checkbox" {{ old('active', $market->active) === 1 ? 'checked' : '' }}
                                            value="1" name="active" id="market-active"> Activo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
