<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 2/20/17
 * Time: 12:34 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    /**
     * @Route("/message/save/{postId}", name="message_save")
     */
    public function saveAction(Request $request, $postId)
    {
        $data = $request->request->get('form');

        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $sale=new Message();
        $sale->setTitle($data[0]['value']);
        $sale->setTstamp($data[3]['value']);
        $sale->setMessage($data[1]['value']);
        $sale->setRating($data[2]['value']);
        $sale->setUserId($userId);
        $sale->setUserId($userId);
        $sale->setPostId($postId);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($sale);
        $em->flush();

        return new Response( json_encode( array('insert'=>$sale) ) );

    }
}