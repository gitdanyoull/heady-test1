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
     * @Route('/contact/seller', name="contact_seller")
     * */
    public function saveAction(Request $request, $postId)
    {
        $data = $request->request;

        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();


        $form = $this->createForm(new ContactFormType());

        return new Response( json_encode( array('insert'=>$data) ) );

    }
}