<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class OperatorRecord
{
    // public function creating(Model $model)
    // {
    //     $model->created_at = Date::now();
    //     $model->created_by = User::AuthId(User::ID_SYSTEM);
    // }

    // public function updating(Model $model)
    // {
    //     // 値の変わらないsave()の場合はupdated_atが更新されないが、ここで更新させておく
    //     $model->updated_at = Date::now();
    //     $model->updated_by = User::AuthId(User::ID_SYSTEM);
    // }

    // public function saving(Model $model)
    // {
    //     $model->updated_at = Date::now();
    //     $model->updated_by = User::AuthId(User::ID_SYSTEM);
    // }

    // public function deleting(Model $model)
    // {
    //     $mustSaving = ($model->isDirty() === false);
    //     $model->deleted_at = Date::now();
    //     $model->deleted_by = User::AuthId(User::ID_SYSTEM);
    //     if ($mustSaving) {
    //         // 更新内容がソフトデリートのみであった場合、DB更新処理が自動で動かない
    //         $model->save();
    //     }
    // }
}
