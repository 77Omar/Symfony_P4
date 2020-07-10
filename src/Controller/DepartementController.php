<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Form\DepartementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    /**
     * @Route("/departement", name="departement.index")
     */
    public function Savedepartement(Request $request):Response
    {
        $em       = $this->getDoctrine()->getManager();
        $departement = new Departement();
        $form     = $this->createForm(DepartementType::class, $departement);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em->persist($departement);
            $em->flush();
        }

        return $this->render('pages/Savedepartement.html.twig', [
            'form' => $form->createView(),
            'current_menu' => 'activation'
        ]);
    }
}
