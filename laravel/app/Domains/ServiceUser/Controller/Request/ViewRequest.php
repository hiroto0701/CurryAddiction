<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ViewRequest extends FormRequest
{
    public function authorize(): bool
    {
        // return User::AuthUser()->can('post-view', $this->post);
		return true;
    }

    public function rules()
    {
        return [

        ];
    }
}
