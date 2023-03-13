<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todo')]
class TodoController extends AbstractController
{

    /**
     * @Route("",name="todo")
     */
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //Afficher notre tableau de todo
        //sinon je l'initialise puis j'affiche
        if($session->has('todo')==false){
           $todos = ['achat'=>'acheter clé usb',
                          'cours'=>'Finaliser mon cours',
                          'correction'=>'corriger mes examens'
            ];
           $session->set('todo',$todos);
            $this->addFlash('info',"la liste des todos viens d'etre intitialisée");
        }
        //si j'ai mon tableau de todo dans ma session je ne fais que l'afficher




        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }
    #[Route('/add/{name}/{content}',
        name: 'todo.add',
        //valeur par defaut, valeur pris lorsque le user ne donne pas la valeur attendue
        //il faut toujours commencer par la valeur la plus a droite
//        defaults: ['content'=>'sf6']
)

    ]
    public function addTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();
        //verifier si j'ai mon tableau de to do dans la session
        if($session->has('todo')){
            //si oui
            //verifier s'il ya un todo avec le meme nom
            $todos = $session->get('todo');
            if(isset($todos[$name])){
                //si oui afficher une erreur
                $this->addFlash('error',"Le todo d'id $name existe deja dans la liste ");
            }
            else {
                //sinon on l'ajoute et on affiche un message de succes
                $todos[$name] = $content;
                $session->set('todo',$todos);
                $this->addFlash('success', "le todo d'id $name a été ajouté avec succes");

            }
        }
            else{
                //si non
                // afficher une erreur et on va rediriger vers le controlleur index
                $this->addFlash('error',"la liste des todos n'est pas encore initialisée");
            }

        return $this->redirectToRoute('todo');


    }

    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();
        //verifier si j'ai mon tableau de to do dans la session
        if($session->has('todo')){
            //si oui
            //verifier s'il ya un todo avec le meme nom
            $todos = $session->get('todo');
            if(!isset($todos[$name])){
                //si oui afficher une erreur
                $this->addFlash('error',"Le todo d'id $name n'existe pas dans la liste ");
            }
            else {
                //sinon on l'ajoute et on affiche un message de succes
                $todos[$name] = $content;
                $this->addFlash('success', "le todo d'id $name a été modifié avec succes");
                $session->set('todo',$todos);
            }
        }
        else{
            //si non
            // afficher une erreur et on va rediriger vers le controlleur index
            $this->addFlash('error',"la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo');


    }

    #[Route('/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): RedirectResponse
    {
        $session = $request->getSession();
        //verifier si j'ai mon tableau de to do dans la session
        if($session->has('todo')){
            //si oui
            //verifier s'il ya un todo avec le meme nom
            $todos = $session->get('todo');
            if(!isset($todos[$name])){
                //si oui afficher une erreur
                $this->addFlash('error',"Le todo d'id $name n'existe pas dans la liste ");
            }
            else {
                //sinon on l'ajoute et on affiche un message de succes
                unset($todos[$name]);
                $this->addFlash('success', "le todo d'id $name a été modifié avec succes");
                $session->set('todo',$todos);
            }
        }
        else{
            //si non
            // afficher une erreur et on va rediriger vers le controlleur index
            $this->addFlash('error',"la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo');


    }
    #[Route('/reset/{name}/{content}', name: 'todo.reset')]
    public function resetTodo(Request $request): RedirectResponse
    {
        $session = $request->getSession();
        //verifier si j'ai mon tableau de to do dans la session
       $session->remove('todo');
        return $this->redirectToRoute('todo');


    }


}
