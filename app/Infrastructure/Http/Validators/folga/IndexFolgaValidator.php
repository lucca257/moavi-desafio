<?php

namespace App\Infrastructure\Http\Validators\folga;

use Illuminate\Foundation\Http\FormRequest;

class IndexFolgaValidator extends FormRequest
{
    public function rules(): array
    {
        return [
            'ano' => ['required', 'numeric'],
            'mes' => ['required', 'numeric'],
            'filial' => ['required', 'exists:funcionarios,filial'],
        ];
    }
}

