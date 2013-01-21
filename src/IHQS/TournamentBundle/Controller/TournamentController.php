<?php

namespace IHQS\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TournamentController extends Controller
{
    /**
	 * Displaying a tournament
	 *
     * @Route("/{tournament_id}/show", name="ihqs_tournament_tournament_show")
     * @Template()
     */
    public function showAction($tournament_id)
    {
		$tournament = $this->get('ihqs_tournament.manager.tournament')->findOneById($tournament_id);

        return array(
			'tournament' => $tournament,
        );
    }

    /**
	 * Creating a new tournament
	 *
     * @Route("/new", name="ihqs_tournament_tournament_new")
     * @Template()
     */
    public function newAction()
    {

    }

    /**
	 * Edit a tournament informations
	 *
     * @Route("/{tournament_id}/edit", name="ihqs_tournament_tournament_edit")
     * @Template()
     */
    public function editAction($tournament_id)
    {
		$tournament = $this->get('ihqs_tournament.manager.tournament')->findOneById($tournament_id);
    }

	/**
	 * Launching a tournament
	 * . it creates round groups and matches
	 *
     * @Route("/{tournament_id}/launch", name="ihqs_tournament_tournament_launch")
     * @Template("IHQSTournamentBundle:Tournament:action.html.twig")
	 */
	public function launchAction($tournament_id)
	{
		$tournament = $this->get('ihqs_tournament.manager.tournament')->findOneById($tournament_id);

		try {
			$error		= false;
			$message	= "Tournament has been launched. Good Luck and Have Fun !";
			$this->get('ihqs_tournament.manager.tournament')->launchTournament($tournament);
		}
		catch(Exception $e) {
			$error		= true;
			$message	= $e->getMessage();
		}

        return array(
			'tournament'	=> $tournament,
			'error'			=> $error,
			'message'		=> $message
        );
	}

	/**
	 * Closing subscription for a tournament
	 *
     * @Route("/{tournament_id}/close", name="ihqs_tournament_tournament_close")
     * @Template("IHQSTournamentBundle:Tournament:action.html.twig")
	 */
	public function closeAction($tournament_id)
	{
		$tournament = $this->get('ihqs_tournament.manager.tournament')->findOneById($tournament_id);
		$this->get('ihqs_tournament.manager.tournament')->closeTournament($tournament);

        return array(
			'tournament'	=> $tournament,
			'error'			=> false,
			'message'		=> "Tournament has been closed",
        );
	}

}
