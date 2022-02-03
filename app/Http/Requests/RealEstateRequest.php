<?php

namespace App\Http\Requests;

use Jekk0\laravel\Iso3166\Validation\Rules\Iso3166Alpha2;
use Illuminate\Foundation\Http\FormRequest;

class RealEstateRequest extends FormRequest
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
        $bathroomValidation  = '';
        if (
            array_intersect(
                [
                    $this->request->get('real_estate_type')
                ],
                [
                    'house',
                    'department'
                ]
            )
        )
        {
            $bathroomValidation  = 'gt:0';
        }

        $internalNumberValidation  = '';
        if(
            array_intersect(
                [
                    $this->request->get('real_estate_type')
                ],
                [
                    'commercial_ground',
                    'department'
                ]
            )
        )
        {
            $internalNumberValidation  = 'required';
        }

        return [
            'name'              => 'required|max:128',
            'real_estate_type'  => 'required',
            'street'            => 'required|max:128',
            'external_number'   => 'required|regex:/^[-0-9a-zA-Z]+$/|max:12',
            'internal_number'   => "$internalNumberValidation|regex:/^[a-zA-Z0-9- ]+$/",
            'neighborhood'      => 'required|max:128',
            'city'              => 'required|max:64',
            'country'           => ['required', new Iso3166Alpha2()],
            'rooms'             => 'required|max:11',
            'bathrooms'         => "required|max:11|$bathroomValidation",
            'comments'          => 'nullable|max:128',
        ];
    }



}
