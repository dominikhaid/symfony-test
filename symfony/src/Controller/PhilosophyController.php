<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhilosophyController extends AbstractController
{
    /**
     * @Route("/about/philosophy",name="/about/philosophy")
     */
    public function number(): Response
    {
        return $this->render('pages/philosopy.html.twig', [
            //'user_first_name' => $userFirstName,
            //'notifications' => $userNotifications,
        ]);
    }
}
