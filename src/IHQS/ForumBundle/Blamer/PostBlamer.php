<?php

namespace IHQS\ForumBundle\Blamer;

use Bundle\ForumBundle\Blamer\PostBlamer as BasePostBlamer;
use IHQS\NuitBlancheBundle\Entity\User;

class PostBlamer extends BasePostBlamer
{
    public function blame($post)
    {
        if ($token = $this->security->getToken()) {
            if ($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                $user = $token->getUser();
                if($user instanceof User) {
                    $post->setAuthor($user);
                }
            }
        }
    }
}
