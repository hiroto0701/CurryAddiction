<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Request;

use App\Models\User;
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
        $service_user = $this->route()->parameter('service_user');
        return User::AuthUser()->can('service_user-update', $service_user);
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
