<?php

namespace App\Http\Requests;


class WebsitesSearchRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'query' => ['required']
        ];
    }
}
