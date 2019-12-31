<?php

namespace tde\craft\environmentwarning\services;

use craft\base\Component;

/**
 * @package tde\craft\environmentwarning\services
 */
class GitService extends Component
{
    /**
     * @return bool|string
     */
    public function getCurrentBranchName()
    {
        if (!$head = file(CRAFT_BASE_PATH . '/.git/HEAD', FILE_USE_INCLUDE_PATH)) {
            return false;
        }

        $ref = $head[0];
        $refParts = explode('/', $ref, 3);

        return trim(end($refParts));
    }
}
