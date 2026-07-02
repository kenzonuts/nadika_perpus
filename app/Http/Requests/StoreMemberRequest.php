<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return ['member_number'=>['required','string','max:255','unique:members,member_number'],'user_id'=>['nullable','exists:users,id'],'phone'=>['nullable','string','max:50'],'status'=>['required','in:active,inactive,suspended']];
    }
}
