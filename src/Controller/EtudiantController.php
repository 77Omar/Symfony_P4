<?php
namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;


class EtudiantController extends AbstractController
{
    /**
     * @Route("/save_student", name="save_student.index")
     * @return Response
     */
    public function SaveStudent(EntityManagerInterface $em, Request $request):Response
    {
        $rp= $em->getRepository(Etudiant::class);
        $nbrField=count($rp->findAll()) ;
        $em       = $this->getDoctrine()->getManager();
        $etudiant = new Etudiant();
        $form     = $this->createForm(EtudiantType::class, $etudiant);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em->persist($etudiant);
            $em->flush();
        }

        return $this->render('pages/savestudent.html.twig', [
            'form' => $form->createView(),
            'current_menu' => 'activation',
            'nbrField'=>$nbrField,
        ]);
    }

    /**
     * @Route("/list_student", name="list_students.index")
     * @return Response
     */
    public function ListStudent(Request $request, PaginatorInterface $paginator):Response
    {
        $etudiants = $this->getDoctrine()->getRepository(Etudiant::class)->findAll();

        $pagination= $paginator->paginate(
            $etudiants,
            $request->query->getInt('page', 1), //Numero page en cour, sino 1 par defaut
            2
        );

        return $this->render('pages/liststudent.html.twig', [
            "etudiants" =>  $pagination,
        ]);
    }

    /**
     * @Route("/lister/{id<[0-9]+>}/update", name="lister.index", methods={"POST", "GET"})
     */
      public function update(Request $request, EntityManagerInterface $em,Etudiant $etudiant):Response
    {


        $form     = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            //$em->persist($etudiant); initule puisk l'objet provient dja de la BDD
            $em->flush();
            //return $this->redirectToRoute('/list_student');
        }

        return $this->render('pages/savestudent.html.twig', [
            'form' => $form->createView(),



        ]);
    }


    /**
     * use Symfony\Component\HttpFoundation\Response;
     * @Route("/delete/etudiant/{id}", name="delete_student.index")
     */
    public function deleteStudent(EntityManagerInterface $em, int $id)
    {
        $etudiant =$em->getRepository(Etudiant::class)->find($id);
        $em->remove($etudiant);
        $em->flush();
        return $this->render('pages/home.html.twig');
    }
}