<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExpensesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $actualDate =  Carbon::now()->toDateString();

        return [
            'description' => 'string|max:255',
            'value' => 'required|numeric|min:0',
            'expense_date' => 'required|date_format:Y-m-d|before_or_equal:' . $actualDate,
        ];
    }
}
