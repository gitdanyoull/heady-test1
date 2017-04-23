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
        $post= $post_repository->findAll();
        
        $img_repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $row = 0;
        $glass = array();
        foreach( $post as $k => $v ){
            $images= $img_repository->findBy( array('postId' => $v->getId() ));
            $glass[$row]['post']=$v;
            $glass[$row]['images']=$images;
            ++$row;
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'post'=>$glass,
        ));
    }
}
