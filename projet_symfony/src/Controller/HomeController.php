<?php

namespace App\Controller;


use stdClass;
use Faker\Factory;
use App\Entity\Fruit;
use App\Entity\Articles;
use Cocur\Slugify\Slugify;
use App\DataFixtures\AppFixtures;
use App\Repository\UserRepository;
use App\Repository\FruitRepository;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $manager,UserInterface $userInter, FruitRepository $repo,ArticlesRepository $artRepo): Response
    {


        // $user = $userInter;
        // $article = new Articles();
        // dd($article);
        // $user = $userInter;

        // $fruits= $repo ->findAll();
        $article = $artRepo->findLastArticle();
        // $slugify = new Slugify();
        // $article = $artRepo->findOneById(49);
        // $slug = $slugify->slugify($article->getTitle(). time());
        // dump($slug);




        // dump($fruits);
        // $slugify = new Slugify();
        // $article = $artRepo->findOneByIntro("Earum quam enim eum nostrum quia non et. Ipsam ab voluptatem odio sed et.");
        // $slug=slugify($articles->getTitle());
        // dump($article);

        // $pomme = new Fruit();
        // $pomme -> setName("pomme");
        // $pomme -> setColor("red");
        // $manager -> persist($pomme);
        // $manager -> flush();
        $auteur = ["symfony","Angular","Laravel"];
        $tableau = [$auteur,'menfou','palu'];
        $condition = 0;

        
        

        return $this->render('home/index.html.twig', [
            // 'fruits' => $fruits,
            'variable_controller' => 'HomeController',
            'auteur' => $auteur,
            'article' => $article,
            'tableau' => $tableau,
            'condition' => $condition,
            // 'slug' => $slug,
            // 'user' => $userInter,
        ]);
    }
}


