@extends('layouts.app')

@section('content')
    <a href="{{ public_path(session('path')) }}"></a>
@endsection