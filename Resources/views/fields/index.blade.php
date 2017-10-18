@extends('admin::layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Classifieds field list</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Is visible?</th>
                            <th>Attributes</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td>Type</td>
                            <td>Values</td>
                            <td>Action</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
