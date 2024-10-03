<?php

declare(strict_types=1);

namespace App\Domains\Notification\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
{

    public function authorize(): bool
    {
        return User::AuthUser()->can('notification-index');
    }

    public function rules()
    {
        return [];
    }
}
