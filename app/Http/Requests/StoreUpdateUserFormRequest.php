<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->segment(2)); SEGMENT PARA PEGAR AS PARTES DO LINK
        // dd($this->id); IGUAL SO QUE FUNCIONA COM O NOME DO PARAMETRO

        $id = $this->id ?? ''; // Esta expressão considera o valor de id, se for nulo ele volta vazio

        $rules = [
            'name' => 'required|string|max:255|min:3',
            'email' => [
                'required',
                'email',
                "unique:users,email,{$id},id",
            ],
            'password' => [
                'required',
                'min:6',
                'max:15',
            ]
        ];

        if($this->method('PUT')){
            $rules['password'] = [
                'nullable',
                'min:6',
                'max:15',
            ];
        }

        return $rules;
    }
}
