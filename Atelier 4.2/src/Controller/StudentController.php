<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/liststudent', name: 'list_student')]
    public function liststudent(StudentRepository $repo): Response
    {
        $tab=$repo->findAll();
        return $this->render('student/list.html.twig',array("tab"=>$tab));
    }

    #[Route('/addstudent', name: 'addStudent')]
    public function addStudent(Request $request,ManagerRegistry $doctrine)
    {

        $student=new Student()  ;
        $form=$this->createForm(StudentType::class,$student)  ;
        $form->handleRequest($request)  ;
        if($form->isSubmitted())
        {
            $em=$doctrine->getManager() ;
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("list_student")   ;

        }
        return $this->renderForm("Student/add.html.twig",array("tab"=>$form))  ;



    }

    #[Route('/updatestudent/{id}', name: 'updateStudent')]
    public function updatestudent($id,StudentRepository $repo, Request $request,ManagerRegistry $doctrine)
    {

        $student=$repo->find($id)  ;

        $form=$this->createForm(StudentType::class,$student)  ;
        $form->handleRequest($request)  ;
        if($form->isSubmitted())
        {
            $em=$doctrine->getManager() ;
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("list_student")   ;

        }
        return $this->renderForm("Student/update.html.twig",array("tab"=>$form))  ;



    }


}
