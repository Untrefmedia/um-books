<?php

namespace Untrefmedia\UMBooks\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            // crear
            case 'POST':
                return [
                    'values' => 'required'
                ];
                break;

            // editar
            case 'PATCH':
                return [
                    'values' => 'required'
                ];
                break;

            default:
                # code...
                break;
        }

    }

}
