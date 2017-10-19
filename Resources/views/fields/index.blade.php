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
                    <table id="data-table" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Is visible?</th>
                            <th>Options</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($fields as $field)
                                <tr class="object{{ $field->id }}">
                                    <td>
                                        <ul>
                                            @foreach($languages as $language)
                                                <li>{{ trans_model($field, $language, 'name') }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $field->is_active ? 'Visible' : 'Not visible' }}</td>
                                    <td>{{ $field->options }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin::classified.fields.edit', $field) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('admin::classified.fields.destroy', $field) }}" data-id="{{ $field->id }}" class="btn btn-danger btn-sm confirm-delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
