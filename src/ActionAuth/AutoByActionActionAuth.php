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
     * AutoByActionActionAuth constructor.
     * @param Action $action
     */
    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    public function getName()
    {
        return ActionAuth::AUTH_NAME_AUTO_BY_ACTION_PREFIX . forward_static_call_array([$this->action, 'getName'], []);
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
