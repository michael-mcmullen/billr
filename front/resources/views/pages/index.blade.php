@extends('layouts.master')

@section('carousel')
    @include('pages.sections.carousel')
@stop

@section('content')
    @include('pages.sections.features')
    @include('pages.sections.pricing')
    @include('pages.sections.tour')
@stop