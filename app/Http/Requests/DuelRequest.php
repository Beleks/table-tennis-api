<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DuelRequest extends FormRequest
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
        return [
            'id_first' => '',
            'id_second' => '',
            'score_first' => '',
            'score_second' => '',
            'raiting_first' => '',
            'raiting_second' => '',
        ];
    }
}
