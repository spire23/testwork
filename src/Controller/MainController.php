<?php

namespace App\Controller;

use App\Entity\SchoolClass;
use App\Form\ClassType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="schoolclass")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $schoolclasses = $em->getRepository(SchoolClass::class)->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'schoolclasses' => $schoolclasses
        ]);
    }
    /**
     * @Route("/main/single/{schoolclass}", name="single_class")
     */
    public function single(SchoolClass $schoolclass){

        return $this->render('main/single.html.twig', [
            'schoolclass' => $schoolclass,
        ]);
    }
    /**
     * @Route("/main/create", name="create_class")
     */
    public function create(Request $request){
        $schoolclass = new SchoolClass();

        $form = $this->createForm(ClassType::class, $schoolclass);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $schoolclass = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($schoolclass);
            $em->flush();

            return $this->redirectToRoute('schoolclass');
        }

        return $this->render('main/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/main/update/{schoolclass}", name="update_schoolclass")
     */
    public function update(Request $request, SchoolClass $schoolclass){
        $form = $this->createForm(ClassType::class, $schoolclass, [
            'action' => $this->generateUrl('update_schoolclass', [
                'schoolclass' => $schoolclass->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $schoolclass = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('schoolclass');
        }

        return $this->render('main/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/main/delete/{schoolclass}", name="delete_schoolclass")
     */
    public function delete(SchoolClass $schoolclass){
        $em = $this->getDoctrine()->getManager();
        $em->remove($schoolclass);
        $em->flush();

        return $this->redirectToRoute('schoolclass');
    }
}