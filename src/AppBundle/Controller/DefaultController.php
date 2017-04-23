<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $post_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts = $post_repository->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'posts' => $posts,
        ));
    }
}
