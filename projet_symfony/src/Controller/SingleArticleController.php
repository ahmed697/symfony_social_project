<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SingleArticleController extends AbstractController
{
    #[Route('/single/{slug}', name: 'app_single_article')]
    public function index($slug ,ArticlesRepository $article, Articles $articles, UserInterface $userInter): Response
    {
        $sgl_article = $article->findOneBySlug($slug);


        return $this->render('single_article/index.html.twig', [
            'controller_name' => 'SingleArticleController',
            'articles'=>$articles,
            'article' => $sgl_article,
            'userInter' => $userInter,
        ]);
    }
}
