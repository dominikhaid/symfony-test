<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/about/team/{id}', name: 'team_id')]
    public function id(int $id): Response
    {
        $member = $this->getDoctrine()
            ->getRepository(Team::class)
            ->find($id)
        ;

        if (!$member) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$member->getFirstName());
        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $member]);
    }

    #[Route('/about/team/new/{name}', name: 'team_create')]
    public function createMember(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $member = new Team();
        $member->setFirstName('first_name');
        $member->setLastName('last_name');
        $member->setPhoto('last_name');
        $member->setRole('last_name');
        $member->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($member);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$member->getId());
    }

    #[Route('/about/team', name: 'team')]
    public function index(): Response
    {
        return $this->render('layouts/content.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }
}
