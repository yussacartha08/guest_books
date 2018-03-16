@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="display: flow-root;">
                    List of Guest Books
                    <a class="btn btn-success pull-right" href="{{ route('guests.create') }}">Add New Guest</a>
                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Guest Name</th>
                                <th scope="col">Guest Email</th>
                                <th scope="col">Guest Content</th>
                                <th scope="col">Created At</th>
                                <!-- <th scope="col">updated At</th> -->
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 0)
                            @foreach($guests as $guest)
                                @php ($i++)
                                <tr>
                                    <th scope="row">{{($i+$start)}}</th>
                                    <td><a href="/guests/{{$guest->id}}">{{$guest->name}}</a></td>
                                    <td>{{$guest->email}}</td>
                                    <td>{{$guest->content}}</td>
                                    <td>{{$guest->created_at->toFormattedDateString()}}</td>
                                    <!-- <td>{{$guest->updated_at->toFormattedDateString()}}</td> -->
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example" style="display: flex;">
                                            <a href="{{ URL::to('guests/' . $guest->id . '/edit') }}">
                                                <button type="button" class="btn btn-warning" style="width: 70px;">Edit</button>
                                            </a>&nbsp;
                                            <a class="remove-record" data-toggle="modal" data-url="{{url('guests', [$guest->id])}}" data-id="{{$guest->id}}" data-target="#custom-width-modal">
                                                <button type="button" class="btn btn-danger" style="width: 70px;">Delete</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($guests) == 0)
                                <tr>
                                    <td colspan="7" align="center"><b>** Data not found **</b></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-end">
                            {{$guests->links('vendor.pagination.bootstrap-4')}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete Model -->
<form action="" method="POST" class="remove-record-model">
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Record</h4>
                </div>
                <div class="modal-body">
                    <h4>Are you sure Delete this record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection