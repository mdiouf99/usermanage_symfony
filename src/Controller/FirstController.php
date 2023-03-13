<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    // elle va masquer toute les routes qui viennent apres elle
    //route generique qui peut remplacer toute les routes
    //les routes generiques doivent venir en dernier
    //l'ordre des routes est important
    //le routeur a une suite de route ordonnée et il va matcher les routes une par routes
    //les routes les plus specifiques doivent apparaitre avant les routes les plus generiques
    /*#[Route('{maVar}',name: 'test.order.route')]
    public function testOrderRoute($maVar){
        return new Response($maVar);
}*/
    //attribut
    //si on a une requete /first execute cette fonction
    //lorsuqu'on veut executer une fonction via http on doit lui associe une route
    //le controller c'est la methode c'est pas la classe
    //la classe c'est un groupe de controller
    #[Route('/first', name: 'first')]
    public function index(): Response
    {
        //die : arrete le process
        //render : methode de abstract controller
        //abstractcontroller: il permet de definir un ensemble de helper : methode predefinit qui permet de raccourcir le travail de pas ecrire du code
        //render va chercher la vue dans la partie template

        return $this->render( 'first/index.html.twig',[
            'name' => 'Diouf',
            'firstname' => 'Mohamed',

        ]);
    }
//
//#[Route('/sayHello/{name}/{firstname}', name: 'say.hello')]
    public function sayHello(Request $request,$name,$firstname): Response
    {
       /* $rand= rand(0,10);
        echo $rand ;
        //redirectto:use the name define in the route annot
        if($rand % 2 == 0 ){
            return $this->redirectToRoute('first');
        }
        return $this->forward( 'App\Controller\FirstController::index'
        );*/
//        dd($request);
        return $this->render('first/hello.html.twig',[
            'nom'=>$name,
            'prenom'=>$firstname,
            ]);
    }
    #[Route('multi/{entier1}/{entier2}',
    name:'multiplication',
        requirements: ['entier1'=>'\d+','entier2'=>'\d+']
    )]
    public function multiplication($entier1,$entier2){
    $resultat = $entier1*$entier2 ;
    return new Response("<h1>$resultat</h1>");
    }
    #[Route('/template', name: 'template')]
    public function template(): Response
    {

        return $this->render( 'template.html.twig');
    }

}
