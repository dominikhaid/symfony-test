<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirectorsController extends AbstractController
{
    /**
     * @Route("/about/directors",name="/about/directors")
     */
    public function number(): Response
    {
        return $this->render('pages/directors.html.twig', [
            //'user_first_name' => $userFirstName,
            //'notifications' => $userNotifications,
        ]);
    }
}
