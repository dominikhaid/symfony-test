<?php

//declare(strict_types = 1);

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

        if (is_array($member)) {
            foreach ($member as $key => $value) {
                $result['data'][$key]['firstName'] = $member[$key]['first_name'];
                $result['data'][$key]['lastName'] = $member[$key]['last_name'];
                $result['data'][$key]['department'] = $member[$key]['department'];
                $result['data'][$key]['photo'] = $member[$key]['photo'];
                $result['data'][$key]['description'] = $member[$key]['description'];
            }

            return new Response(json_encode($result));
        }

        $result['data']['firstName'] = $member->getFirstName();
        $result['data']['lastName'] = $member->getLastName();
        $result['data']['department'] = $member->getDepartment();
        $result['data']['photo'] = $member->getPhoto();
        $result['data']['description'] = $member->getDescription();

        return new Response(json_encode($result));
    }

    /**
     * Converts result to json response.
     *
     * @param mixed  $member
     * @param string $message
     */
    public function formatTeamObj($member): array
    {
        if (is_array($member)) {
            foreach ($member as $key => $value) {
                $result[$key]['id'] = $member[$key]['id'];
                $result[$key]['firstName'] = $member[$key]['first_name'];
                $result[$key]['lastName'] = $member[$key]['last_name'];
                $result[$key]['email'] = $member[$key]['email'];
                $result[$key]['department'] = $member[$key]['department'];
                $result[$key]['photo'] = $member[$key]['photo'];
                $result[$key]['description'] = $member[$key]['description'];
            }

            return $result;
        }

        $result['id'] = $member->getId();
        $result['firstName'] = $member->getFirstName();
        $result['lastName'] = $member->getLastName();
        $result['email'] = $member->getEmail();
        $result['department'] = $member->getDepartment();
        $result['photo'] = $member->getPhoto();
        $result['description'] = $member->getDescription();

        return $result;
    }

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
            $member = $entityManager->getRepository(Team::class)->findAll();

            if (!$member) {
                throw $this->createNotFoundException('No team members found');
            }

            $entityManager->flush();

            return $this->apiResult($member, 'Found team members');
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
            $department = $request->request->get('department');
            $email = $request->request->get('email');
            $role = $request->request->get('role');
            $photo = $request->request->get('photo');
            $description = $request->request->get('description');

            if ($firstName) {
                $member->setFirstName($firstName);
            }

            if ($lastName) {
                $member->setLastName($lastName);
            }
            if ($email) {
                $member->setPhoto($email);
            }
            if ($role) {
                $member->setPhoto($role);
            }
            if ($photo) {
                $member->setPhoto($photo);
            }
            if ($department) {
                $member->setRole($department);
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
            $department = $request->request->get('department');
            $email = $request->request->get('email');
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
            if ($email) {
                $member->setPhoto($email);
            }
            if ($role) {
                $member->setPhoto($role);
            }
            if ($department) {
                $member->setRole($department);
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
        $entityManager = $this->getDoctrine()->getManager();
        $result = $entityManager->getRepository(Team::class)->find($id);

        if (!$result) {
            throw $this->createNotFoundException('No team members found');
        }

        $member = $this->formatTeamObj($result);

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
        $result = $entityManager->getRepository(Team::class)->findAll();

        if (!$result) {
            throw $this->createNotFoundException('No team members found');
        }

        $member = $this->formatTeamObj($result);

        $entityManager->flush();

        return $this->render('pages/team_tiles.html.twig', [
            'team' => $member,
        ]);
    }
}
