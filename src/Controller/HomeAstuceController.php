<?php

namespace App\Controller;


use App\Repository\AstuceRepository;
use App\Service\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeAstuceController extends AbstractController
{
    /**
     * @Route("home/astuce", name="home_astuce")
     */

    public function home_astuce(Request $request, AstuceRepository $astuceRepository)
    {
        $all_astuces = $astuceRepository->findAll();
        return $this->render('home_astuce/home_astuce.html.twig', [
            'astuces' => $all_astuces,

        ]);
    }

    /**
     * @Route("/rechercher/astuce", name="search_astuce")
     */
    public function Rechercher_astuce(Request $request, AstuceRepository $astuceRepository, Utils $utils)
    {
        if ($request->getMethod() == 'POST'){
            $categorieastuce = $request->get('type');
            if($categorieastuce == 'selectionner' ){
                $utils->messageNotNullObject();
            }else{
                $all_astuce =  $astuceRepository->findBy(array('type' => $categorieastuce));
                return $this->render('home_astuce/home_astuce.html.twig', [
                    'astuces' => $all_astuce,
                ]);
            }
        }
        $all_astuce =  $astuceRepository->findAll();
        return $this->render('home_astuce/home_astuce.html.twig', [
            'astuces' => $all_astuce,

        ]);
    }

    /**
     * @Route("/view/astuce/{id}", name ="view_astuce")
     */
    public function view_astuce($id, AstuceRepository $astuceRepository, Utils $utils){
        $astuce = $astuceRepository->find($id);
        if ($astuce != null){

            return $this->render('home_astuce/view_astuce.html.twig', [
                'astuce' => $astuce
            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('home_astuce');
        }

    }
}
