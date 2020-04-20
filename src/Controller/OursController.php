<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artiste;

class OursController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Artiste::class);

        $artistes = $repo->findAll();

        return $this->render('ours/index.html.twig', [
            'controller_name' => 'OursController',
            'artistes' => $artistes
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('ours/home.html.twig');
    }

    /**
     * @Route("/maps", name="maps")
     */
    public function map()
    {
        return $this->render('ours/maps.html.twig');
    }

    /**
     * @Route("/artistes/{id}", name="show_artiste")
     */
    public function show_artiste($id)
    {
        $repo = $this->getDoctrine()->getRepository(Artiste::class);

        $artiste = $repo->find($id);

        return $this->render('ours/show_artiste.html.twig', [
        'artiste' => $artiste
        ]);
    }
}
