<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PlayerController extends Controller
{
    /**
     * @Template()
     */
    public function _connectedAction()
    {
        return array(
            'players' => $this->get('nb.manager.user')->findConnected()
        );
    }

    /**
     * @Template()
     */
    public function _widgetAction($player_name)
    {
        $player = $this->get('nb.manager.sc2profile')->findOneBySc2Account($player_name);

        return array(
            'player' => $player,
            'playerName' => $player_name,
        );
    }

    /**
     * @Route("/player/{user_id}/show", name="player_show")
     * @Route("/player/{user_id}/show/{profile}", name="player_show_profile")
     * @Template()
     */
    public function showAction($user_id, $profile = null)
    {
        $user = $this->get('nb.manager.user')->findOneById($user_id);
        if(!$profile && $user->getWoW()) { $profile = "wow"; }
        if(!$profile && $user->getSc2()) { $profile = "sc2"; }

        return array(
            'user'      => $user,
            'profile'   => $profile,
        );
    }

    /**
     * @Route("/users", name="player_list")
     * @Template("IHQSNuitBlancheBundle:Team:show_profiles.html.twig")
     */
    public function listAction()
    {
        $team = array(
            "name"  => "Website's",
            "tag"   => ""
        );
        $players = $this->get('nb.manager.user')->findAll();

        return array(
            'teams'	=> $this->get('nb.manager.team')->findAll(),
            'team'      => $team,
            'players'   => $players,
        );
    }
}
