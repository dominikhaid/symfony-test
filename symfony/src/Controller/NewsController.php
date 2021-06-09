<?php

namespace App\Controller;

use App\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /* *
         * RENDER ADMIN MAIN PAGE TILES VIEW
         * @return Response
         */

    #[Route('/news', name: '/news')]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $result = $entityManager->getRepository(Posts::class)->findAll();

        if (!$result) {
            throw $this->createNotFoundException('No published posts found');
        }

        $entityManager->flush();

        return $this->render('pages/news.html.twig', [
            'posts' => $result,
        ]);
    }
}
