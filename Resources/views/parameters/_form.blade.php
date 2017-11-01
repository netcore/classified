<div class="tab-content">
    @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)
        <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active' : '' }}" id="{{ $language->iso_code }}">

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-md-2 control-label">Title</label>
                <div class="col-md-8">
                    {!! Form::text('translations['.$language->iso_code.'][name]', trans_model((isset($parameter) ? $parameter : null), $language, 'name'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
