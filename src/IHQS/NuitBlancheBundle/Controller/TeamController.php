<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TeamController extends Controller
{
    /**
     * @Route("/team/{team_id}/show", name="team_show")
     */
    public function showAction($team_id)
    {
        $team       = $this->get('nb.manager.team')->findOneById($team_id);
        $players    = $team->getPlayers();
        
        return $this->render(
            "IHQSNuitBlancheBundle:Team:show_" . $team->getTeamGame()->getShortName() . ".html.twig",
            array(
                'teams'     => $this->get('nb.manager.team')->findAll(),
                'team'      => $team,
                'players'   => $players,
                'stats'     => true
            )
        );
    }

    /**
     * @Template()
     */
    public function _sectionsAction()
    {
        return array(
            'teams' => $this->get('nb.manager.team')->findAll()
        );
    }

    /**
     * @Route("/team/list", name="team_list")
     * @Template()
     */
    public function listAction()
    {
        return array(
            'teams' => $this->get('nb.manager.team')->findAll()
        );
    }
}
