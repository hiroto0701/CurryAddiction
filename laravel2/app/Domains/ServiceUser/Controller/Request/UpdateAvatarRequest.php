<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return User::AuthUser()->can('service_user-update', User::AuthServiceUser());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'file_data' => [
                'file',
                'image',
                'max:' . config('validation.maxAvatarFileSize'),
                'mimes:png,jpeg,jpg'
            ],
        ];
    }
}
