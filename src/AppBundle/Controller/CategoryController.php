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

class CategoryController extends Controller
{

    /**
     * @Route("/{category}/category", name="category")
     */
    public function categoryAction(Request $request,$category)
    {  
        $cats = array( 'concentrate-bubblers'=>1,'accesories'=>2,'water-pipes'=>3,'non-functional'=>4 );
         
        $post_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $post_repository->findBy(array('category' => $cats[$category]) );
        
        $img_repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $row = 0;
        $glass=array();
        foreach( $post as $k => $v ){
            $images= $img_repository->findBy( array('postId' => $v->getId() ));
            $glass[$row]['post']=$v;
            $glass[$row]['images']=$images;
            ++$row;
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'post'=>$glass,
        ));

    }

    /**
     * @Route("/category/new", name="category_new")
     */
    public function newCategoryAction(Request $request){
        return new Response('artist');
    }
}