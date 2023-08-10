<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoktanRequest extends FormRequest
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
            'nama_kelompok'     => 'required',
            'ketua_kelompok'    => 'required',
            'kecamatan_id'      => 'required',
            'desa_id'           => 'required',
            'email'             => 'required|email|unique:tbl_kelompok_tani',
            'password'          => 'required|confirmed|min:8',
        ];
    }
    public function messages()
    {
        return [
            'nama_kelompok.required'    => 'Nama kelompok diperlukan.',
            'ketua_kelompok.required'   => 'Ketua kelompok diperlukan.',
            'kecamatan_id.required'     => 'Kecamatan diperlukan',
            'desa_id.required'          => 'Desa diperlukan',
            'email.required'            => 'Email diperlukan.',
            'email.email'               => 'Email harus format email yang benar.',
            'email.unique'              => 'Email yang anda gunakan sudah ada.',
            'password.required'         => 'Password diperlukan.',
            'password.confirmed'        => 'Password tidak sama.',
        ];
    }
}
