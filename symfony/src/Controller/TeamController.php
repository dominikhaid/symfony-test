<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * Converts result to json response.
     *
     * @param mixed  $member
     * @param string $message
     */
    public function apiResult($member, $message): Response
    {
        $result = [];
        $result['message'] = $message;
        $result['data']['firstName'] = $member->getFirstName();
        $result['data']['lastName'] = $member->getLastName();
        $result['data']['role'] = $member->getRole();
        $result['data']['photo'] = $member->getPhoto();
        $result['data']['description'] = $member->getDescription();

        return new Response(json_encode($result));
    }

    /*
     * TEAM MEMBER API
     *
     * @param Request $request
     * @return Response
     */

    #[Route('/api/team', name: '/api/team')]
    public function teamApi(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = $request->query->get('id');
        $member = false;

        // if request query has id get team member by id
        if ($id) {
            $member = $entityManager->getRepository(Team::class)->find($id);
        }

        // if no id in query and method is get load all team members
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

        //if no member is found and method is not post, error response
        if (!$member && Request::METHOD_POST != $request->getMethod()) {
            throw $this->createNotFoundException('No team members found');
        }

        // get one by id
        if (Request::METHOD_GET == $request->getMethod()) {
            return $this->apiResult($member, 'Found team member');
        }

        // update one by id
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

            return $this->apiResult($member, 'Updated team member');
        }

        // delete one by id
        if (Request::METHOD_DELETE == $request->getMethod()) {
            $entityManager->remove($member);
            $entityManager->flush();

            return $this->apiResult($member, 'Deleted team member');
        }

        // create one by id
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

            return $this->apiResult($member, 'Saved team member');
        }
    }

    /*
        * RENDER TEAM MEMBER DETAIL
        *
        * @return Response
        */

    #[Route('/about/team', name: '/about/team')]
    public function teamIndex(int $id): Response
    {
        $member = [];
        $entityManager = $this->getDoctrine()->getManager();
        $result = $entityManager->getRepository(Team::class)->find($id);
        $member['id'] = $result->getId();
        $member['first_name'] = $result->getFirstName();
        $member['last_name'] = $result->getLastName();
        $member['role'] = $result->getRole();
        $member['photo'] = $result->getPhoto();
        $member['description'] = $result->getDescription();

        if (!$member) {
            throw $this->createNotFoundException('No team members found');
        }

        return $this->render('pages/team_detail.twig', [
            'member' => $member,
        ]);
    }

    /* *
     * RENDER TEAM MAIN PAGE TILES VIEW
     * @return Response
     */

    #[Route('/about/team', name: '/about/team')]
    public function teamMain(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $member = $entityManager->getRepository(Team::class)->getAllTeamMembers();

        if (!$member) {
            throw $this->createNotFoundException('No team members found');
        }

        $entityManager->flush();

        return $this->render('pages/team_tiles.html.twig', [
            'team' => $member,
        ]);
    }
}
