@extends('adminlte::page')

@section("title_prefix", "Início")
@section("title")
@section("title_posfix")

@section('content_header')
    <h1 class="m-0 text-dark">início</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
@stop

@include('member.footer')
