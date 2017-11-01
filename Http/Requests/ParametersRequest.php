<?php

namespace Modules\Classified\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Netcore\Translator\Helpers\TransHelper;
use Netcore\Translator\Models\Language;

class ParametersRequest extends FormRequest
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
     * @return array
     */
    public function messages()
    {
        $messages = [];

        foreach (TransHelper::getAllLanguages() as $language) {
            $messages['translations.' . $language->iso_code . '.name.required'] = 'Name field is required for language: ' . $language->title_localized;
        }

        return $messages;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
