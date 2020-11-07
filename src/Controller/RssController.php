<?php

namespace App\Controller;

use App\Rss\Rss;
use App\Entity\Articles;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RssController extends AbstractController
{
    /**
     * @Route("/rss", name="rss_feed")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rssAction()
    {
        //Renvoie les 5 derniers articles classés par date
        $articles = $this->getDoctrine()->getRepository(Articles::class)->findBy([],['created_at' => 'DESC'], 5);

        $response = new Response();
        $response->headers->set("Content-type", "text/xml");
        $response->setContent(Rss::generate($articles));
        return $response;

    }
}