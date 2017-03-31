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
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $repository->findBy(array('user'=>$userId));

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
        $post->setUser($user);

        $form = $this->createForm( new PostFormType(), $post );
        $form->handleRequest($request);	

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Post $post */
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'success');
            return $this->redirectToRoute('post');
        }

        // replace this example code with whatever you need
        return $this->render('post/form.html.twig', array(
            'form' => $form->createView(),'post'=>$post,
            'images' => array()
        ));
    }
    /**
     * @Route("/post/edit/{id}", name="post_edit")
     */
    public function editAction(Request $request,Post $post,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PostFormType(),$post);
        
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
        $user_id = '';
        if( $user!='anon.' )
            $user_id = $user->getId();
        else
            $user_id = ''; 
            
        $message = new Message();
        $form = $this->createForm( new MessageFormType(), $message );
        $form->handleRequest($request); 


        $contact = $this->createForm( new ContactFormType(), new Contact() );
        
        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Post $post */
            $message = $form->getData(); 
            $message->setUser($user);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            $this->addFlash('success', 'success');
            return $this->redirectToRoute('post');
        }

        $post_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $post_repository->findOneBy(array('id'=>$id));

        $img_repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $images= $img_repository->findBy( array('postId' => $post->getId()),array('showDefault' => 'DESC'));

        $msg_repository = $this->getDoctrine()->getRepository('AppBundle:Message');
        $messages = $msg_repository->findBy(array('post'=>$post->getId()));

        $review = $msg_repository->findOneBy(array('post' => $post->getId(),'user'=>$user));

        $message_form = $this->createForm( new MessageFormType(), new Message() );


        $rating = new PostRating($request->getClientIp(),$id,$user);

        $ip = $rating->getIp(); 
        $stars = $rating->getRating($this->getDoctrine());
        
        // replace this example code with whatever you need
        return $this->render('post/post.html.twig', array(
            'post'=>$post,
            'images'=>$images,
            'contact' => $contact->createView(),
            'message' => $message_form->createView(),
            'review' => $review,
            'messages' => $messages,
            'ip' => $ip,
            'stars' => $stars,
            'user_id' => $user_id
        ));

    }
}
