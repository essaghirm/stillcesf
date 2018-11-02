<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\MakeJson;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service_index", methods="GET")
     */
    public function index(ServiceRepository $serviceRepository, MakeJson $makeJson): Response
    {
        return $makeJson->json($serviceRepository->findAll(), null);
    }

    /**
     * @Route("/project/{id}", name="services_by_project", methods="GET")
     */
    public function servicesByProject(ServiceRepository $serviceRepository, MakeJson $makeJson, $id): Response
    {
        // return $makeJson->json($serviceRepository->findAll(), null);
        return $makeJson->json($serviceRepository->servicesByProject($id), array('project'));
    }
    

    /**
     * @Route("/new", name="service_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('service_index');
        }

        return $this->render('service/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_show", methods="GET")
     */
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', ['service' => $service]);
    }

    /**
     * @Route("/{id}/edit", name="service_edit", methods="GET|POST")
     */
    public function edit(Request $request, Service $service): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('service_edit', ['id' => $service->getId()]);
        }

        return $this->render('service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_delete", methods="DELETE")
     */
    public function delete(Request $request, Service $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();
        }

        return $this->redirectToRoute('service_index');
    }
}
