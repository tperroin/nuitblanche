<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\CommentRepository")
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="text")
     */
    protected $body;

    /**
     * @ORM\ManyToOne(targetEntity="News")
     */
    protected $news;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $author;

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate(\Datetime $date) {
        $this->date = $date;
        return $this;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
        return $this;
    }

    public function getNews() {
        return $this->news;
    }

    public function setNews(News $news) {
        $this->news = $news;
        return $this;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }

	public function isAuthor($user = null)
	{
		if(!$user || !$user instanceof User) { return false; }
		return ( $user->getId() == $this->author->getId() );
	}
}