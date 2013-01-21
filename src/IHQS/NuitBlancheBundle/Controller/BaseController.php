<?php

namespace IHQS\NuitBlancheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;

class BaseController extends Controller
{
    protected function _adminFormAction($title, FormInterface $form, $message, $redisplay = true)
    {
        $valid = false;
        $error = '';

        // handling request
        $request = $this->get('request');
        if ($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            // handling submission
            if($form->isValid())
            {
                $object = $form->getData();
                $this->get('nb.entity_manager')->persist($object);
                $this->get('nb.entity_manager')->flush();
                $valid = true;
            }
            else
            {
                $error = 'Form was not validated';
            }
        }

        return array(
            'title'		=> $title,
            'form'		=> ($valid && !$redisplay) ? false : $form->createView(),
            'message'	=> $valid ? $message : $error,
        );
    }
}