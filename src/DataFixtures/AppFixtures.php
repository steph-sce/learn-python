<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use \Faker;
use App\Entity\Post;
use App\Entity\Image;
use App\Entity\Category;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        $categoryOne = new Category();
        $categoryOne->setName('Initiation')
                    ->setParent(null);

        $categoryTwo = new Category();
        $categoryTwo->setName('Perfectionnement')
                    ->setParent(null);

        $manager->persist($categoryOne);
        $manager->persist($categoryTwo);        

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setPostType('vidéo');
            $post->setTitle($faker->text(10));
            $post->setDuration($faker->numberBetween($min = 1, $max = 30));
            $post->setPrice($faker->randomNumber(3));
            $post->setContent($faker->text(40));
            $post->setStatus('open');
            $post->setLinkVideo('https://www.youtube.com/embed/videoseries?list=PLMS9Cy4Enq5JmIZtKE5OHJCI3jZfpASbR');
            $post->setDate($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null));            

            $image = new Image();
            $image->setTitle($faker->text(10));
            $image->setDimension("200 / 300");
            $image->setLinkImage('https://picsum.photos/200/300?image=' . $i);
            $post->setImage($image);            

            $category = new Category();
            $nameCategorie = array(
                'Les bases',
                'Les classes',
                'Les objets',
                'La syntaxe',
                'L\'environnement',
                'La structure',
                'Le déploiement',
                'La gestion d\'erreur',
                'Le language',
                'L\'apprentissage'
            );
            $category->setName($nameCategorie[$i]);
             
            $category->setParent($categoryOne);
            $post->addCategory($category);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
