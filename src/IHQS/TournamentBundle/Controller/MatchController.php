<?php

namespace IHQS\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IHQS\TournamentBundle\Form\Type\MatchReportType;

class MatchController extends Controller
{
    /**
	 * Displaying a match
	 *
     * @Route("/{tournament_id}/match/{match_id}", name="ihqs_tournament_match_show")
     * @Template()
     */
    public function showAction($tournament_id, $match_id)
    {
		$match = $this->get('ihqs_tournament.manager.match')->findOneById($match_id);

        return array(
			'match' => $match,
        );
    }

    /**
	 * Reporting a result for a match
	 *
     * @Route("/{tournament_id}/match/{match_id}/report", name="ihqs_tournament_match_report")
     * @Template()
     */
    public function reportAction($tournament_id, $match_id)
    {
		$match = $this->get('ihqs_tournament.manager.match')->findOneById($match_id);

        $form = $this->get('form.factory')->create(new MatchReportType(), $match);

		$request = $this->get('request');
		$em = $this->get('ihqs_tournament.object_manager');

        if($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);
            if($form->isValid())
            {
                $object = $form->getData();
                $em->persist($object);
                $em->flush();
            }
        }

        return array(
            'form'		=> $form->createView(),
        );
    }

    /**
	 * Validating a match
	 *
     * @Route("/{tournament_id}/match/{round_id}/validate", name="ihqs_tournament_match_validate")
     * @Template()
     */
    public function validateAction($tournament_id, $match_id)
    {
    }

    /**
	 * Reporting and validating a match
	 *
     * @Route("/{tournament_id}/match/{round_id}/report_validate", name="ihqs_tournament_match_report_and_validate")
     * @Template()
     */
    public function reportAndValidateAction($tournament_id, $match_id)
    {
    }
}
