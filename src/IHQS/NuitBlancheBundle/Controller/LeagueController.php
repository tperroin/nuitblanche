<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LeagueController extends Controller
{
    /**
     * @Route("/league/{league_id}/show", name="league_show")
     * @Template()
     */
    public function showAction($league_id)
    {
        return array(
            'league' => $this->get('nb.manager.league')->findOneById($league_id)
        );
    }

    /**
     * @Route("/season/{season_id}/show", name="season_show")
     * @Template()
     */
    public function seasonShowAction($season_id)
    {
        return array(
            'season' => $this->get('nb.manager.season')->findOneById($season_id)

        );
    }

    /**
     * @Route("/league/list", name="league_list")
     * @Template()
     */
    public function listAction()
    {
        return array(
            'leagues' => $this->get('nb.manager.league')->findAll()
        );
    }
}
