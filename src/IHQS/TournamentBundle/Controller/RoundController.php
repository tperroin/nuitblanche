<?php

namespace IHQS\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RoundController extends Controller
{
    /**
	 * Displaying a round
	 *
     * @Route("/{tournament_id}/round/{round_id}", name="ihqs_tournament_round_show")
     * @Template()
     */
    public function showAction($tournament_id, $round_id)
    {
		$round = $this->get('ihqs_tournament.manager.round')->findOneById($round_id);

        return array(
			'round'			=> $round,
			'tournament'	=> $round->getTournament(),
        );
    }

    /**
	 * Creating a new round
	 *
     * @Route("/{tournament_id}/round/new", name="ihqs_tournament_round_new")
     * @Template()
     */
    public function newAction($tournament_id)
    {
    }

    /**
	 * Edit a round
	 *
     * @Route("/{tournament_id}/round/{round_id}/edit", name="ihqs_tournament_round_edit")
     * @Template()
     */
    public function editAction($tournament_id, $round_id)
    {
    }

    /**
	 * Closes a round
	 *
     * @Route("/{tournament_id}/round/{round_id}/close", name="ihqs_tournament_round_close")
     * @Template()
     */
    public function closeAction($tournament_id, $round_id)
    {
    }
}
