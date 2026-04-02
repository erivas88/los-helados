@extends('layouts.app')

@section('title', 'Welcome - Porto Admin')
@section('page_title', 'Welcome Screen')

@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title">Welcome to your new Laravel project!</h2>
            </header>
            <div class="panel-body">
                <p>This project has been initialized with the <strong>Octopus Admin</strong> template.</p>
                <p>You can now start building your application using this professional layout.</p>
                
                <div class="alert alert-info">
                    <strong>Tip:</strong> You can find more UI elements and examples in the <code>octopus</code> directory in your Laragon <code>www</code> folder.
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
