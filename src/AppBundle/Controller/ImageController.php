<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Form\ImageFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;



class ImageController extends Controller
{
    /**
     * @Route("/image/{postId}", name="add_image")
     */
    public function indexAction(Request $request, $postId)
    {

        $form = $this->createForm(new ImageFormType(), new Image() );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->getData();
            $em = $this->getDoctrine()->getManager();

            if( empty($request->request->get('delete')) ) {
                $file = $image->getName();

                $image->setShowDefault('0');

                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );

                $image->setName($fileName);

            }
            else
                $em->persist($image);
                $em->remove($image);

            $em->flush();
            $this->addFlash('success', 'success');
            return $this->redirectToRoute('post');
        }

        $post_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $post_repository->findOneBy(array('id'=>$postId));

        // replace this example code with whatever you need
        return $this->render('image/index.html.twig', array(
            'post'=>$post,
            'image'=>'',
            'id'=>$postId,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/image/{postId}/{imageId}", name="edit_image")
     */
    public function editAction(Request $request, $postId, $imageId)
    {

        $image_repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $image= $image_repository->findOneBy(array('imageId'=>$imageId));

        $form = $this->createForm(new ImageFormType(), $image );


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($image);

            $em->flush();
            $this->addFlash('success', 'success');
            return $this->redirectToRoute('post');
        }
        $repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $image = $repository->findOneBy( array('postId'=>$postId) );

        $post_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post= $post_repository->findOneBy(array('id'=>$postId));

        // replace this example code with whatever you need
        return $this->render('image/index.html.twig', array(
            'post'=>$post,
            'image'=>$image,
            'id'=>$postId,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/image/default/", name="set_image")
     */
    public function updateDataAction(Request $request )
    {
        $data = $request->request->get('form');

        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('AppBundle:Image');

        $posts = $repo->findAll();

        foreach ($posts as $post) {
            $post->setShowDefault('0');
            $em->persist($post);
        }

        $em->flush();

        $item = $em->getRepository('AppBundle:Image')->findBy(array('postId'=>$data[0]['value']));

        $product = $em->getRepository('AppBundle:Image')->find($data[0]['value']);
        $product->setShowDefault('1');

        $em->flush();

        return $this->render('default/ajax.html.twig', array(
            'text'=>json_encode( array('imageId'=>$data))
        ));
    }

    /**
     * @Route("/image/delete/{postId}/{imageId}", name="delete_image")
     */
    public function deleteAction(Request $request, $postId, $imageId)
    {
        $image_repository = $this->getDoctrine()->getRepository('AppBundle:Image');
        $image= $image_repository->findOneBy(array('imageId'=>$imageId));

        $form = $this->createForm(new ImageFormType(), $image );

        $em = $this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();
        $this->addFlash('success', 'success');
        return $this->redirectToRoute('post');
    }
}
