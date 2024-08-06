<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\OperationLog;
use App\Models\User;
use Carbon\Carbon;

trait OperationLogTrait
{
    public function addOperationLog($operation_type, $name, $value, $user_id = null)
    {
        $operationLog = new OperationLog();
        $operationLog->operated_at = Carbon::now();
        $operationLog->user_id = $user_id ?? User::AuthId();
        $operationLog->operation_type = $operation_type;
        $operationLog->name = $name;
        $operationLog->value = $value;
        $operationLog->namespace = $this->getCallerNameSpace();
        $operationLog->class_name = $this->getCallerClassName();
        $operationLog->api_name = $this->getOperationOverView();
        $operationLog->save();
    }

    private function getOperationOverView() {
        if (defined('static::OPERATION_OVERVIEW')) {
            return static::OPERATION_OVERVIEW;
        } else {
            return null;
        }
    }

    private function getCallerNameSpace() {
        $fqcn = get_class();
        return substr($fqcn, 0, strrpos($fqcn, '\\'));
    }

    private function getCallerClassName() {
        $fqcn = get_class();
        return substr($fqcn, strrpos($fqcn, '\\') + 1);
    }
}
