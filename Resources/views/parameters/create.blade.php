@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Add new parameter</h4>
        </div>

        <div class="panel-body">
            @include('admin::_partials._messages')
            {{ Form::open(['route' => ['admin::classified.parameters.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}

            @include('translate::_partials._nav_tabs')
            @include('classified::parameters._form')

            <div class="panel-footer text-right">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection