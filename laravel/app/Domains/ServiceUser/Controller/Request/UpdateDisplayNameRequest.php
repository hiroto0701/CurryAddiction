<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDisplayNameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'display_name' => ['required', 'string', 'max:'.config('validation.maxDisplayName')],
        ];
    }
}
