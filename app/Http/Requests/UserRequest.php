<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer a solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepara o password para validação.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->password) {
            $this->merge([
                'password'  => Hash::make($this->password),
            ]);
        }
    }
    /**
     * Busca as regras de validação e aplica na solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'bail|required|string|min:3|max:100',
            'email'         => 'bail|required|email|unique:users,email',
            'password'      => 'bail|required|string',
        ];
    }
}
