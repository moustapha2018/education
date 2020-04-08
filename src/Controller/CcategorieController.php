<?php

namespace App\Controller;

use App\Entity\Ccategorie;
use App\Form\CcategorieType;
use App\Repository\CcategorieRepository;
use App\Service\Utils;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CcategorieController extends AbstractController
{
    /**
     * @Route("/ccategorie", name="ccategorie")
     */
    public function ccategorie(Request $request, CcategorieRepository $repository, Utils $utils)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $ccategorie = new Ccategorie();

        $form = $this->createForm(CcategorieType::class, $ccategorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $ccategorie->setCreatedAt(new \DateTime('now'));
            $ccategorie->setCreatedBy($utils->currentUser($request));
            $entityManager->persist($ccategorie);
            $entityManager->flush();

            //sending message success and return to the form
            $utils->messageSavingObject();
            return $this->redirectToRoute('ccategorie');
        }
        $ccategories = $repository->findAll();
        return $this->render('ccategorie/ccategorie.html.twig', [
            'form' => $form->createView(),
            'ccategories' =>$ccategories
        ]);
    }

    /**
     * @Route("/edit_ccategorie/{id}", name ="edit_ccategorie")
     */
    public function edit_ccategorie($id, CcategorieRepository $ccategorieRepository, Request $request, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $ccategorie = $ccategorieRepository->find($id);
        if ($ccategorie != null) {
            $form = $this->createForm(CcategorieType::class,$ccategorie);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $manager->flush();
                $utils->messageUpdatingObject();
                return $this->redirectToRoute('ccategorie');
            }
            return $this ->render('ccategorie/edit_ccategorie.html.twig',[
                'ccategorie'=>$ccategorie,
                'form' =>$form->createView()

            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('ccategorie');
        }




    }

    /**
     * @Route("/delete/ccategorie/{id}", name ="delete_ccategorie")
     */
    public function delete_ccategorie($id, CcategorieRepository $ccategorieRepository,Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $ccategorie = $ccategorieRepository->find($id);
        if ($ccategorie != null){
            $manager->remove($ccategorie);
            $manager->flush();
            $utils->messageDeletingObject();
            return $this ->redirectToRoute('ccategorie');
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('ccategorie');
        }

    }

}
