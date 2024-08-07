<?php

declare(strict_types=1);

namespace App\Logger;

use Monolog\Formatter\LineFormatter;

class OperationLogFormatter
{
    public function __invoke($logger)
    {
        $lineFormatter = new LineFormatter('%datetime% %message%' . PHP_EOL, 'Y-m-d H:i:s.v');
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($lineFormatter);
        }
    }
}
