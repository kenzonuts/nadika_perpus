<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShelfRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return ['code'=>['required','string','max:255','unique:shelves,code'],'name'=>['required','string','max:255'],'location'=>['nullable','string','max:255'],'description'=>['nullable','string']];
    }
}
