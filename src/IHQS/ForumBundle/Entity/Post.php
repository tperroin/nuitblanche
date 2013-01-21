<?php

namespace IHQS\ForumBundle\Entity;
use Bundle\ForumBundle\Entity\Post as BasePost;
use Doctrine\ORM\Mapping as ORM;
use IHQS\NuitBlancheBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="Bundle\ForumBundle\Entity\PostRepository")
 * @ORM\Table(name="forum_post")
 */
class Post extends BasePost
{
    /**
     * @ORM\ManyToOne(targetEntity="IHQS\NuitBlancheBundle\Entity\User")
     */
    protected $author;

    /**
     * @ORM\ManyToOne(targetEntity="Topic")
     */
    protected $topic;

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    public function getAuthorName()
    {
        return ($this->author instanceof User) ? $this->author->getUsername() : 'Anonymous';
    }

    public function getMessage()
    {
        return $this->message;
    }

	public function isAuthor($user = null)
	{
		if(!$user || !$user instanceof User) { return false; }
		return ( $user->getId() == $this->author->getId() );
	}
}