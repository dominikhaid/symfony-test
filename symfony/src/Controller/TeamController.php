<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /*
     * TEAM MEMBER API
     *
     * @param Request $request
     * @return Response
     */

    #[Route('/api/team', name: 'teamApi')]
    public function teamApi(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = $request->query->get('id');
        $member = false;

        if ($id) {
            $member = $entityManager->getRepository(Team::class)->find($id);
        }

        if (!$id && Request::METHOD_GET == $request->getMethod()) {
            $member = $entityManager->getRepository(Team::class)->getAllTeamMembers();

            if (!$member) {
                throw $this->createNotFoundException('No team members found');
            }

            $entityManager->flush();
            $result = [];
            $result['message'] = 'Found team members';
            $result['data'] = $member;

            return new Response(json_encode($result));
        }

        if (!$member && Request::METHOD_POST != $request->getMethod()) {
            throw $this->createNotFoundException('No team members found');
        }

        if (Request::METHOD_GET == $request->getMethod()) {
            $result = [];
            $result['message'] = 'found team member';
            $result['data']['firstName'] = $member->getFirstName();
            $result['data']['lastName'] = $member->getLastName();
            $result['data']['role'] = $member->getRole();
            $result['data']['photo'] = $member->getPhoto();
            $result['data']['description'] = $member->getDescription();

            return new Response(json_encode($result));
        }

        if (Request::METHOD_PATCH == $request->getMethod()) {
            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $role = $request->request->get('role');
            $photo = $request->request->get('photo');
            $description = $request->request->get('description');

            if ($firstName) {
                $member->setFirstName($firstName);
            }

            if ($lastName) {
                $member->setLastName($lastName);
            }
            if ($photo) {
                $member->setPhoto($photo);
            }
            if ($role) {
                $member->setRole($role);
            }
            if ($description) {
                $member->setDescription($description);
            }

            $entityManager->flush();

            $result = [];
            $result['message'] = 'Updated team member';
            $result['data']['firstName'] = $member->getFirstName();
            $result['data']['lastName'] = $member->getLastName();
            $result['data']['role'] = $member->getRole();
            $result['data']['photo'] = $member->getPhoto();
            $result['data']['description'] = $member->getDescription();

            return new Response(json_encode($result));
        }

        if (Request::METHOD_DELETE == $request->getMethod()) {
            $entityManager->remove($member);
            $entityManager->flush();

            $result = [];
            $result['message'] = 'Deleted team member';
            $result['data']['firstName'] = $member->getFirstName();
            $result['data']['lastName'] = $member->getLastName();
            $result['data']['role'] = $member->getRole();
            $result['data']['photo'] = $member->getPhoto();
            $result['data']['description'] = $member->getDescription();

            return new Response(json_encode($result));
        }

        if (Request::METHOD_POST == $request->getMethod()) {
            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $role = $request->request->get('role');
            $photo = $request->request->get('photo');
            $description = $request->request->get('description');

            $member = new Team();

            if ($firstName) {
                $member->setFirstName($firstName);
            }

            if ($lastName) {
                $member->setLastName($lastName);
            }
            if ($photo) {
                $member->setPhoto($photo);
            }
            if ($role) {
                $member->setRole($role);
            }
            if ($description) {
                $member->setDescription($description);
            }

            $entityManager->persist($member);
            $entityManager->flush();
            $result = [];
            $result['message'] = 'Saved team member';
            $result['data']['firstName'] = $member->getFirstName();
            $result['data']['lastName'] = $member->getLastName();
            $result['data']['role'] = $member->getRole();
            $result['data']['photo'] = $member->getPhoto();
            $result['data']['description'] = $member->getDescription();

            return new Response(json_encode($result));
        }
    }

    /*
     * RENDER TEAM
     *
     * @return Response
     */

    #[Route('/about/team', name: 'teamIndex')]
    public function teamIndex(): Response
    {
        return $this->render('layouts/content.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }
}
