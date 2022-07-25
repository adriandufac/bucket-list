<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/",name="main_home")
     */
    public function home(){
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/test",name="main_test")
     */
    public function test(){
        $test = "la variable de test";
        return $this->render('main/test.html.twig', ["test"=>$test]);
    }

    /**
     * @Route("/about",name="main_about")
     */
    public function about(){
        return $this->render('main/about.html.twig');
    }

    /**
     * @Route("/formulaire",name="main_formulaire")
     */
    public function formulaire(){
        return $this->render('main/formulaire.html.twig');
    }



}