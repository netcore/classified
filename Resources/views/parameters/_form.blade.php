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
                        <input class="changable-state" type="checkbox" data-render="switchery"
                               data-column="is_active"
                               data-theme="default" data-id="{{ $attribute->id }}" data-model="ParameterAttribute"
                               data-switchery="true" {{ $attribute->is_active ? 'checked="checked"' : '' }} />
                    </td>
                    <td>
                        <a href="{{ route('admin::classified.parameters.destroy-attribute', $attribute->id) }}" data-id="{{ $attribute->id }}" class="btn btn-danger btn-xs confirm-delete">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@section('scripts')
    <script>
        $.fn.editable.defaults.ajaxOptions = {type: "PUT"};

        $('.x-edit').editable({
            send: 'always',
        });
    </script>
@endsection