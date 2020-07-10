<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Batiment;
use App\Form\BatimentType;

class BatimentController extends AbstractController
{
    /**
     * @Route("/save_basement", name="save_basement.index")
     * @return Response
     */
    public function SaveBasement(Request $request):Response
    {
        $em       = $this->getDoctrine()->getManager();
        $batiment = new Batiment();
        $form     = $this->createForm(BatimentType::class, $batiment);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em->persist($batiment);
            $em->flush();
        }

        return $this->render('pages/savebasement.html.twig', [
            'form' => $form->createView(),
            'current_menu' => 'activation'
        ]);
    }
}
