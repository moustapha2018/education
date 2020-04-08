<?php

namespace App\Controller;

use App\Entity\Rcategorie;
use App\Form\RcategorieType;
use App\Repository\RcategorieRepository;
use App\Service\Utils;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RcategorieController extends AbstractController
{
    /**
     * @Route("/rcategorie", name="rcategorie")
     */
    public function index(Request $request, RcategorieRepository $repository, Utils $utils)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $rcategorie = new Rcategorie();

        $form = $this->createForm(RcategorieType::class, $rcategorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $rcategorie->setCreatedAt(new \DateTime('now'));
            $rcategorie->setCreatedBy($utils->currentUser($request));
            $entityManager->persist($rcategorie);
            $entityManager->flush();

            //sending message success and return to the form
           $utils->messageSavingObject();
            return $this->redirectToRoute('rcategorie');
        }
        $rcategories = $repository->findAll();
        return $this->render('rcategorie/rcategorie.html.twig', [
            'form' => $form->createView(),
            'rcategories' =>$rcategories
        ]);
    }

    /**
     * @Route("/edit_rcategorie/{id}", name ="edit_rcategorie")
     */
    public function edit_rcategorie($id, RcategorieRepository $rcategorieRepository, Request $request, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $rcategorie = $rcategorieRepository->find($id);
        if ($rcategorie != null) {
            $form = $this->createForm(RcategorieType::class,$rcategorie);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $manager->flush();
                $utils->messageUpdatingObject();
                return $this->redirectToRoute('rcategorie');
            }
            return $this ->render('rcategorie/edit_rcategorie.html.twig',[
                'rcategorie'=>$rcategorie,
                'form' =>$form->createView()

            ]);
        }else{
                $utils->messageNotFoundObject();
            return $this->redirectToRoute('rcategorie');
        }




    }

    /**
     * @Route("/delete/rcategorie/{id}", name ="delete_rcategorie")
     */
    public function delete_rcategorie($id, RcategorieRepository $rcategorieRepository,Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $rcategorie = $rcategorieRepository->find($id);
        if ($rcategorie != null){
            $manager->remove($rcategorie);
            $manager->flush();
            $utils->messageDeletingObject();
            return $this ->redirectToRoute('rcategorie');
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('rcategorie');
        }

    }

}
