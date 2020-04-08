<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/change/pwd", name="change_pwd")
     */
    public function changepwd(Request $request, UserRepository $userRepository)
    {
        $currentUser = $request->getSession()->get('user');
        if ($request->getMethod() == "POST"){
            $lastPwd = $request->get('lastpwd');
            $newPwd = $request->get('newpwd');
            if ($lastPwd == '' or $newPwd =='' ){
                $this->addFlash('warning', 'Vous devez remplir tous les champs');
                return $this->redirectToRoute("profile");
            }else{
                $user = $userRepository->find($currentUser->getId());
                if ($user == null){
                    $this->addFlash('warning', 'Votre dsession a expirée');
                    return $this->redirectToRoute("profile");
                }elseif($currentUser->getPassword() != $lastPwd){
                    $this->addFlash('warning', 'Ancien mot de passe non trouvé oubien vous avez l\'avait déjà modifié sans se réconnecter à nouveau  ');
                }else{
                    $entityManager = $this->getDoctrine()->getManager();
                    $user->setPassword($newPwd);
                    $entityManager->flush();

                    $this->addFlash('success', 'Mot de passe modifié avec succès');
                    return $this->redirectToRoute('profile');

                }
            }

        }

        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
