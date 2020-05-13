<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class StatusType extends Enum implements LocalizedEnum
{
    const complete = 1;
    const pending = 2;
    const bugs = 3;
}
