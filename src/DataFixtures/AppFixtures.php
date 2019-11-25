<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 20; $i++) {
            $post = new Post('article ' . $i, 'lorem ipsum', 'image' . $i . '.jpg', new \DateTime('now'), 'categorie' . rand(1, 4));
            $manager->persist($post);
            $manager->flush();

            for($j = 1; $j <= rand(3,6); $j++) {
                $comment = new Comment('user' . rand(1, 100), 'lorem ipsum', $post->getId(), new \DateTime('now'));

                $manager->persist($comment);
            }

        }

        $manager->flush();
    }
}
