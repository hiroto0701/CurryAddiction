<?php

declare(strict_types=1);

namespace App\Domains\Prefecture\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FavoriteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return User::AuthUser()->can('prefecture-favorite');
    }

    public function rules()
    {
        return [];
    }
}
