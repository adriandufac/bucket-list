<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


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
    public function formulaire(Request $request,EntityManagerInterface $entityManager){

        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class,$wish);

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted()){
            $wish->setIsPublished(true);
            $entityManager->persist($wish);
            $entityManager->flush();
            $this->addFlash('success', 'wish ajouté!');

            return $this->redirectToRoute('wish_details',["id" => $wish->getId()]);
        }

        return $this->render('wish/formulaire.html.twig',['wishForm' =>$wishForm->createView()]);
    }



}
