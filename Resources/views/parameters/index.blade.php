@extends('admin::layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Classifieds field list
                        <div class="pull-right">
                            <a href="{{ route('admin::classified.parameters.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add field</a>
                        </div>
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Attributes</th>
                            <th>Categories</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($parameters as $parameter)
                                <tr class="object{{ $parameter->id }}">
                                    <td>
                                        <ul>
                                            @foreach($languages as $language)
                                                <li><b>{{ strtoupper($language->iso_code) }}</b>: {{ trans_model($parameter, $language, 'name') }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @php
                                                $enLanguage = $languages->where('iso_code', 'en')->first();
                                            @endphp
                                            @foreach($parameter->attributes as $attribute)
                                                <li>{{ trans_model($attribute, $enLanguage, 'name') }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @php
                                            $enLanguage = $languages->where('iso_code', 'en')->first();
                                        @endphp
                                        @foreach($parameter->categories as $category)
                                            <li>{{ trans_model($category, $enLanguage, 'name') }}</li>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin::classified.parameters.edit', $parameter) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a
                                                class="btn btn-sm btn-danger confirm-action"
                                                data-title="Confirm action?"
                                                data-text="Parameter will be deleted. Are you sure?"
                                                data-confirm-button-text="Delete"
                                                data-method="DELETE"
                                                data-href="{{ route('admin::classified.parameters.destroy', $parameter) }}"
                                                data-success-title="Action completed"
                                                data-success-text="Parameter successfully deleted!"
                                                data-refresh-page-on-success="true"
                                        >
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
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
