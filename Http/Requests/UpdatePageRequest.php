<?php

namespace Modules\Page\Http\Requests;

//use Modules\Core\Internationalisation\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
class UpdatePageRequest extends FormRequest
{


    public function rules()
    {
        return [
          'TITLE' => 'required',
          'BODY' => 'required',
            'TEMPLATE' => 'required',
        ];
    }


    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'template.required' => trans('page::messages.template is required'),
            'is_home.unique' => trans('page::messages.only one homepage allowed'),
        ];
    }


}
