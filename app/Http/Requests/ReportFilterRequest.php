<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return ['start_date'=>['nullable','date'],'end_date'=>['nullable','date','after_or_equal:start_date'],'type'=>['nullable','string']];
    }
}
