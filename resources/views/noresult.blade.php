@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-1 col-10">
                <h2 style="text-align: center;">MY FRIDGE LIST</h2>
                <div class="row">
                    <div class="col-4">
                        <button onclick="window.location.href='/index'" class="btn btn-primary btn-style">Back</button>
                    </div>
                    <div class="offset-4 col-4">
                        @include('components.search')
                    </div>
                </div>
                <p class="no-result">No result for your search query.</p>
            </div>
        </div>
    </div>
@stop
