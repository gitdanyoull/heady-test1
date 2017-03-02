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


class PostController extends Controller
{
    /**
     * @Route("/post", name="post")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('post/index.html.twig', array(
            'post'=>$post
        ));
    }
    /**
     * @Route("/post/new", name="post_new")
     */
    public function newAction(Request $request)
    {
	    $post = new Post(); 
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $form = $this->createForm( new PostFormType( $userId ), $post );
        $form->handleRequest($request);	

        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);

            $em->flush();
            $this->addFlash('success', 'success');
            return $this->redirectToRoute('post');
        }

        // replace this example code with whatever you need
        return $this->render('post/form.html.twig', array(
            'form' => $form->createView(),'post'=>$post,'postId'=>1,
            'images' => array()
        ));
    }
    /**
     * @Route("/post/edit/{id}", name="post_edit")
     */
    public function editAction(Request $request,Post $post,$id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new PostFormType( $userId, $id ),$post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();

            $em->persist($post);

            $em->flush();
            $this->addFlash('success', 'success');
            return $this->redirectToRoute('post');
        }
        // replace this example code with whatever you need

        $repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $images = $repository->findBy( array('postId' => $post->getId() ) );

        $image = $this->createForm( new SetImageFormType(), new Image() );

        return $this->render('post/form.html.twig', array(
            'form' => $form->createView(),
            'image' => $image->createView(),
            'post'=>$post,
            'images'=>$images
        ));
    }
    /**
     * @Route("/post/view/{id}", name="post_view")
     */
    public function viewAction(Request $request, $id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if( $user!='anon.' )
            $userId = $user->getId();
        else
            $userId = '';

        $post_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $post_repository->findOneBy(array('id'=>$id));

        $img_repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $images= $img_repository->findBy( array('postId' => $post->getId()),array('showDefault' => 'DESC'));

        $msg_repository = $this->getDoctrine()->getRepository('AppBundle:Message');
        $messages = $msg_repository->findAll();

        $message = $msg_repository->findOneBy(array('postId' => $post->getId(),'userId'=>$userId));

        $message_form = $this->createForm( new MessageFormType(), new Message() );

        $contact = $this->createForm( new ContactFormType(), new Contact() );

        $rating = new PostRating($request->getClientIp(),$id);
        $ip = $rating->getIp();
        $ipRating = $rating->getIpRating($this->getDoctrine());

        // replace this example code with whatever you need
        return $this->render('post/post.html.twig', array(
            'post'=>$post,
            'images'=>$images,
            'contact' => $contact->createView(),
            'message' => $message_form->createView(),
            'review' => $message,
            'messages' => $messages,
            'ip' => $ip,
            'user_id' => $userId,
            'ipRating' => $ipRating,
        ));

    }
}
