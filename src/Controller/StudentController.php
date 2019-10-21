<?php

namespace App\Controller;

use App\Entity\SchoolClass;
use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/create/{schoolclass}", name="student_create_form")
     */
    public function create(Request $request, SchoolClass $schoolclass){
        $student = new Student();

        $form = $this->createForm(StudentType::class, $student, [
            'action' => $this->generateUrl('student_create_form', [
                'schoolclass' => $schoolclass->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $student = $form->getData();
            $student->setSchoolclass($schoolclass);

            $em= $this->getDoctrine()->getManager();

            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('single_class', ['schoolclass' => $schoolclass->getId()]);
        }

        return $this->render('student/form.html.twig', [
           'form' => $form->createView(),
           'schoolclass' => $schoolclass
        ]);
    }

    /**
     * @Route("/stident/update/{schoolclass}/{student}", name="student_update_form")
     */
    public function update(Request $request, SchoolClass $schoolclass, Student $student){
        $form = $this->createForm(StudentType::class, $student, [
            'action' => $this->generateUrl('student_update_form', [
                'schoolclass' => $schoolclass->getId(),
                'student' => $student->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $student = $form->getData();

            $em= $this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('single_class', ['schoolclass' => $schoolclass->getId()]);
        }

        return $this->render('student/form.html.twig', [
            'form' => $form->createView(),
            'schoolclass' => $schoolclass
        ]);
    }

    /**
     * @Route ("student/delete/{schoolclass}/{student}", name="student_delete")
     */
    public function delete(SchoolClass $schoolclass, Student $student){
        $em = $this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();

        return $this->redirectToRoute('single_class', ['schoolclass' => $schoolclass->getId()]);
    }
}
