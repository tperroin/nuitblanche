<?php

namespace IHQS\ForumBundle\Entity;

use Bundle\ForumBundle\Entity\TopicRepository as BaseTopicRepository;
use Bundle\ForumBundle\Model\TopicRepositoryInterface;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class TopicRepository extends BaseTopicRepository
{
    /**
     * @see TopicRepositoryInterface::findAllByCategory
     */
    public function findAllByCategory($category, $asPaginator = false)
    {
        $qb = $this->createQueryBuilder('topic');

		$qb->
			orderBy('topic.postIt', 'DESC')->
			addOrderBy('topic.pulledAt', 'DESC')->
            where($qb->expr()->eq('topic.category', $category->getId()));

        if ($asPaginator) {
            return new Pagerfanta(new DoctrineORMAdapter($qb->getQuery()));
        } else {
            return $qb->getQuery()->execute();
        }
    }
}
