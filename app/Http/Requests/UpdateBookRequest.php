<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return ['category_id'=>['required','exists:categories,id'],'shelf_id'=>['required','exists:shelves,id'],'title'=>['required','string','max:255'],'isbn'=>['required','string','max:255'],'author'=>['required','string','max:255'],'publication_status'=>['required','in:published,draft,archived'],'stock'=>['required','integer','min:0']];
    }
}
