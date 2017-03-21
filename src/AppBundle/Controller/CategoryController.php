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
    public function artistAction(Request $request,$category){

        return $this->render('post/category.html.twig', array(
            'post'=>$category
        ));
    }

    /**
     * @Route("/category/new", name="category_new")
     */
    public function newCategoryAction(Request $request){
        return new Response('artist');
    }
}