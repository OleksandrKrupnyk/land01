@extends('layouts.site')
@section('title')
 - {{ucfirst($title)}}
@endsection

@section('header')
    @include('site.header')
@endsection

@section('content')
    @include('site.content_page')
@endsection


