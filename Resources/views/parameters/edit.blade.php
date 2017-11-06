@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Parameter settings</h4>
        </div>

        <div class="panel-body">
            @include('admin::_partials._messages')
            {{ Form::model($parameter, ['route' => ['admin::classified.parameters.update', $parameter->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}

            @include('translate::_partials._nav_tabs')
            @include('classified::parameters._form')

            <hr>
            @if($attachCategories)
            <div class="form-group">
                <label class="col-md-2 control-label">Categories</label>
                <div class="col-md-8">
                    <select class="js-categories-input" name="categories[]" data-placeholder="Add categories" multiple>
                        @foreach($categories as $category)
                                <option class="l1" value="{{ $category->id }}" @if($parameter->categories->where('id', $category->id)->first()) selected @endif>{{ $category->name }}</option>
                                @foreach($category->children as $child)
                                    <option class="l2" value="{{ $child->id }}" @if($parameter->categories->where('id', $child->id)->first()) selected @endif>{{ $child->name }}</option>
                                @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            @endif

            <div class="panel-footer text-right">
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#createAttributeModal">
                    <i class="fa fa-plus"></i> Add attribute
                </button>
            </div>
            <h4 class="panel-title">Attributes</h4>
        </div>

        <div class="panel-body">

            <table class="table table-striped table-bordered" style="width: 100%;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Is Visible?</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($parameter->attributes as $attribute)
                    <tr class="object-{{ $attribute->id }}">
                        <td>
                            <ul class="list-unstyled">
                                @foreach(\Netcore\Translator\Models\Language::all() as $language)
                                    <li>
                                        <b>{{ strtoupper($language->iso_code) }}:</b>&nbsp;
                                        <a href="#"
                                           data-name="name:{{ $language->iso_code }}"
                                           data-title="Attribute name {{ strtoupper($language->iso_code) }}"
                                           data-type="text"
                                           data-url="{{ route('admin::classified.parameters.update-attributes', $parameter->id) }}"
                                           class="x-edit"
                                           data-pk="{{ $attribute->id }}"
                                        >
                                            {{ object_get($attribute->translate($language->iso_code), 'name') }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <input class="changeable-state" type="checkbox" data-render="switchery"
                                   data-column="is_active"
                                   data-theme="default" data-id="{{ $attribute->id }}" data-model="\Modules\Classified\Models\ParameterAttribute"
                                   data-switchery="true" {{ $attribute->is_active ? 'checked="checked"' : '' }} />
                        </td>
                        <td>
                            <a href="{{ route('admin::classified.parameters.destroy-attribute', $attribute->id) }}"
                               data-id="{{ $attribute->id }}" class="btn btn-danger btn-xs confirm-delete">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('classified::_partials.create-attribute-modal')
@endsection

@section('scripts')
    <script>
        $.fn.editable.defaults.ajaxOptions = {type: "PUT"};

        $('.x-edit').editable({
            send: 'always',
        });

        var categorySelect = $('.js-categories-input');
        categorySelect.select2({
            templateResult: function (data) {
                // We only really care if there is an element to pull classes from
                if (!data.element) {
                    return data.text;
                }

                var $element = $(data.element);

                var $wrapper = $('<span></span>');
                $wrapper.addClass($element[0].className);

                $wrapper.text(data.text);

                return $wrapper;
            }
        });
    </script>
@endsection

@section('styles')
    <style>
        .l1 {
            font-weight: bold;
        }
        .l2 {
            padding-left: 1em;
        }
    </style>
@endsection