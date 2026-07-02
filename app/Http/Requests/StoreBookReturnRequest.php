<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return ['borrowing_id'=>['required','exists:borrowings,id'],'returned_date'=>['nullable','date'],'items'=>['required','array','min:1'],'items.*.borrowing_item_id'=>['required','exists:borrowing_items,id'],'items.*.condition'=>['required','in:good,damaged,lost']];
    }
}
