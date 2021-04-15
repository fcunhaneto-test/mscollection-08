@extends('layouts.app')

@section('title', $header)

@section('navbar')
    @component('components.navbar-admin', ['media' => $media])@endcomponent
@endsection

@can('isAdmin')
    @section('content')
        <index :header="'{{ $header }}'" :subheader="'{{ $subheader }}'"></index>
    @endsection
@endcan
