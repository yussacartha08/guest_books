@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="display: flow-root;">
                    Showing Guest {{ $guest->name }}
                    <a class="btn btn-primary pull-right" href="{{ route('guests.index') }}">Back</a>
                </div>
                <div class="panel-body">
                    <div class="jumbotron text-center">
                        <p>
                            <strong>Guest Name:</strong> {{ $guest->name }}<br>
                            <strong>Guest Email:</strong> {{ $guest->email }}<br>
                            <strong>Content:</strong> {{ $guest->content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection