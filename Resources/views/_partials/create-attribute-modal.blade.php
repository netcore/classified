<div class="modal fade" id="createAttributeModal">
    <div class="modal-dialog">
        <form class="modal-content js-form-submit" id="createAttributeForm" action="{{ route('admin::classified.parameters.store-attributes', $parameter) }}" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add attribute</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger hidden"></div>
                <div class="alert alert-success hidden"></div>

                {!! csrf_field() !!}
                @include('translate::_partials._nav_tabs', ['idPrefix' => 'attr-'])

                <div class="tab-content">
                    @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)
                        <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active' : '' }}" id="attr-{{ $language->iso_code }}">

                            <div class="form-group">
                                <label for="name-{{ $language->iso_code }}">Name - {{ $language->title_localized }}:</label>
                                <input type="text" id="name-{{ $language->iso_code }}" name="translations[{{ $language->iso_code }}][name]" class="form-control">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-success" type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i>">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>