<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Artiste;
use App\Entity\Artwork;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @Route("/artwork", name="artwork")
     */
    public function artwork()
    {
        $repo = $this->getDoctrine()->getRepository(Artwork::class);

        $artworks = $repo->findAll();

        return $this->render('ours/artwork.html.twig', [
            'controller_name' => 'OursController',
            'artworks' => $artworks
        ]);
    }

    /**
     * @Route("/artwork/{id}", name="show_artwork")
     */
    public function show_artwork($id, Request $request, ObjectManager $manager)
    {
         $repo = $this->getDoctrine()->getRepository(Artwork::class);
         $artwork = $repo->find($id);
         
         $comment = new Comment();
         $form = $this->createForm(CommentType::class, $comment);

         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){

            $comment->setUser($this->getUser());
            $comment->setCreatedAt(new \DateTime())
                    ->setArtwork($artwork);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('show_artwork', ['id' => $artwork->getId()]);
         }

        return $this->render('ours/show_artwork.html.twig', [
        'artwork' => $artwork,
        'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/artwork/{id}/removeComment", name="removeComment")
     */
    public function removeComment($id, Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository(Comment::class);
        $comment = $repo->find($id);

        $idArtwork = $comment->getArtwork()->getId();

        $manager->remove($comment);
        $manager->flush();

        return $this->redirectToRoute('show_artwork',[
            'id' => $idArtwork
            ]);
    }

    /**
     * @Route("/artiste/{id}/follow", name="follow")
     */
    public function follow($id, Request $request, ObjectManager $manager){
        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository(Artiste::class);
        $artiste = $repo->find($id);

        $user->addFollow($artiste);

        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('show_artiste',[
            'id' => $id
            ]);
    }

     /**
     * @Route("/artiste/{id}/removeFollow", name="removeFollow")
     */
    public function removeFollow($id, Request $request, ObjectManager $manager){
        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository(Artiste::class);
        $artiste = $repo->find($id);

        $user->removeFollow($artiste);

        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('show_artiste',[
            'id' => $id
            ]);
    }
    
}
