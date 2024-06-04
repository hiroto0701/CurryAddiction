<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller\Request;

use App\Models\Post;
use App\Models\User;
use App\Rules\UploadableExtension;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // return User::AuthUser()->can('issuance_request-create');
        return true;
    }

    // public function rules()
    // {
    //     return [
    //         'store_name' => ['required', 'string', 'max: 30'],
    //         'comment' => ['nullable', 'text', 'max: 140'],
    //         'genre_id' => ['required', 'numeric'],
    //         'post_img' => [
    //             'required', 'file',
    //             'image',
    //             'max:' . config('validation.maxFileSize'),
    //             'mimes:png,jpeg,jpg'
    //         ],
    //         'latitude' => ['required', 'number'],
    //         'longitude' => ['required', 'number'],
    //     ];
    // }

    // public function withValidator(Validator $validator)
    // {
    //     $validator->sometimes(
    //         'required_document_upload_file',
    //         ['required', 'file', 'max:' . config('validation.maxFileSize'), new UploadableExtension()],
    //         function ($input) {
    //             return (int)$input->required_document_type !== IssuanceRequest::DOCUMENT_TYPE_HIDDEN
    //             && (int)$input->required_document_type !== IssuanceRequest::DOCUMENT_TYPE_UNNECESSARY
    //             && (int)$input->required_document_type !== IssuanceRequest::DOCUMENT_TYPE_ATTACHED_NONE;
    //         }
    //     );

    //     $validator->after(function ($validator) {
    //         // 物件に紐づく管理会社が現在利用可能か
    //         $buildingId = $this->building_id;
    //         $isEnableManagementCompany = ManagementCompany::whereHas('buildings', function ($query) use ($buildingId) {
    //             $query->where('id', $buildingId);
    //         })->where('status', ManagementCompany::STATUS_ENABLED)->exists();
    //         if (!$isEnableManagementCompany) {
    //             $validator->errors()->add(
    //                 'building_id',
    //                 __('validation.request_suspended', ['attribute' => $this->attributes()['building_id']])
    //             );
    //         }
    //     });
    // }

    // public function attributes()
    // {
    //     return [
    //         'building_id' => '依頼物件',
    //         'building_house_number' => '依頼物件住戸番号',
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'required_document_upload_file.max' => __('validation.max_10mb'),
    //     ];
    // }
}
