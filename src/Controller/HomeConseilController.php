<?php

namespace App\Controller;

use App\Repository\CcategorieRepository;
use App\Repository\ConseilRepository;
use App\Service\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeConseilController extends AbstractController
{
    /**
     * @Route("home/conseil", name="home_conseil")
     */

    public function home_conseil(Request $request, ConseilRepository $conseilRepository, CcategorieRepository $ccategorieRepository)
    {
        $all_conseil = $conseilRepository->findAll();
        return $this->render('home_conseil/home_conseil.html.twig', [
            'conseils' => $all_conseil,
            'ccategories'=>$ccategorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/rechercher/conseil", name="search_conseil")
     */
    public function Rechercher_conseil(Request $request, ConseilRepository $conseilRepository, Utils $utils,CcategorieRepository $ccategorieRepository )
    {
        if ($request->getMethod() == 'POST'){
            $categorieconseil = $request->get('ccategorie');
            $nameconseil = $request->get('name');
            if($categorieconseil == 'selectionner' ){
                $utils->messageNotNullObject();
            }else{
                $all_conseil =  $conseilRepository->findBy(array('ccategorie' => $categorieconseil));
                return $this->render('home_conseil/home_conseil.html.twig', [
                    'conseils' => $all_conseil,
                    'ccategories'=> $ccategorieRepository->findAll()
                ]);
            }
        }
        $all_conseil =  $conseilRepository->findAll();
        return $this->render('home_conseil/home_conseil.html.twig', [
            'conseils' => $all_conseil,
            'ccategories'=> $ccategorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/view/conseil/{id}", name ="view_conseil")
     */
    public function view_conseil($id, ConseilRepository $conseilRepository,Utils $utils){
        $conseil = $conseilRepository->find($id);
        if ($conseil != null){

            return $this->render('home_conseil/view_conseil.html.twig', [
                'conseil' => $conseil
            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('home_conseil');
        }

    }
}
