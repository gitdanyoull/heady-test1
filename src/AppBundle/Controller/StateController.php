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

class StateController extends Controller
{

    /**
     * @Route("/{state}/state", name="state")
     */
    public function stateAction(Request $request,$state){

        return $this->render('list/state.html.twig', array(
            'post'=>$state
        ));
    }

    /**
     * @Route("/admin/state", name="admin_states")
     */
    public function adminStateAction(Request $request,$state){

        return $this->render('list/state.html.twig', array(
            'post'=>$state
        ));
    }
 
}