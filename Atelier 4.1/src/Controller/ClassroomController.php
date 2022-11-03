<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }



    #[Route('/listClassroom', name: 'listClassroom')]
    public function listClassroom( ClassroomRepository $repository )
    {

        $Classroom= $repository->findAll();
        return $this->render("Classroom/list.html.twig",array("tabClassroom"=>$Classroom
        ));



    }


    #[Route('/addClassroom', name: 'addClassroom')]
    public function addClassroom(Request $request,ManagerRegistry $doctrine)
    {
       $Classroom=new Classroom()  ;
       $form=$this->createForm(ClassroomType::class,$Classroom)   ;
       $form->handleRequest($request)  ;
       if($form->isSubmitted())
       {
           $em=$doctrine->getManager() ;
           $em->persist($Classroom);
           $em->flush();
           return $this->redirectToRoute("listClassroom")   ;
       }

        return $this->renderForm("Classroom/add.html.twig",array("formulairecla"=>$form))  ;



    }
#[Route('/updateClassroom/{id}', name: 'updateClassroom')]
    public function updateClassroom($id,ClassroomRepository $repo,Request $request,ManagerRegistry $doctrine)
    {
       $Classroom=$repo->find($id) ;
       $form=$this->createForm(ClassroomType::class,$Classroom)   ;
       $form->handleRequest($request)  ;
       if($form->isSubmitted())
       {
           $em=$doctrine->getManager() ;
           $em->persist($Classroom);
           $em->flush();
           return $this->redirectToRoute("addClassroom")   ;
       }

        return $this->renderForm("Classroom/update.html.twig",array("formulairecla"=>$form))  ;



    }
    #[Route('/DeleteClassroom/{id}', name: 'deleteClassroom')]
    public function DeleteClassroom($id,ClassroomRepository $repo,ManagerRegistry $doctrine)
    {
        $Classroom=$repo->find($id) ;
        $em=$doctrine->getManager() ;
        $em->remove($Classroom);
        $em->flush();
        return $this->redirectToRoute("listClassroom");


    }


}
