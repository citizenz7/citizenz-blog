<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Entity\Commentaires;
use App\Form\CommentaireType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="articles_index", methods={"GET"})
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // On set la date de l'article à MAINTENANT
            $article->setCreatedAt(new \DateTime())

            // On récupère l'utilisateur connecté
            ->setAuteur($this->getUser());

            // On set le nb de vues à 1 lorsqu'on crée l'article
            $article->setVues('1');

            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="articles_show", methods={"GET","POST"})
     * @param Articles $article
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function show(Articles $article, Request $request, EntityManagerInterface $manager): Response
    {
        $newview = $article->getVues() + 1;
        $article->setVues($newview);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($article);
        $entityManager->flush();

        $commentaire = new Commentaires();

        $form = $this->createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setCreatedAt(new \DateTime())
                    ->setArticle($article)
                    // On récupère l'utilisateur connecté
                    ->setAuteur($this->getUser());

            $manager->persist($commentaire);
            $manager->flush();

            return $this->redirectToRoute('articles_show', [
                'slug' => $article->getSlug()
            ]);
        }

        return $this->render('articles/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="articles_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Articles $article
     * @return Response
     */
    public function edit(Request $request, Articles $article): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUpdatedAt(new \DateTime());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="articles_delete", methods={"DELETE"})
     * @param Request $request
     * @param Articles $article
     * @return Response
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }


    // COMMENTAIRES //

    /**
     * @Route("/commentaires/{id}/edit", name="commentaires_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Commentaires $commentaire
     * @return Response
     */
    public function editCommentaire(Request $request, Commentaires $commentaire): Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('commentaires/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/commentaires/{id}", name="commentaires_delete", methods={"DELETE"})
     * @param Request $request
     * @param Commentaires $commentaire
     * @return Response
     */
    public function deleteCommentaires(Request $request, Commentaires $commentaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }

}
