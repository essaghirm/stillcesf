<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\MakeJson;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods="GET")
     */
    public function index(ProjectRepository $projectRepository, MakeJson $makeJson): Response
    {
        return $makeJson->json($projectRepository->findAll());
    }

    /**
     * @Route("/", name="project_new", methods="POST")
     */
    public function new(Request $request, ValidatorInterface $validator, MakeJson $makeJson): Response
    {
        $body = json_decode($request->getContent(), true); 
        $body['services'] = json_encode($body['services']);

        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->submit($body);

        // dump($project);die;

        $errors = $validator->validate($project);
        if (count($errors) > 0) {
            return $makeJson->json($errors);
            $errorsString = (string) $errors;
            // return new JsonResponse($errors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($project);
        $em->flush();

        return $this->forward('App\Controller\ProjectController::index');
    }

    /**
     * @Route("/{id}", name="project_show", methods="GET")
     */
    public function show(Project $project, MakeJson $makeJson): Response
    {
        return $makeJson->json($project);
    }

    /**
     * @Route("/{id}/edit", name="project_edit", methods="GET|POST")
     */
    public function edit(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('project_edit', ['id' => $project->getId()]);
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_delete", methods="DELETE")
     */
    public function delete(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
    }
}
