<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'news'           => $this->get('nb.manager.news')->findLatest(false),
            'newsCommunity'  => $this->get('nb.manager.news')->findLatest(true)
        );
    }

    /**
     * @Route("/lang/{lang}", name="lang")
     */
    public function langAction($lang)
    {
        $this->get('session')->setLocale($lang);
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * @Route("/to_come", name="to_come")
     * @Template()
     */
    public function toComeAction()
    {
        return array(
            'items' => array(
                'v2.0' => array(
                    'tournaments',
                    'comments edition',
                    'replay notes and comments',
                    'filters on replay and war lists',
                    'dumb stats page',
                    'backoffice for admins',
                )
            ),

            'ideas' => array(
                'remake team logos for other websites',
                'add Atom or RSS feeds',
                'news on facebook'
            ),
        );
    }

    /**
     * @Route("/404", name="exception")
     * @Template()
     */
    public function exceptionAction()
    {
        return array();
    }
}
