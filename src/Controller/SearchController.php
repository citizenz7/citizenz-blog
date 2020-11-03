<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     * @param Request $request
     * @param ArticlesRepository $repo
     * @param PaginatorInterface $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, ArticlesRepository $repo, PaginatorInterface $paginator)
    {

        $searchForm = $this->createForm(SearchType::class);
        $searchForm->handleRequest($request);
       
        //$donnees = $repo->findAll();
        $donnees = $repo->findArticles();

        if ($searchForm->isSubmitted() && $searchForm->isValid())
        {
            $titre = $searchForm->getData()->getTitre();
            $donnees = $repo->search($titre);
        }

        // Paginate the results of the query
        $articles = $paginator->paginate(
            $donnees, // Doctrine Query, not results
            $request->query->getInt('page', 1), // Define the page parameter
            10 // Items per page
        );

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'articles' => $articles,
            'current_menu' => 'recherche',
            'searchForm' => $searchForm->createView()
        ]);

    }
}