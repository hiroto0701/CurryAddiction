<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ViewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::AuthUser()->can('post-view', $this->post);
    }

    public function rules()
    {
        return [

        ];
    }
}
