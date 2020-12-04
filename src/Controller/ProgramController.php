<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/programs", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
     * Correspond à la route /programs/ et au name "program_show"
     * @Route("/{id<^[0-9]+$>}/", methods={"GET"},requirements={"id"="\d+"}, name="show")
     * @param int $id
     * @return Response
     */
    public function show(Program $program): Response
    {

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $program->getSeasons(),

        ]);
    }


    /**
     * Correspond à la route /programs/ et au name "program_show_season"
     * @Route("/{program}/seasons/{season}/", methods={"GET"},requirements={"program"="\d+", "season"="\d+"}, name="show_season")
     * @param int $id
     * @return Response
     */
    public function showSeason(Program $program, Season $season): Response
    {
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $season->getEpisodes(),
        ]);
    }
    /**
     * Correspond à la route /programs/ et au name "program_episode_show"
     * @Route("/{program}/seasons/{season}/episodes/{episode}/", methods={"GET"},requirements={"program"="\d+", "season"="\d+", "episode"="\d+"}, name="show_episode")
     * @param int $id
     * @return Response
     */
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }

}


