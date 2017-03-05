<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\Post;
use AppBundle\Entity\Image;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Artist;
use AppBundle\Form\PostFormType;
use AppBundle\Form\ArtistFormType;
use AppBundle\Form\ContactFormType;
use AppBundle\Form\MessageFormType;
use AppBundle\Form\SetImageFormType;
use AppBundle\Service\PostRating;
use AppBundle\Service\PostImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $repository->findBy(array('user'=>$user));
        
        // replace this example code with whatever you need
        return $this->render('admin/index.html.twig', array(
            'post'=>$post
        ));
    }

    /**
     * @Route("/admin/posts", name="admin_posts")
     */
    public function postsAction(Request $request)
    { 
        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts = $repository->findAll();
  
        // replace this example code with whatever you need
        return $this->render('admin/posts.html.twig', array(
            'posts'=>$posts
        ));
    }

    /**
     * @Route("/admin/posts/{id}", name="admin_post")
     */
    public function postAction(Request $request)
    { 
        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('admin/posts.html.twig', array(
            'posts'=>$posts
        ));
    }

        /**
     * @Route("/admin/users", name="admin_users")
     */
    public function usersAction(Request $request)
    { 

        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $users = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('admin/users.html.twig', array(
            'users'=>$users
        ));
    }

    /**
     * @Route("/admin/user/{id}", name="admin_user")
     */
    public function userAction(Request $request,$id)
    { 
       
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $repository->findById($id);
        dump($user); die;                                   
        // replace this example code with whatever you need
        return $this->render('admin/users.html.twig', array(
            'user'=>$user
        ));
    }
    
}
