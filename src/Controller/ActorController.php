<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use App\Form\ActorType;
use App\Entity\Season;
use App\Entity\Episode;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/actor", name="actor_")
 */
class ActorController extends AbstractController
{

    /**
     * @Route("/", name="index", methods={"GET"})
     * @param ActorRepository $actorRepository
     * @return Response
     */
    public function index(ActorRepository $actorRepository): Response
    {
        return $this->render('actor/index.html.twig', [
            'actors' => $actorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $actor = new Actor();
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actor);
            $entityManager->flush();

            return $this->redirectToRoute('actor_index');
        }

        return $this->render('actor/new.html.twig', [
            'actor' => $actor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Correspond à la route /actor/ et au name "actor_show"
     * @Route("/{id<^[0-9]+$>}/", methods={"GET"},requirements={"id"="\d+"}, name="show")
     * @param int $id
     * @return Response
     */
    public function show(Actor $actor): Response
    {

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'program' => $actor->getPrograms(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Actor $actor
     * @return Response
     */
    public function edit(Request $request, Actor $actor): Response
    {
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_index');
        }

        return $this->render('actor/edit.html.twig', [
            'actor' => $actor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Actor $actor
     * @return Response
     */
    public function delete(Request $request, Actor $actor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('actor_index');
    }
}


