<?php

namespace IHQS\NuitBlancheBundle\Controller;

use IHQS\NuitBlancheBundle\Entity\Comment;
use IHQS\NuitBlancheBundle\Entity\News;
use IHQS\NuitBlancheBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class NewsController extends BaseController
{
    protected function getFormComment(News $news, User $user)
    {
        // default object
        $comment = new Comment();
        $comment
            ->setDate(new \Datetime())
            ->setNews($news)
            ->setAuthor($user)
        ;

        // creating form
        $form = $this->get('form.factory')
            ->createBuilder('form', $comment)
            ->add('body')
            ->getForm();

        return $form;
    }

    /**
     * @Template()
     */
    public function _latestAction()
    {
        return array(
            'news' => $this->get('nb.manager.news')->findLatest()
        );
    }

    /**
     * @Template()
     */
    public function _commentNewAction($news)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if(!$user instanceof User)
        {
            return array('not_connected' => true);
        }
        $form = $this->getFormComment($news, $user);

        // handling response
        return array(
            'not_connected' => false,
            'submit_path'	=> $this->generateUrl('news_show', array('news_id' => $news->getId())),
            'form'			=> $form->createView(),
			'title'			=> "Add your comment"
        );
    }

    /**
     * @Route("/news/comment/{id}/edit", name="news_comment_edit")
	 * @Template()
     */
    public function commentEditAction($id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if(!$user instanceof User)
        {
            return array('not_connected' => true);
        }

		$comment = $this->get('nb.manager.comment')->findOneById($id);
		if(!$comment)
		{
			throw new \InvalidArgumentException('Unknown comment for this id');
		}

        $form = $this->getFormComment($comment->getNews(), $user);
		$form->setData($comment);

		// handling request
		$request = $this->get('request');
		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);

			// handling submission
			if($form->isValid())
			{
				$comment = $form->getData();
				$this->get('nb.entity_manager')->persist($comment);
				$this->get('nb.entity_manager')->flush();

				return $this->redirect($this->generateUrl('news_show', array('news_id' => $comment->getNews()->getId())));
			}
		}

        // handling response
        return array(
            'not_connected' => false,
            'submit_path'	=> '',
            'form'			=> $form->createView(),
            'comment'		=> $comment
        );
    }

    /**
     * @Route("/news/comment/{id}/delete", name="news_comment_delete")
     */
    public function commentDeleteAction($id)
    {

		$comment = $this->get('nb.manager.comment')->findOneById($id);
		if(!$comment)
		{
			throw new \InvalidArgumentException('Unknown comment for this id');
		}

		$news = $comment->getNews();
		$this->get('nb.entity_manager')->remove($comment);
		$this->get('nb.entity_manager')->flush();

		return $this->redirect($this->generateUrl('news_show', array('news_id' => $news->getId())));
    }

    /**
     * @Route("/news/archives", name="news_archives")
     * @Template()
     */
    public function archivesAction()
    {
        return array(
            'news' => $this->get('nb.manager.news')->findAll()
        );
    }
    
    /**
     * @Route("/news/{news_id}/show", name="news_show")
     * @Template()
     */
    public function showAction($news_id)
    {
		$news = $this->get('nb.manager.news')->findOneById($news_id);
        $user = $this->get('security.context')->getToken()->getUser();

        if($user instanceof User)
        {
            $form = $this->getFormComment($news, $user);

            // handling request
            $request = $this->get('request');
            if ($request->getMethod() == 'POST')
            {
                $form->bindRequest($request);

                // handling submission
                if($form->isValid())
                {
                    $comment = $form->getData();
                    $this->get('nb.entity_manager')->persist($comment);
                    $this->get('nb.entity_manager')->flush();

					return $this->redirect($this->generateUrl('news_show', array('news_id' => $news_id)));
                }
            }
        }

        return array(
            'news' => $news
        );
    }

    /**
     * @Route("contribute/news/add", name="contribute_news_new")
     * @Route("contribute/news/{news_id}/edit", name="contribute_news_edit")
     * @Template("IHQSNuitBlancheBundle:Main:adminForm.html.twig")
     */
    public function newAction($news_id = null)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        // creating default object
        if(!is_null($news_id))
        {
            $news = $this->get('nb.manager.news')->findOneById($news_id);
        }
        else
        {
            $news = new News();
            $news
				->setAuthor($user)
				->setDate(new \Datetime())
            ;
        }

        // creating form
        $formType = $this->container->getParameter('nb.form.news.class');

        $form = $this->get('form.factory')->create(new $formType());
        $form->setData($news);

        return $this->_adminFormAction(
            'Add / Edit a news',
            $form,
            "News added"
        );
    }
}
