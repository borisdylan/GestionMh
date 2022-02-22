<?php

namespace App\Controller;
use App\Repository\MaisonHoteRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\MaisonHote;
use App\Form\MaisonHoteType;


class GestionMaisonController extends AbstractController
{
    /**
     * @Route("/gestion/maison", name="gestion_maison")
     */
    public function index(): Response
    {
        return $this->render('gestion_maison/index.html.twig', [
            'controller_name' => 'GestionMaisonController',
        ]);
    }
    
    /**
     * @Route("/Affichermaison", name="AfficherMaison")
     */
    public function AfficherMaison(MaisonHoteRepository $repository)
    {
        $maisonhote=$repository->findAll();
        return $this->render('gestion_maison/AfficherMaison.html.twig', ['maisonhote'=>$maisonhote]);
    }

    /**
     * @Route("/SupprimerMaison/{id}", name="d")
     */
    function SupprimerMaison($id, MaisonHoteRepository $repository){
        $maisonhote=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($maisonhote);
        $em->flush();
        return $this->redirectToRoute('AfficherMaison');

    }

    /**
     *@param Request $request
     * @return use Symfony\Component\HttpFoundation\Response
     * @Route("/AjouterMaison")
     */
    public function AjouterMaison(Request $request)
    {
        $maisonhote = new MaisonHote();
        $form = $this->createForm(MaisonHoteType::class, $maisonhote);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($maisonhote);
            $em->flush();
            return $this->redirectToRoute('AfficherMaison');
        }
        return $this->render('gestion_maison/AjouterMaison.html.twig', [
            'form' => $form->createView()
        ]);
   }

   /**
    * @Route("/Modifier/{id}",name="modifier")
    */
    function Modifier($id, MaisonHoteRepository $repository, Request $request){
        $maisonhote=$repository->find($id);
        $form=$this->createForm(MaisonHoteType::class, $maisonhote);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficherMaison');
        }

        return $this->render('gestion_maison/Modifier.html.twig',[
            'form' => $form->createView()
        ]);



    }


}
