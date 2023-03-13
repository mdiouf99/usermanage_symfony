<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    //Compter le nbre de visite
    #[Route('/session', name: 'session')]
    public function index(Request $Request): Response
    {
        //session.start()
        //recupere la session
        $session=$Request->getSession();
        //verfier s'il la session contient la cle nbVisite
        // si oui incrementer nbvisite
        if($session->has('nbVisite')){
            $nbreVisite = $session->get('nbVisite')+1 ;
        }
        //sinon mettre nbvisite a 1
        else{
            $nbreVisite = 1 ;
        }
        $session->set('nbVisite',$nbreVisite);
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
