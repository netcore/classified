<?php

namespace Modules\Classified\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Netcore\Translator\Helpers\TransHelper;

class StoreParameterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        foreach (TransHelper::getAllLanguages() as $language) {
            $rules['translations.' . $language->iso_code . '.name'] = 'required';
        }

        return $rules;

    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public
    function authorize()
    {
        return true;
    }
}
