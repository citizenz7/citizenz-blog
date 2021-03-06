<?php

namespace App\twig;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use App\Repository\TagsRepository;
use App\Repository\UsersRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class sidebarExtension extends AbstractExtension
{
    /**
     * @var ArticlesRepository
     */
    private $articlesRepository;

    /**
     * @var CommentairesRepository
     */
    private $commentairesRepository;

    /**
     * @var CategoriesRepository
     */
    private $categoriesRepository;

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * @var TagsRepository
     */
    private $tagsRepository;


    /**
     * @var Environment
     */
    private $twig;


    public function __construct(
        ArticlesRepository $articlesRepository, 
        CommentairesRepository $commentairesRepository, 
        CategoriesRepository $categoriesRepository,
        UsersRepository $usersRepository,
        TagsRepository $tagsRepository,
        Environment $twig
    )
    {
        $this->articlesRepository = $articlesRepository;
        $this->commentairesRepository = $commentairesRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->usersRepository = $usersRepository;
        $this->tagsRepository = $tagsRepository;
        $this->twig = $twig;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('sidebar', [$this, 'getSidebar'], ['is_safe' => ['html']])
        ];
    }

    public function getSidebar(): string
    {
        $articles = $this->articlesRepository->popularArticles();
        $articlesAll = $this->articlesRepository->findAll();
        $commentaires = $this->commentairesRepository->lastComments();
        $commentairesAll = $this->commentairesRepository->findAll();
        $categories = $this->categoriesRepository->sidebarCategories();
        $users = $this->usersRepository->findAll();
        $vues = $this->articlesRepository->totalVues();
        $tags = $this->tagsRepository->findAll();

        // return $this->twig->render('home/sidebar.html.twig', [
        //     'articles' => $articles,
        //     'articlesAll' => $articlesAll,
        //     'commentaires' => $commentaires,
        //     'commentairesAll' => $commentairesAll,
        //     'categories' => $categories,
        //     'users' => $users,
        //     'vues' => $vues
        // ]);

        try {
            return $this->twig->render('home/sidebar.html.twig',
                compact('articles', 'articlesAll', 'commentaires', 'commentairesAll', 'categories', 'users', 'vues', 'tags'));
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
}
