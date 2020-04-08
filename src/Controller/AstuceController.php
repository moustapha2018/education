<?php

namespace App\Controller;

use App\Entity\Astuce;
use App\Form\AstuceType;
use App\Repository\AstuceRepository;
use App\Service\Utils;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AstuceController extends AbstractController
{
    /**
     * @Route("/astuce", name="astuce")
     */
    public function astuce(Request $request, AstuceRepository $repository, Utils $utils)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $astuce = new Astuce();

        $form = $this->createForm(AstuceType::class, $astuce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $astuce->setCreatedAt(new \DateTime('now'));
            $astuce->setCreatedBy($utils->currentUser($request));
            $entityManager->persist($astuce);
            $entityManager->flush();

            //sending message success and return to the form
            $utils->messageSavingObject();
            return $this->redirectToRoute('astuce');
        }
        $astuces = $repository->findAll();
        return $this->render('astuce/astuce.html.twig', [
            'form' => $form->createView(),
            'astuces' =>$astuces
        ]);
    }

    /**
     * @Route("/edit_astuce/{id}", name ="edit_astuce")
     */
    public function edit_astuce($id, AstuceRepository $astuceRepository, Request $request, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $astuce = $astuceRepository->find($id);
        if ($astuce != null) {
            $form = $this->createForm(AstuceType::class,$astuce);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $manager->flush();
                $utils->messageUpdatingObject();
                return $this->redirectToRoute('astuce');
            }
            return $this ->render('astuce/edit_astuce.html.twig',[
                'astuce'=>$astuce,
                'form' =>$form->createView()

            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('astuce');
        }
    }

    /**
     * @Route("/delete/astuce/{id}", name ="delete_astuce")
     */
    public function delete_astuce($id, AstuceRepository $astuceRepository, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $astuce = $astuceRepository->find($id);
        if ($astuce != null){
            $manager->remove($astuce);
            $manager->flush();
            $utils->messageDeletingObject();
            return $this ->redirectToRoute('astuce');
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('astuce');
        }

    }

}
