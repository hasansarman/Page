<?php

namespace Modules\Page\Http\Requests;

//use Modules\Core\Internationalisation\BaseFormRequest;
//use Modules\Core\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
class CreatePageRequest extends FormRequest
{
  //  protected $translationsAttributesKey = 'page::pages.validation.attributes';

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
