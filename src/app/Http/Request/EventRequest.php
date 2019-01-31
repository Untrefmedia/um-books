<?php

namespace Untrefmedia\UMBooks\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
                    'title'      => 'required',
                    'start_date' => 'required',
                    'freq'       => 'required',
                    'byday'      => 'required',
                    'venue_id'   => 'required'
                ];
                break;

            // editar
            case 'PATCH':
                return [
                    'title'      => 'required',
                    'start_date' => 'required',
                    'freq'       => 'required',
                    'byday'      => 'required',
                    'venue_id'   => 'required'
                ];
                break;

            default:
                # code...
                break;
        }

    }

}
