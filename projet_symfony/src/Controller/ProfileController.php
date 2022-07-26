<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\UserRepository;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function index(ArticlesRepository $articleRepo,UserRepository $userRepo, UserInterface $userInter, $id): Response
    {
        $user = $userRepo->findOneById($id);
        
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'user'=>$user,
            'article' => $articleRepo,
        ]);
    }
}
