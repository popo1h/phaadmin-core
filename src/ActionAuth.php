<?php

namespace Popo1h\PhaadminCore;

abstract class ActionAuth
{
    const AUTH_NAME_NONE = '__null';
    const AUTH_NAME_ERROR = '__error';
    const AUTH_NAME_AUTO_BY_ACTION_PREFIX = '__auto_by_action:';

    /**
     * need override
     * @return string
     */
    public static function getName()
    {
        return '';
    }

    /**
     * need override
     * @return string
     */
    public static function getTitle()
    {
        return '';
    }
}
