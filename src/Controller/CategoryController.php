<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Program;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */

class CategoryController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * Show all rows from Categories entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * Getting a program by id
     * Correspond à la route = /categories/{categoryName}, route_name = category_show
     * @Route("/{categoryName}", methods={"GET"}, name="show")
     * @return Response
     */

    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $category],
                ['id' => 'DESC'],
                3);

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program in '.$categoryName.' .'
            );
        }

        return $this->render('category/show.html.twig', [
            'programs' => $programs,
        ]);
    }


}