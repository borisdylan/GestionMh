<?php

namespace App\Controller;
use App\Repository\LocalisationRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Localisation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocalisationController extends AbstractController
{
    /**
     * @Route("/localisation", name="localisation")
     */
    public function index(): Response
    {
        return $this->render('gestion_localisation/index.html.twig', [
            'controller_name' => 'LocalisationController',
        ]);
    }

    /**
     * @Route("/Afficherlocalisation", name="Afficherlocalisation")
     */
    public function AfficherLocalisation(LocalisationRepository $repository)
    {
        $localisation=$repository->findAll();
        return $this->render('gestion_localisation/AfficherLocalisation.html.twig', ['localisation'=>$localisation]);
    }

    /**
     * @Route("/SupprimerLocalisation/{id}", name="dl")
     */
    function SupprimerLocalisation($id, LocalisationRepository $repository){
        $localisation=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($localisation);
        $em->flush();
        return $this->redirectToRoute('AfficherLocalisation');

    }

    /**
     *@param Request $request
     * @return use Symfony\Component\HttpFoundation\Response
     * @Route("/AjouterLocalisation")
     */
    public function AjouterLocalisation(Request $request)
    {
        $localisation = new localisation();
        $form = $this->createForm(LocalisationType::class, $localisation);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($localisation);
            $em->flush();
            return $this->redirectToRoute('AfficherLocalisation');
        }
        return $this->render('gestion_localisation/AjouterLocalisation.html.twig', [
            'form' => $form->createView()
        ]);
   }

   /**
    * @Route("/Modifier/{id}",name="modifier")
    */
    function Modifier($id, LocalisationRepository $repository, Request $request){
        $localisation=$repository->find($id);
        $form=$this->createForm(LocalisationType::class, $localisation);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficherLocalisation');
        }

        return $this->render('gestion_localisation/Modifier.html.twig',[
            'form' => $form->createView()
        ]);



    }

}
