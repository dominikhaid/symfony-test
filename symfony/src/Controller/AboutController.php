<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/terms-of-use",name="/terms-of-use")
     */
    public function index(): Response
    {
        return $this->render('pages/about.html.twig', [
            //'user_first_name' => $userFirstName,
            //'notifications' => $userNotifications,
        ]);
    }
}
