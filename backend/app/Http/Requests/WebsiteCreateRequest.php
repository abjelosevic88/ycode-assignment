<?php

namespace App\Http\Requests;

class WebsiteCreateRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'url'  => [
                'required',
                'unique:websites,url',
                'regex:/^((http|https)?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
            ]
        ];
    }
}
