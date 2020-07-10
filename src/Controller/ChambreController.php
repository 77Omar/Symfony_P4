<?php
namespace App\Controller;

use App\Entity\Batiment;
use App\Entity\Etudiant;
use App\Form\BatimentType;
use App\Form\EtudiantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chambre;
use App\Form\ChambreType;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\ChambreRepository;
use App\Repository\BatimentRepository;


class
ChambreController extends AbstractController
{
    /**
     * @Route("/save_room", name="save_room.index")
     * @return Response
     */
    public function SaveRoom(EntityManagerInterface $em, Request $request):Response
    {
        $rp= $em->getRepository(Chambre::class);
        $nbrField=count($rp->findAll()) ;
        $em       = $this->getDoctrine()->getManager();
        $chambre = new Chambre();
        $form     = $this->createForm(ChambreType::class, $chambre);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {

            $em->persist($chambre);
            $em->flush();
        }

        return $this->render('pages/saveroom.html.twig', [
            'form' => $form->createView(),
            'current_menu' => 'activation',
            'nbrField'=>$nbrField,
        ]);


    }

    /**
     * @Route("/list_room", name="list_rooms.index", defaults={"page"=1})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function ListRoom(Request $request, PaginatorInterface $paginator)
    {

        $em = $this->getDoctrine()->getManager();
        $rooms = $this->getDoctrine()->getRepository(Chambre::class)->findAll();


       $pagination= $paginator->paginate(
          $rooms,
          $request->query->getInt('page', 1), //Numero page en cour, sino 1 par defaut
            3
       );

        return $this->render('pages/listroom.html.twig', [
            'chambre' => $pagination,

        ]);
    }

    /**
     * @Route("/lister_chambre/{id<[0-9]+>}/update", name="list.index", methods={"POST", "GET"})
     */
    public function update(Request $request, EntityManagerInterface $em,Chambre $chambre):Response
    {

        $form     = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
        }

        return $this->render('pages/saveroom.html.twig', [
            'form' => $form->createView(),

        ]);
    }


    /**
     * use Symfony\Component\HttpFoundation\Response;
     * @Route("/delete/chambre/{id}", name="delete_chambre.index")
     */
    public function deleteChambre(EntityManagerInterface $em, int $id)
    {

        $chambre = $em->getRepository(Chambre::class)->find($id);
        $em->remove($chambre);
        $em->flush();
        return $this->render('pages/home.html.twig');
    }
}
