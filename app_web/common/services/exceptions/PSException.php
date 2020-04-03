<?php

namespace common\services\exceptions;

/**
 * Class PSException
 * @package common\services\exception
 */
class PSException extends \yii\base\Exception
{
    const CODE_INTERNAL_ERROR = 1;
    const CODE_BAD_REQUEST = 2;
}
