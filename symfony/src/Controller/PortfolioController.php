<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio")
     */
    public function number(): Response
    {
        return $this->render('layouts/content.html.twig', [
            //'user_first_name' => $userFirstName,
            //'notifications' => $userNotifications,
        ]);
    }
}
