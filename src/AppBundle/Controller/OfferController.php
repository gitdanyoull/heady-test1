<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferController extends Controller
{
    /**
     * @Route("/offer/{id}", name="offer_form")
     * */
    public function saveAction(Request $request)
    {
        return new Response( 'Text  ' );
    }
}