<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 2/23/17
 * Time: 5:11 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArtistController extends Controller
{

    /**
     * @Route("/artist", name="artist")
     */
    public function artistAction(Request $request){
        return new Response('artist');
    }
}