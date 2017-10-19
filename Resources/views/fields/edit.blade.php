@extends('admin::layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Classifieds field list
                        <div class="pull-right">
                            <a href="{{ route('admin::classified.fields.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add field</a>
                        </div>
                    </h4>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
@endsection