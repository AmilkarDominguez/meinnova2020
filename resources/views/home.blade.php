@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="container">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <center><h1>¡Bienvenido {{ auth()->user()->name }}!</h1></center>
                        </div>      
                    </div>
                </div>
        </div>
</div>
@endsection
