<?php

namespace App\Http\Requests;

class WebsitesGetRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit'  => ['integer'],
            'offset' => ['integer']
        ];
    }
}
