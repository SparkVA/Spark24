@extends('spark24::layouts.frontend')

@section('title', 'Spark24')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {{ config('spark24.name') }}
    </p>
@endsection
