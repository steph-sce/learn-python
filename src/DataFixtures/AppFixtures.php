<?php

namespace App\DataFixtures;

use \Faker;
use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // Categorie de niveau NULL
        $categoryOne = new Category();
        $categoryOne->setName('Initiation')
                    ->setParent(null);

        $categoryTwo = new Category();
        $categoryTwo->setName('Perfectionnement')
                    ->setParent(null);

        // Categories initiation
        $categoryInitOne = new Category();
        $categoryInitOne->setName('Introduction')
                    ->setParent($categoryOne);

        $categoryInitTwo = new Category();
        $categoryInitTwo->setName('Les structures de données')
                    ->setParent($categoryOne);
        
        $categoryInitThree = new Category();
        $categoryInitThree->setName('Les classes')
                    ->setParent($categoryOne);        

        // Categories perfectionnement
        $categoryPerfOne = new Category();
        $categoryPerfOne->setName('Lambda')
                    ->setParent($categoryTwo);

        $categoryPerfTwo = new Category();
        $categoryPerfTwo->setName('Compréhension de liste')
                    ->setParent($categoryTwo);
        
        $categoryPerfThree = new Category();
        $categoryPerfThree->setName('Décorateur')
                    ->setParent($categoryTwo);

        // Categorie de niveau NULL        
        $manager->persist($categoryOne);
        $manager->persist($categoryTwo);    
        
        // Categories initiation        
        $manager->persist($categoryInitOne);        
        $manager->persist($categoryInitTwo);        
        $manager->persist($categoryInitThree); 
        
        // Categories perfectionnement        
        $manager->persist($categoryPerfOne);        
        $manager->persist($categoryPerfTwo);        
        $manager->persist($categoryPerfThree);        

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
                'Données et variables',
                'Noms de variables et mots réservés',
                'Le point sur les chaînes de caractères',
                'Le point sur les listes',
                'Utilité des classes',
                'Définition d’une classe élémentaire',
                'Expressions lambda',
                'Métaprogrammation – expressions lambda',
                'Les listes (première approche).',
                'Contrôle du flux – utilisation d’une liste simple',
                'Créer un décorateur python',
                'Plusieurs décorateurs'
            );
            $category->setName($nameCategorie[$i]);
             
            $category->setParent($categoryOne);
            $post->addCategory($category);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
