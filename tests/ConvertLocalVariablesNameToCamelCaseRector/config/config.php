<?php

declare(strict_types=1);

use Barnicolly\RectorCustomRules\RectorRules\ConvertLocalVariablesNameToCamelCaseRector;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ConvertLocalVariablesNameToCamelCaseRector::class);
};
