<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return ['borrowing_item_id'=>['required','exists:borrowing_items,id'],'amount'=>['required','numeric','min:0'],'reason'=>['required','string','max:255']];
    }
}
