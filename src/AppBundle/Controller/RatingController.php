<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 2/20/17
 * Time: 12:34 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Rating;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingController extends Controller
{
    /**
     * @Route("/rating/save/{postId}", name="rating_save")
     */
    public function saveAction(Request $request, $postId)
    {
        $rating = $request->request->get('form');

        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $sale=new Rating();
        $sale->setRating($rating);
        $sale->setUserId($userId);
        $sale->setTstamp(time());
        $sale->setPostId($postId);
        $sale->setIp($request->getClientIp());
        $data = $sale;

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($sale);
        $em->flush();

        return new Response( json_encode( array('insert'=>$data) ) );

    }
}