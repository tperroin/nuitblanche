<?php

namespace IHQS\ForumBundle\Controller;

use Bundle\ForumBundle\Controller\TopicController as BaseTopicController;
use Bundle\ForumBundle\Model\Topic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TopicController extends BaseTopicController
{
    /**
     * @Template()
     */
    public function _latestAction()
    {
        $topics = $this->get('forum.repository.topic')->findAll(true);

        $topics->setCurrentPage(1);
        $topics->setMaxPerPage(5);

        return array(
            'topics'    => $topics,
        );
    }
}
