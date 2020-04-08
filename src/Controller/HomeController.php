<?php

namespace App\Controller;

use App\Repository\RcategorieRepository;
use App\Repository\RecetteRepository;
use App\Service\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home(Request $request, RecetteRepository $recetteRepository, RcategorieRepository $rcategorieRepository)
    {
        $all_recette = $recetteRepository->findAll();
        return $this->render('home/home.html.twig', [
            'recettes' => $all_recette,
            'rcategories'=> $rcategorieRepository->findAll()
        ]);
    }
    /**
     * @Route("/recette/affricain", name="recette_africain")
     */

    public function Recette_Africain(Request $request, RecetteRepository $recetteRepository, RcategorieRepository $rcategorieRepository)
    {

        $all_recette =  $recetteRepository->findBy(array('speciality' => 'Africain'));
        return $this->render('home/home.html.twig', [
            'recettes' => $all_recette,
            'rcategories'=> $rcategorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/recette/europeen", name="recette_europeen")
     */

    public function Recette_Europeen(Request $request, RecetteRepository $recetteRepository, RcategorieRepository $rcategorieRepository)
    {

        $all_recette =  $recetteRepository->findBy(array('speciality' => 'Europeen'));
        return $this->render('home/home.html.twig', [
            'recettes' => $all_recette,
            'rcategories'=> $rcategorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/recette/asiatique", name="recette_asiatique")
     */

    public function Recette_Asiatique(Request $request, RecetteRepository $recetteRepository, RcategorieRepository $rcategorieRepository)
    {
        $all_recette =  $recetteRepository->findBy(array('speciality' => 'Asiatique'));
        return $this->render('home/home.html.twig', [
            'recettes' => $all_recette,
            'rcategories'=> $rcategorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/recette/generale", name="recette_generale")
     */
    public function Recette_Generale(Request $request, RecetteRepository $recetteRepository, RcategorieRepository $rcategorieRepository)
    {
        $all_recette =  $recetteRepository->findBy(array('speciality' => 'Générale'));
        return $this->render('home/home.html.twig', [
            'recettes' => $all_recette,
            'rcategories'=> $rcategorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/rechercher/recette", name="search_recette")
     */
    public function Rechercher_recette(Request $request, RecetteRepository $recetteRepository, Utils $utils, RcategorieRepository $rcategorieRepository)
    {
        if ($request->getMethod() == 'POST'){
            $speciality = $request->get('speciality');
            $rcategorie = $request->get('rcategorie');
            if($speciality == 'selectionner' and $rcategorie == 'selectionner' ){
                $utils->messageNotNullObject();
            }elseif ($speciality == 'selectionner' and $rcategorie != 'selectionner' ){
                $all_recette =  $recetteRepository->findBy(array('rcategorie' => $rcategorie ));
                return $this->render('home/home.html.twig', [
                    'recettes' => $all_recette,
                    'rcategories'=> $rcategorieRepository->findAll()
                ]);
            }elseif ($speciality != 'selectionner' and $rcategorie == 'selectionner' ){
                $all_recette =  $recetteRepository->findBy(array('speciality' => $speciality ));
                return $this->render('home/home.html.twig', [
                    'recettes' => $all_recette,
                    'rcategories'=> $rcategorieRepository->findAll()
                ]);
            }elseif ($speciality != 'toutes' and $rcategorie == 'toutes' ){

            } else{
                $all_recette =  $recetteRepository->findAll();
                return $this->render('home/home.html.twig', [
                    'recettes' => $all_recette,
                    'rcategories'=> $rcategorieRepository->findAll()
                ]);
            }
        }
        $all_recette =  $recetteRepository->findBy(array('speciality' => 'Générale'));
        return $this->render('home/home.html.twig', [
            'recettes' => $all_recette,
            'rcategories'=> $rcategorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/view/recette/{id}", name ="view_recette")
     */
    public function view_recette($id, RecetteRepository $recetteRepository,Utils $utils){
        $recette = $recetteRepository->find($id);
        if ($recette != null){

            return $this->render('home/view_recette.html.twig', [
                'recette' => $recette
            ]);
        }else{
            $utils->messageNotFoundObject();
            return $this->redirectToRoute('home');
        }

    }
}
