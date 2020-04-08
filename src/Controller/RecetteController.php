<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use App\Service\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette")
     */
    public function recette(Request $request, RecetteRepository $recetteRepository, Utils $utils)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $recete = new Recette();
        $form = $this->createForm(RecetteType::class, $recete);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $filesystem = new Filesystem();
            //$fileImage = $article->getImage();
            $fileImage = $recete->getImage();
            if($fileImage == Null){
                $utils->messageImageNotUpload();
                return $this->redirectToRoute('recette');
            }else{
                $fileNameImage = md5(uniqid()).'.'.$fileImage->guessExtension();
                $fileImage->move($this->getParameter('upload_directory_recettes'), $fileNameImage);
                $recete->setImage($fileNameImage);

                $recete->setCreatedAt(new \DateTime('now'));
                $recete->setCreatedBy($utils->currentUser($request));
                $entityManager->persist($recete);
                $entityManager->flush();
                //sending message success and return to the form
                $utils->messageSavingObject();
                return $this->redirectToRoute('recette');
            }


        }

        return $this->render('recette/recette.html.twig', [
            'form' => $form->createView(),
            'recettes' =>  $rcategories = $recetteRepository->findAll()
        ]);
    }

    /**
     * @Route("/edit/recette/{id}", name ="edit_recette")
     */
    public function edit_rcategorie($id, RecetteRepository $recetteRepository, Request $request, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $recette = $recetteRepository->find($id);
        $lastImage = $recette->getImage();
        if ($recette != null) {
            $form = $this->createForm(RecetteType::class,$recette);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $fileImage = $recette->getImage();
                if($fileImage == Null){
                    $recette->setImage($lastImage);
                    $manager->flush();
                    $utils->messageUpdatingObject();
                    return $this->redirectToRoute('recette');
                }else{
                    $filesystem = new Filesystem();
                    $filesystem->remove(
                        $this->getParameter('kernel.project_dir').'/public/uploads/recettes/'.$lastImage
                    );
                    $fileNameImage = md5(uniqid()).'.'.$fileImage->guessExtension();
                    $fileImage->move($this->getParameter('upload_directory_recettes'), $fileNameImage);
                    $recette->setImage($fileNameImage);
                    $manager->flush();
                    $utils->messageUpdatingObject();
                    return $this->redirectToRoute('recette');
                }

            }
            return $this ->render('recette/edit_recette.html.twig',[
                'recette'=>$recette,
                'form' =>$form->createView()

            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('recette');
        }




    }



    /**
     * @Route("/delete/recette/{id}", name ="delete_recette")
     */
    public function delete_rcategorie($id, RecetteRepository $recetteRepository,Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $recette = $recetteRepository->find($id);
        if ($recette != null){
            $fileImage = $recette->getImage();

            $filesystem = new Filesystem();
            $filesystem->remove(
                $this->getParameter('kernel.project_dir').'/public/uploads/recettes/'.$fileImage
            );

            $manager->remove($recette);
            $manager->flush();
            $utils->messageDeletingObject();
            return $this ->redirectToRoute('recette');
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('recette');
        }

    }


}

