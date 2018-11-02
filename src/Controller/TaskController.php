<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\MakeJson;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * @Route("/task")
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/{what}/{user}", name="task_index", methods="GET",
     * defaults={"what": "all", "user": null})
     */
    public function index(TaskRepository $taskRepository, MakeJson $makeJson, $what, $user): Response
    {
        return $makeJson->json($taskRepository->what($what, $user), array('project'));
    }

    /**
     * @Route("/", name="task_new", methods="POST")
     */
    public function new(Request $request, ValidatorInterface $validator, MakeJson $makeJson): Response
    {
        $body = json_decode($request->getContent(), true);       
   
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->submit($body);
        $task->setDate(new \DateTime($body['date']));

        // dump($body, $task);

        $errors = $validator->validate($task);
        if (count($errors) > 0) {
            return $makeJson->json($errors);
            $errorsString = (string) $errors;
            // return new JsonResponse($errors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return $this->forward('App\Controller\TaskController::index');

    }

    /**
     * @Route("/{id}", name="task_show", methods="GET")
     */
    public function show(Task $task, MakeJson $makeJson): Response
    {
        return $makeJson->json($task, array('project'));
        // return $this->render('task/show.html.twig', ['task' => $task]);
    }

    /**
     * @Route("/{id}", name="task_edit", methods="PUT")
     */
    public function edit(Request $request, Task $task, MakeJson $makeJson, ValidatorInterface $validator): Response
    {
        $body = json_decode($request->getContent(), true);       
        $form = $this->createForm(TaskType::class, $task);
        $form->submit($body);
        $task->setDate(new \DateTime($body['date']));

        // dump($body, $task);

        $errors = $validator->validate($task);
        if (count($errors) > 0) {
            return $makeJson->json($errors);
            $errorsString = (string) $errors;
            // return new JsonResponse($errors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->forward('App\Controller\TaskController::show', array(
            'id'  => $task->getId()
        ));
    }

    /**
     * @Route("/{id}", name="task_delete", methods="DELETE")
     */
    public function delete(Request $request, Task $task): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
        }

        return $this->redirectToRoute('task_index');
    }
}
