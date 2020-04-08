<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Form\ConseilType;
use App\Repository\ConseilRepository;
use App\Service\Utils;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConseilController extends AbstractController
{
    /**
     * @Route("/conseil", name="conseil")
     */
    public function conseil(Request $request, ConseilRepository $repository, Utils $utils)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $conseil = new Conseil();

        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $conseil->setCreatedAt(new \DateTime('now'));
            $conseil->setCreatedBy($utils->currentUser($request));
            $entityManager->persist($conseil);
            $entityManager->flush();

            //sending message success and return to the form
            $utils->messageSavingObject();
            return $this->redirectToRoute('conseil');
        }
        $conseils = $repository->findAll();
        return $this->render('conseil/conseil.html.twig', [
            'form' => $form->createView(),
            'conseils' =>$conseils
        ]);
    }

    /**
     * @Route("/edit_conseil/{id}", name ="edit_conseil")
     */
    public function edit_conseil($id, ConseilRepository $conseilRepository, Request $request, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $conseil = $conseilRepository->find($id);
        if ($conseil != null) {
            $form = $this->createForm(ConseilType::class,$conseil);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $manager->flush();
                $utils->messageUpdatingObject();
                return $this->redirectToRoute('conseil');
            }
            return $this ->render('conseil/edit_conseil.html.twig',[
                'conseil'=>$conseil,
                'form' =>$form->createView()

            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('conseil');
        }
    }

    /**
     * @Route("/delete/conseil/{id}", name ="delete_conseil")
     */
    public function delete_conseil($id, ConseilRepository $conseilRepository, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $conseil = $conseilRepository->find($id);
        if ($conseil != null){
            $manager->remove($conseil);
            $manager->flush();
            $utils->messageDeletingObject();
            return $this ->redirectToRoute('conseil');
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('conseil');
        }

    }

}
