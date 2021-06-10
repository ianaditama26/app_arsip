<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReqNonSptController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'npwp' => 'required|min:15|max:15',
            'namaNpwp' => 'required',
            'alamat' => 'required',
            'jenis_dokumen' => 'required',
            'no_dokumen' => 'required',
            'noUrut' => 'required',
            'noLemari' => 'required',
            'noBox' => 'required'
        ];

        return $rules;
    }
}
