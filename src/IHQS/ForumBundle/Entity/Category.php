<?php

namespace IHQS\ForumBundle\Entity;
use Bundle\ForumBundle\Entity\Category as BaseCategory;
use Doctrine\ORM\Mapping as ORM;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * @ORM\Entity(repositoryClass="Bundle\ForumBundle\Entity\CategoryRepository")
 * @ORM\Table(name="forum_category")
 */
class Category extends BaseCategory
{
    /**
     * @ORM\OneToOne(targetEntity="Topic")
     */
    protected $lastTopic;

    /**
     * @ORM\OneToOne(targetEntity="Post")
     */
    protected $lastPost;

    /**
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="category")
     */
    protected $topics;

	public function __construct()
	{
		$this->topics = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTopics($page = 1)
	{
		$topics = $this->topics->toArray();
		usort($topics, array("IHQS\ForumBundle\Entity\Category", "sortTopics"));
		$topics = new Pagerfanta(new ArrayAdapter($topics));

        $topics->setCurrentPage($page);
        $topics->setMaxPerPage(10);

		return $topics;
	}

	static public function sortTopics(Topic $a, Topic $b)
	{
		return $b->getPostIt() - $a->getPostIt();
	}
}