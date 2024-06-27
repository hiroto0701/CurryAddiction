<?php

namespace App\Domains\Post\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        // $post = $this->route()->parameter('post');
        // return User::AuthUser()->can('post-delete', $post);
		return true;
    }

    public function rules(): array
    {
        return [];
    }
}
