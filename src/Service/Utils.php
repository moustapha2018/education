<?php


namespace App\Service;
use App\Entity\User;
use App\Repository\RcategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class Utils extends AbstractController
{
    public function searchReplace($replace, $subject ){
        $search = "dossierutilisateur";
        return $new_directory = strtolower ( str_replace($search, $replace, $subject) );
    }
    /**
     * Return message image non chargée
     */
    public function messageImageNotUpload(){
        $this->addFlash(
            'warning',
            'Vous devez charger une image'
        );
    }

    /**
     * @param Request $request
     * @return object or message
     */
    public function currentUser(Request $request){
        //get the user current
        $currentUser = $request->getSession()->get('user');
        if ($currentUser != null){
            $userRepository = $this->getDoctrine()->getRepository(User::class) ;
            $user = $userRepository->find($currentUser->getId());

            if ($user == null ){
                $this->messageSessionExpired();
                return $this->redirectToRoute('login');
            }else{

                return $user;
            }
        }else{
            $this->messageSessionExpired();
            return $this->redirectToRoute('login');
        }

    }

    /**
     * Return message success
     */
    public function messageSavingObject(){
        $this->addFlash(
            'success',
            'Enregistrement effectué avec succèes'
        );
    }
    /**
      * Return message session Expired
     */
    public function messageSessionExpired(){
        $this->addFlash(
            'warning',
            'Votre session a expirée'
        );
    }

    /**
     * Return message not found
     */
    public function messageNotFoundObject(){
        $this->addFlash(
            'warning',
            'Objet Non trouvé'
        );
    }

    /**
     * Return message search not found
     */
    public function messageSearchNotFound(){
        $this->addFlash(
            'warning',
            'Aucun résultat trouvé'
        );
    }
    /**
     * Return message Modification
     */
    public function messageUpdatingObject(){
        $this->addFlash(
            'success',
            'Modification efectuée avec succèes'
        );
    }

    /**
     * Return message Modification
     */
    public function messageDeletingObject(){
        $this->addFlash(
            'success',
            'Suppression efectuée avec succèes'
        );
    }

    public function messageNotNullObject(){
        $this->addFlash(
            'warning',
            'Vous devez choisir une catégorie ou renseigner le nom d\'une recette'
        );
    }



}