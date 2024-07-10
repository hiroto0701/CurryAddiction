<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
{
    private const SORTABLE_ATTRIBUTES = [
        'posted_at',
        'deleted_at',
    ];

    public function authorize(): bool
    {
        return User::AuthUser()->can('trash-index');
    }

    public function rules()
    {
        return [
            'sort_attribute' => ['nullable', Rule::in(self::SORTABLE_ATTRIBUTES)],
            'sort_direction' => ['nullable', Rule::in(config('constant.api.sort_directions'))],
        ];
    }
}
