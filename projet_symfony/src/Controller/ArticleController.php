<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticleType;
use Cocur\Slugify\Slugify;
use App\DataFixtures\AppFixtures;
use App\Repository\UserRepository;
use App\Repository\ArticlesRepository;
use phpDocumentor\Reflection\Location;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
   
    public function index(ArticlesRepository $articleRepo,UserInterface $userInter, UserRepository $userRepo): Response
    {
        $article = $articleRepo->findAll();
        $user = $userRepo->findAll();

        // return $this->json(['username' => 'jane.doe']);
        
        // dd($article);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article'=> $article,
            // 'slug' => $slug,
            'user' => $user,
            'userInter' => $userInter,
        ]);
    }
    #[Route('/article/new', name: 'app_new_article')]
    public function create(Request $request,EntityManagerInterface $manager,UserInterface $userInter)
    {
        
        $article = new Articles();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        // dd($article);
        if ($form->isSubmitted() && $form->isValid()) {
            $article->setAuthor($this->getUser());
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('app_single_article', ['slug' => $article->getSlug()]);
        }


        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
            'userInter' => $userInter,
        ]);
    }
}
