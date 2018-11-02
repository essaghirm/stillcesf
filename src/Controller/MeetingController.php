<?php

namespace App\Controller;

use App\Entity\Meeting;
use App\Form\MeetingType;
use App\Repository\MeetingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\MakeJson;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/meeting")
 */
class MeetingController extends AbstractController
{
    /**
     * @Route("/{what}/{user}", name="meeting_index", methods="GET",
     * defaults={"what": "all", "user": null})
     */
    public function index(MeetingRepository $meetingRepository, MakeJson $makeJson, $what, $user): Response
    {
        return $makeJson->json($meetingRepository->what($what, $user), array('project'));
    }

    /**
     * @Route("/", name="meeting_new", methods="POST")
     */
    public function new(Request $request, ValidatorInterface $validator): Response
    {
        $body = json_decode($request->getContent(), true);
        $meeting = new Meeting();
        $form = $this->createForm(MeetingType::class, $meeting);
        $form->submit($body);
        $meeting->setDate(new \DateTime($body['date']));
        // dump($meeting);die;

        $errors = $validator->validate($meeting);
        if (count($errors) > 0) {
            return $makeJson->json($errors);
            $errorsString = (string) $errors;
            // return new JsonResponse($errors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($meeting);
        $em->flush();

        return $this->forward('App\Controller\MeetingController::index', array("what"=> "all", "user" => null));
        
    }

    /**
     * @Route("/{id}", name="meeting_show", methods="GET")
     */
    public function show(Meeting $meeting): Response
    {
        return $makeJson->json($meeting, array('project'));
    }

    /**
     * @Route("/{id}/edit", name="meeting_edit", methods="GET|POST")
     */
    public function edit(Request $request, Meeting $meeting): Response
    {
        $form = $this->createForm(MeetingType::class, $meeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meeting_edit', ['id' => $meeting->getId()]);
        }

        return $this->render('meeting/edit.html.twig', [
            'meeting' => $meeting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meeting_delete", methods="DELETE")
     */
    public function delete(Request $request, Meeting $meeting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meeting->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($meeting);
            $em->flush();
        }

        return $this->redirectToRoute('meeting_index');
    }
}
