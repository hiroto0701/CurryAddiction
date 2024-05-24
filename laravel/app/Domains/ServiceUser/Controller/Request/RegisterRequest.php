<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:'.config('validation.maxEmail')],
            'handle_name' => ['required', 'string', 'unique:service_users,handle_name', 'min:'.config('validation.minHandleName'), 'max:'.config('validation.maxHandleName'), 'regex:/^[a-zA-Z0-9-_]+$/'],
        ];
    }
}
