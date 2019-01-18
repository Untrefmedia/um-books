<?php

namespace Untrefmedia\UMBooks\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
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
                    'title'          => 'required',
                    'description'    => 'required',
                    'address1'       => 'required_without:address2',
                    'address2'       => 'required_without:address1',
                    'city'           => 'required',
                    'state'          => 'required',
                    'postcode'       => 'required',
                    'country'        => 'required',
                    'url'            => 'required',
                    'phone'          => 'required',
                    'latitude'       => 'numeric',
                    'longitude'      => 'numeric',
                    'capacity_turn'  => 'required|numeric',
                    'capacity_group' => 'required|numeric'
                ];
                break;

            // editar
            case 'PATCH':
                return [
                    'title'          => 'required',
                    'description'    => 'required',
                    'address1'       => 'required_without:address2',
                    'address2'       => 'required_without:address1',
                    'city'           => 'required',
                    'state'          => 'required',
                    'postcode'       => 'required',
                    'country'        => 'required',
                    'url'            => 'required',
                    'phone'          => 'required',
                    'latitude'       => 'numeric',
                    'longitude'      => 'numeric',
                    'capacity_turn'  => 'required|numeric',
                    'capacity_group' => 'required|numeric'
                ];
                break;

            default:
                # code...
                break;
        }

    }

}
