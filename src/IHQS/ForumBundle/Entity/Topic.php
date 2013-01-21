<?php

namespace IHQS\ForumBundle\Entity;

use Bundle\ForumBundle\Entity\Topic as BaseTopic;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\ForumBundle\Entity\TopicRepository")
 * @ORM\Table(name="forum_topic")
 */
class Topic extends BaseTopic
{
    /**
     * @ORM\Column(type="boolean")
     */
    protected $postIt;
    
    /**
     * @ORM\OneToOne(targetEntity="Post")
     */
    protected $firstPost;

    /**
     * @ORM\OneToOne(targetEntity="Post")
     */
    protected $lastPost;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="topics")
     */
    protected $category;

    /**
     * Get authorName
     * @return string
     */
    public function getAuthorName()
    {
        return $this->getFirstPost()->getAuthorName();
    }

    public function getPostIt() {
        return ($this->postIt);
    }

    public function setPostIt($postIt) {
        $this->postIt = ($postIt);
    }



}