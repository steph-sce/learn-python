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
            $postTitle = array (
                'La fonction print().',
                'Le type float',
                'Le type integer',
                'Le type string ',
                'Les données numériques',
                'Modules de fonctions',
                'Typage des paramètres',
                'Calculer avec Python',
                'Données et variables',
                'Priorité des opérations',
                'Opérateurs et expressions',
                'Affectations multiples'
            );
            $post->setTitle($postTitle[$i]);
            $post->setDuration($faker->numberBetween($min = 1, $max = 30));
            $post->setPrice($faker->randomNumber(3));
            $contentPost = array(
                'Les structures de données en Python permettent de regrouper différents types d\'objets Python, de stocker les données de manière structurée et d\'y accéder de manière efficace. L\'objectif de ce chapitre est d\'explorer ensemble la construction de listes, la création de dictionnaires, ou encore l\'utilisation des compréhensions et des générateurs pour encore plus d\'efficacité. Commençons sans plus tarder avec les listes. Il s\'agit de conteneurs très polyvalents, utiles dans de nombreuses circonstances.',
                'À présent, il s\'agit d\'aborder des opérations avancées que nous pouvons effectuer sur les listes. Prenons d\'abord une liste, maListe1, constituée des éléments suivants. La fonction count permet de compter le nombre d\'occurences d\'un élément donné. Par exemple ici, \'a\' se répète deux fois. Nous pouvons aussi récupérer l\'indice d\'un élément en utilisant la fonction index. S\'il y a plusieurs occurrences, nous obtiendrons alors l\'indice du premier élément.',
                "Les éléments du dictionnaire sont accessibles et définis via la syntaxe d'indexation utilisée pour les listes. Sauf qu'ici, la différence est qu'il ne s'agit pas d'un nombre indiquant l'emplacement, mais plutôt d'une clé valide dans le dictionnaire. Regardons un exemple, et ici l'équipe 'Benatia' nous donne 'Juventus'. Gardez à l'esprit que le dictionnaire ne conserve aucun sens de l'ordre pour les paramètres d'entrée. Ceci permet justement un accès très rapide aux éléments du dictionnaire, quelle que soit la taille de ce dernier.",
                "Les compréhensions permettent aussi d'exécuter une fonction donnée sur chaque item d'une liste. Prenons l'exemple d'une conversion d'un entier en chaînes de caractères, toujours en utilisant la liste2. Et nous obtenons bien des chaînes de caractères. Encore une fois, cet exemple nous permet de comprendre l'utilité et l'efficacité des compréhensions. Prenons à présent un autre exemple, avec cette fois-ci un dictionnaire qui nous permettra d'accéder rapidement, à partir d'un entier pair compris entre 0 et 20, à celui-ci, multiplié par 2.",
                "Dans ce chapitre, nous allons nous intéresser désormais à NumPy. Il s'agit d'une extension de Python aussi libre d'utilisation, et constituant par ailleurs la base d'autres librairies de Python. La bibliothèque NumPy permet d'effectuer des calculs numériques, d'utiliser des tableaux multidimensionnels, ou encore des fonctions mathématiques de haut niveau. Pour résumer, il faut s'intéresser à NumPy car il s'agit d'une boîte à outils pour du calcul scientifique avec Python, considérée comme un module indispensable pour la data science et constituant le noyau de l'ensemble des outils de la data science en Python.",
                "L'objectif à présent est d'apprendre à créer des tableaux NumPy, à manipuler ces derniers pour accéder aux données, ou encore à scinder, remodeler et joindre des tableaux NumPy. Il s'agit ici des fondements de l'utilisation des tableaux NumPy, c'est-à-dire des techniques dont nous aurons besoin tout au long de ce chapitre. La première chose à faire est bien sûr l'importation de la bibliothèque NumPy. Nous utiliserons l'abréviation np, car nous aurons besoin d'appeler cette librairie plusieurs fois au cours de ce programme.",
                "Dans cette séquence, nous aborderons les techniques de concaténation et de division de tableaux NumPy, très utiles pour l'analyse de données. Commençons par les techniques de concaténation et prenons l'exemple d'un tableau ar, bien sûr après avoir importé comme d'habitude la bibliothèque NumPy. Voici donc notre tableau ar. Et puis nous stockons, dans un nouveau tableau ar1, la concaténation du tableau ar avec lui-même.",
                "L'objectif de ce chapitre est de montrer comment effectuer de manière efficace des calculs sur les tableaux Numpy. D'ailleurs optimiser le calcul avec des tableaux de données est une qualité qui rend Numpy indispensable pour faire de la Data science avec Python. En effet l'implémentation par défaut de Python effectue certaines opérations très lentement. Ceci se manifeste de manière claire dans des situations où de nombreuses opérations sont répétées, par exemple des boucles sur des tableaux pour opérer sur chaque élément.",
                "À présent nous nous intéressons à une autre manière d'indexation de tableau appelée l'indexation Fancy. La différence avec l'indexation classique est qu'ici nous passons des tableaux d'indices à la place de simples scalaires. Ceci permet d'accéder très rapidement et modifier des sous-ensembles compliqués des valeurs d'un tableau. Pour mieux comprendre, prenons un exemple. On commence toujours par importer la librairie Numpy, ensuite nous allons utiliser la fonction Random pour générer des valeurs aléatoires.",
                "Un Data analyste est souvent confronté à l'analyse d'une masse importante de données. Dans ce chapitre nous verrons ensemble des opérations simples permettant de mener efficacement une analyse statistique de base. Commençons comme d'habitude par importer la bibliothèque Numpy. Ensuite nous considérons un tableau contenant deux millions de valeurs aléatoires. Commençons alors avec la fonction Sum permettant d'obtenir la somme de toutes les valeurs d'un tableau.",
                "Dans ce qui précède, notre intérêt a plus porté sur les outils d'accès aux données de tableaux ainsi que la réalisation de calculs avec Numpy. Dans cette section nous nous intéressons désormais aux algorithmes liés au tri des valeurs dans les tableaux Numpy. En informatique les algorithmes pour trier les valeurs dans une liste ou un tableau ont toujours suscité beaucoup d'intérêt et ceci est dû à deux raisons principalement : leur utilité d'un côté et d'un autre côté leur durée d'exécution qui peut s'avérer importante.",
                "En data science, nous sommes souvent ramenés à manipuler des données hétérogènes. Cette section illustre l'utilisation des tableaux NumPy pour un stockage de données hétérogènes. Comme d'habitude, nous démarrons par l'importation de la bibliothèque NumPy. Ensuite, considérons les données d'un certain nombre d'étudiants, par exemple le nom, le prénom, le niveau ainsi que la moyenne. Nous aimerions stocker ces valeurs pour les utiliser dans un programme Python."
            );
            $post->setContent($contentPost[$i]);
            $postType = array (
                'vidéo',
                'post'
            );
            $randPostType = array_rand($postType);
            $post->setPostType($postType[$randPostType]);
            $postStatus = array (
                'open',
                'close'
            );
            $randPostStatus = array_rand($postStatus);
            $post->setStatus($postStatus[$randPostStatus]);
            $post->setLinkVideo('https://www.youtube.com/embed/videoseries?list=PLMS9Cy4Enq5JmIZtKE5OHJCI3jZfpASbR');
            $post->setDate($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null));            

            $image = new Image();
            $image->setTitle('image ' . $i);
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
            $categoryParent = array(
                $categoryInitOne,
                $categoryInitTwo,
                $categoryInitThree,
                $categoryPerfOne,
                $categoryPerfTwo,
                $categoryPerfThree
            );
            $randCategoryParent = array_rand($categoryParent);
            $category->setParent($categoryParent[$randCategoryParent]);
            $post->addCategory($category);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
