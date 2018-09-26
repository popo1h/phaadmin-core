<?php

namespace Popo1h\PhaadminCore\ActionAuth;

use Popo1h\PhaadminCore\Action;
use Popo1h\PhaadminCore\ActionAuth;
use Popo1h\Support\Objects\CommentHelper;

class AutoByActionActionAuth
{
    /**
     * @var Action
     */
    private $action;
    /**
     * @var string
     */
    private $prefix;

    /**
     * AutoByActionActionAuth constructor.
     * @param Action $action
     * @param string $prefix
     */
    public function __construct(Action $action, $prefix = '')
    {
        $this->action = $action;
        if ($prefix) {
            $this->prefix = $prefix . '-';
        }
    }

    public function getName()
    {
        return ActionAuth::AUTH_NAME_AUTO_BY_ACTION_PREFIX . $this->prefix . forward_static_call_array([$this->action, 'getName'], []);
    }

    public function getTitle()
    {
        $title = '';
        try {
            $commentHelper = CommentHelper::createByClass($this->action);
            $actionTitleRes = $commentHelper->getCommentItemContents('action-title');
            if (isset($actionTitleRes[0])) {
                $title = $actionTitleRes[0];
            }
        } catch (\Exception $e) {
        }

        return $title;
    }
}
