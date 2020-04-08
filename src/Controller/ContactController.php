<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Service\Utils;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ContactRepository $repository, Utils $utils)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($contact->getPhone() == null){
                $contact->setPhone('pas de contact');
            }
            $contact->setCreatedAt(new \DateTime('now'));
            $entityManager->persist($contact);
            $entityManager->flush();

            //sending message success and return to the form
            $utils->messageSavingObject();
            return $this->redirectToRoute('contact');
        }
        $contacts = $repository->findAll();
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/all_messages", name="all_messages")
     */
    public function all_messages(Request $request, ContactRepository $repository, Utils $utils)
    {
        $contacts = $repository->findAll();
        return $this->render('contact/all_contact.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/delete/contact/{id}", name ="delete_contact")
     */
    public function delete_contact($id, ContactRepository $contactRepository, Utils $utils){
        $manager = $this->getDoctrine()->getManager();
        $contact = $contactRepository->find($id);
        if ($contact != null){
            $manager->remove($contact);
            $manager->flush();
            $utils->messageDeletingObject();
            return $this ->redirectToRoute('all_messages');
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('all_messages');
        }

    }

    /**
     * @Route("/view/contact/{id}", name ="view_contact")
     */
    public function view_recette($id, ContactRepository $contactRepository,Utils $utils){
        $contact = $contactRepository->find($id);
        if ($contact != null){

            return $this->render('contact/view_contact.html.twig', [
                'contact' => $contact
            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('home');
        }

    }

}
