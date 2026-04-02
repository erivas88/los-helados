@extends('layouts.app')

@section('title', 'Dashboard - Porto Admin')
@section('page_title', 'Dashboard')

@section('content')
    @include('partials.modules')

    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>
                    <h2 class="panel-title">Welcome back, {{ Auth::user()->name }}!</h2>
                </header>
                <div class="panel-body">
                    <p>This is your professional dashboard populated with the 4 business modules.</p>
                </div>
            </section>
        </div>
    </div>
@endsection
