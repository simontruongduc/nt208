<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ActionTypeEnum extends Enum
{
    const CREATE = 'create';

    const EDIT = 'edit';

    const CONFIRM = 'confirm';

    const VIEW = 'view';
}
