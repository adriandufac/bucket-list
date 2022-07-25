<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);
        return $this->render('wish/list.html.twig', [
            // les passe à Twig
            "wishes" => $wishes
        ]);
    }

    /**
     * @Route("/wish/details/{id}", name="wish_details")
     */
    public function details(int $id,WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        return $this->render('wish/details.html.twig',["wish" => $wish]);
    }

    /**
     * @Route("/wish/formulaire",name="wish_formulaire")
     */
    public function formulaire(){
        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class,$wish);

        return $this->render('wish/formulaire.html.twig',['wishForm' =>$wishForm->createView()]);
    }



}
