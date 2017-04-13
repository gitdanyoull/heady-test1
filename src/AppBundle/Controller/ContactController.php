<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 2/20/17
 * Time: 12:34 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @Route("/contact/save", name="contact_save")
     */
    public function saveAction(Request $request)
    {
        $data = $request->request->get('contact_form');
       
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $sale=new Contact();
        $sale->setTitle($data['title']); 
        $sale->setMessage($data['message']); 
        $sale->setUserId($userId);
        $sale->setPostId($postId);
        $sale->setIp( $request->getClientIp() );

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($sale);
        $em->flush();

    	$message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('dpsjdnl@gmail.com')
        ->setTo('dpsjdnl@gmail.com')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/registration.html.twig',
                array('name' => 'dan')
            ),
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
    ;
    echo $message;
    $this->get('mailer')->send($message);
        exit;

    }
}