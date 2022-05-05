<?php

namespace App\Http\Requests\Duel;

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
            'id_first' => 'integer',
            'id_second' => 'integer',
            'score_first' => 'integer',
            'score_second' => 'integer',
            'index_duel' => ['integer','nullable']
        ];
    }
}
