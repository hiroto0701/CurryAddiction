<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller\Request;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::AuthServiceUser()->can('post-create');
    }

    public function rules()
    {
        return [
            'store_name' => ['required', 'string', 'max:'.config('validation.maxStoreName')],
            'comment' => ['nullable', 'string', 'max:'.config('validation.maxComment')],
            'genre_id' => ['required', 'numeric'],
            'region_id' => ['required', 'numeric'],
            'prefecture_id' => ['required', 'numeric'],
            'post_img' => [
                'required',
                'image',
                'max:' . config('validation.maxPostFileSize'),
                'mimes:png,jpeg,jpg'
            ],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'official_name' => ['required', 'string'],
            'formatted_address' => ['required', 'string'],
            'postcode' => ['required', 'string', 'max: 255'],
            'prefecture' => ['required', 'string', 'max: 20'],
            'municipality' => ['required', 'string'],
            'ward' => ['nullable', 'string'],
            'district' => ['nullable', 'string'],
        ];
    }
}
