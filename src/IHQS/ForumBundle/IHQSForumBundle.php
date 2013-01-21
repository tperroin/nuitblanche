<?php

namespace IHQS\ForumBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IHQSForumBundle extends Bundle
{
	public function getParent()
    {
        return 'ForumBundle';
    }
}
