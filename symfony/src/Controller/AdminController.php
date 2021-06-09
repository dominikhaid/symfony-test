<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminController extends AbstractController
{
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

    /* *
       * RENDER ADMIN MAIN PAGE TILES VIEW
       * @return Response
       */

    #[Route('/admin', name: '/admin')]
    public function index(): Response
    {
        return $this->render('pages/admin_index.html.twig');
    }

    /* *
       * RENDER ADMIN MAIN PAGE TILES VIEW
       * @return Response
       */

    #[Route('/admin/team', name: '/admin/team')]
    public function teamMain(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $result = $entityManager->getRepository(Team::class)->findAll();

        if (!$result) {
            throw $this->createNotFoundException('No team members found');
        }

        $entityManager->flush();
        $members = $this->formatTeamObj($result);

        return $this->render('pages/admin_team_index.html.twig', [
            'team' => $members,
        ]);
    }

    // RENDER TEAM MEMBER EDIT

    #[Route('/admin/team/edit', name: '/admin/team/edit')]
    public function updateTeam(Request $request, SluggerInterface $slugger): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamFormType::class, $team);
        $form->handleRequest($request);

        if (false == $form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $id = $request->query->get('id');
            $result = false;
            $result = $entityManager->getRepository(Team::class)->find($id);

            if (!$result) {
                throw $this->createNotFoundException('No team members found');
            }

            $member = $this->formatTeamObj($result);

            $form['firstName']->setData($member['firstName']);
            $form['lastName']->setData($member['lastName']);
            $form['email']->setData($member['email']);
            $form['department']->setData($member['department']);
            $form['description']->setData($member['description']);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $id = $request->query->get('id');
            $member = false;

            // if request query has id get team member by id
            if ($id) {
                $result = $entityManager->getRepository(Team::class)->find($id);
            }

            if (!$result) {
                throw $this->createNotFoundException('No team members found');
            }

            /** @var UploadedFile $photo */
            $photo = $form->get('photo')->getData();

            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        'images/dynamic/team',
                        $newFilename
                    );
                } catch (FileException $e) {
                    print_r($e);

                    throw $this->createNotFoundException('Image could not be submited');
                }
                $result->setPhoto($newFilename);
                $result->setRole(0);

                $process = new Process(['./convert.sh']);
                $process->setWorkingDirectory('/workspace/symfony');
                $process->run(function ($type, $buffer) {
                    echo $buffer;
                });
            }

            $result->setFirstName($form->get('firstName')->getData());
            $result->setEmail($form->get('email')->getData());
            $result->setLastName($form->get('lastName')->getData());
            $result->setDepartment($form->get('department')->getData());
            $result->setDescription($form->get('description')->getData());

            $entityManager->flush();

            return $this->redirectToRoute('adminTeam');
        }

        return $this->render('pages/admin_team_edit.html.twig', [
            'teamForm' => $form->createView(),
            'member' => $member,
        ]);
    }

    // RENDER TEAM MEMBER CREATE

    #[Route('/admin/team/new', name: '/admin/team/new')]
    public function newTeam(Request $request, SluggerInterface $slugger): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamFormType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $photo */
            $photo = $form->get('photo')->getData();

            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        'images/dynamic/team',
                        $newFilename
                    );
                } catch (FileException $e) {
                    print_r($e);

                    throw $this->createNotFoundException('Image could not be submited');
                }

                $team->setPhoto($newFilename);

                $process = new Process(['./convert.sh']);
                $process->setWorkingDirectory('/workspace/symfony');
                $process->run(function ($type, $buffer) {
                    echo $buffer;
                });
            }

            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('adminTeam');
        }

        return $this->render('pages/admin_team_new.html.twig', [
            'teamForm' => $form->createView(),
        ]);
    }
}
