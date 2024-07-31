<?php

namespace App\Infrastructure\Http\Validators\Import;

use Illuminate\Foundation\Http\FormRequest;

class CreateImportValidator extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'mimes:csv']
        ];
    }
}
