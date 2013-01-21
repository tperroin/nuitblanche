<?php

namespace IHQS\ForumBundle\Controller;

use Bundle\ForumBundle\Controller\PostController as BasePostController;
use Bundle\ForumBundle\Model\Topic;
use Bundle\ForumBundle\Model\Post;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostController extends BasePostController
{
    public function newAction(Topic $topic)
    {
		$posts = $this->get('forum.repository.post')->findAllByTopic($topic, true);
        $form = $this->get('forum.form.post');
		
        return $this->get('templating')->renderResponse('ForumBundle:Post:new.html.'.$this->getRenderer(), array(
            'form'  => $form->createView(),
            'topic' => $topic,
			'posts' => $posts
        ));
    }

	/**
	 * @Route("/post/edit/{id}", name="forum_post_edit")
	 */
	public function editAction($id)
	{
        $post = $this->get('forum.repository.post')->find($id);
        if(!$post) {
            throw new NotFoundHttpException(sprintf('No post found with id "%s"', $id));
        }

        $form = $this->get('forum.form.post');
		$form->setData($post);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

			if($form->isValid())
			{
				$post = $form->getData();
				$em = $this->get('forum.object_manager');
				$em->persist($post);
				$em->flush();

				return new RedirectResponse($this->get('forum.router.url_generator')->urlForPost($post));
			}
        }

		$topic = $post->getTopic();
		$posts = $this->get('forum.repository.post')->findAllByTopic($topic, true);

		return $this->get('templating')->renderResponse('ForumBundle:Post:edit.html.'.$this->getRenderer(), array(
			'form'  => $form->createView(),
			'post'	=> $post,
			'topic' => $topic,
			'posts' => $posts
		));
	}
}
