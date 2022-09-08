<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
        return [
            'name' => ['required', 'min:3']
        ];
    }

    public function messages()
    {
        return [
            //'nome.*' => 'Campo nome inválido', //essa mensagem é genérica para todos os erros
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome deve ter pelo menos :min caracteres'
        ];
    }
}