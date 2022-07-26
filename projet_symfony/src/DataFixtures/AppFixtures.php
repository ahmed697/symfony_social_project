<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Fruit;
use App\Entity\Articles;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager):void
    {
        $users= [];
        $faker = Factory::create();
        // $faker = faker();
        for ($index = 1 ;$index <= 10 ; $index++){
        $user = new User();
        $user = 
        // $picture = "https://randomuser.me/api/portraits/men/";
        // $pictureId = $faker->numberBetween(1,99). '.jpg';

        $user->setUsername($faker->sentence(1))
             ->setEmail($faker->email)
             ->setPassword("password");
        


        $manager->persist($user);
        $users[] = $user;
        }
        for ($i=1;$i<=20;$i++){
            $article = new Articles();
            $title = $faker->sentence(2);
            $image = "https://source.unsplash.com/random/200x200?sig=".$i;
            $intro = $faker->paragraph(2);
            // $content = $faker->paragraphs(5);
            $author = $users[mt_rand(0,count($users)-1)];

            $article->setTitle($title)
                    ->setImage($image)
                    ->setIntro($intro)
                    ->setContent($faker->paragraph(2))
                    ->setAuthor($author);

            $manager->persist($article);



        }
        $manager->flush();
    }
}