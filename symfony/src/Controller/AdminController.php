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
    /* *
       * RENDER ADMIN MAIN PAGE TILES VIEW
       * @return Response
       */

    #[Route('/admin/team', name: '/admin/team')]
    public function teamMain(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $member = $entityManager->getRepository(Team::class)->findAll();

        if (!$member) {
            throw $this->createNotFoundException('No team members found');
        }

        $entityManager->flush();

        return $this->render('pages/admin_team_index.html.twig', [
            'team' => $member,
        ]);
    }

    // RENDER TEAM MEMBER EDIT

    #[Route('/admin/team/edit', name: '/admin/team/edit')]
    public function updateTeam(Request $request, SluggerInterface $slugger): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamFormType::class, $team);
        $form->handleRequest($request);
        $result = [];

        if (false == $form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $id = $request->query->get('id');
            $member = false;
            $member = $entityManager->getRepository(Team::class)->find($id);

            if (!$member) {
                throw $this->createNotFoundException('No team members found');
            }

            $result['first_name'] = $member->getFirstName();
            $result['last_name'] = $member->getLastName();
            $result['role'] = $member->getRole();
            $result['photo'] = $member->getPhoto();
            $result['description'] = $member->getDescription();

            $form['first_name']->setData($result['first_name']);
            $form['last_name']->setData($result['last_name']);
            $form['role']->setData($result['role']);
            //$form['photo']->setData($result['photo']);
            $form['description']->setData($result['description']);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $id = $request->query->get('id');
            $member = false;

            // if request query has id get team member by id
            if ($id) {
                $member = $entityManager->getRepository(Team::class)->find($id);
            }

            if (!$member) {
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
                        'images/team',
                        $newFilename
                    );
                } catch (FileException $e) {
                    print_r($e);

                    throw $this->createNotFoundException('Image could not be submited');
                }
                $member->setPhoto($newFilename);

                $process = new Process(['./convert.sh']);
                $process->setWorkingDirectory('/workspace/symfony');
                $process->run(function ($type, $buffer) {
                    echo $buffer;
                });
            }

            $member->setFirstName($form->get('first_name')->getData());
            $member->setLastName($form->get('last_name')->getData());
            $member->setRole($form->get('role')->getData());
            $member->setDescription($form->get('description')->getData());

            $entityManager->flush();

            return $this->redirectToRoute('adminTeam');
        }

        return $this->render('pages/admin_team_edit.html.twig', [
            'teamForm' => $form->createView(),
            'member' => $result,
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
                        'images/team',
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
