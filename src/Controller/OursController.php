<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OursController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     */
    public function index()
    {
        return $this->render('ours/index.html.twig', [
            'controller_name' => 'OursController',
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
     * @Route("/artistes/01", name="show_artiste")
     */
    public function show_artiste()
    {
        return $this->render('ours/show_artiste.html.twig');
    }
}
