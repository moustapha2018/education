<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, UserRepository $repository)
    {
        if ($request->getMethod() == 'POST'){
            $login = $request->get('login');
            $pwd = $request->get('pwd');
            $user = $repository->findOneBy(array('login' => $login));

            if ($user == null){
                $this->addFlash('warning', 'Ce compte n\'existe pas');
                return $this->redirectToRoute("login");
            }elseif ($user->getPassword() == $pwd){
                $session = $request->getSession();
                $session->set('user', $user );
                return $this->redirectToRoute('home');

            }else{
                $this->addFlash('warning', 'Mot de passe incorect');
                $this->redirectToRoute('login');
            }
        }

        return $this->render('user/login.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
        $session = $request->getSession();
        $session->set('user',null);
        return $this ->redirectToRoute('login');
    }


}
