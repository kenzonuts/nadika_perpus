<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return ['member_id'=>['required','exists:members,id'],'borrow_date'=>['nullable','date'],'due_date'=>['nullable','date','after_or_equal:borrow_date'],'items'=>['required','array','min:1'],'items.*.book_id'=>['required','exists:books,id'],'items.*.quantity'=>['nullable','integer','min:1']];
    }
}
