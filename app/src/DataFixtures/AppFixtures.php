<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\House;
use App\Entity\Category;
use App\Entity\Equipements;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale: 'fr_FR');
        $this->loadEquipments($manager);
        $this->loadCategory($manager);
        $this->loadHouses($manager);
        $manager->flush();
    }

    public function loadEquipments(ObjectManager $manager): void
    {
//tableau
     $equipements = [
 ['label'=>'WiFi'],
   [ 'label'=>'Télévision'],
   ['label'=>'Cuisine équipée'],
   [ 'label'=>'Climatisation'],
   [ 'label'=>'Chauffage'],
   [ 'label'=>'Lave-linge'],
   [ 'label'=>'Sèche-linge'],
   [ 'label'=>'Parking'],
   ['label'=>'Salle de sport'],
  [  'label'=>'Piscine'],
  [ 'label'=>'Jacuzzi'],
   [ 'label'=>'Sauna'],
   ['label'=>'Terrasse/Balcon'],
  [ 'label'=>'Jardin'],
  [ [ 'label'=>'Cheminée'],
   ['label'=>'Lit bébé'],
   [ 'label'=>'Chaise haute pour bébé'],
   [ 'label'=>'Détecteur de fumée'],
  [ 'label'=>'Trousse de premiers secours'],
  [ 'label'=>'Extincteur'],
 [   'label'=>'Entrée privée'],
  [  'label'=>'Alarme de sécurité'],
  [ 'label'=>'Coffre-fort'],
  [ 'label'=>'Bureau de travail'],
  ['label'=>'Connexion Internet filaire'],
  [ 'label'=>'Console de jeux'],
  [ 'label'=>'Livres et jeux de société'],
   'label'=>'Lecteur DVD'],
  [ 'label'=>'Chaînes câblées'],
   ['label'=>'Aspirateur'],
  [ 'label'=>'Fer à repasser'],
   ['label'=>'Sèche-cheveux'],
  [ 'label'=>'Linge de maison'],
  [ 'label'=>'Serviettes'],
  ['label'=>'Articles de toilette de base'],
   ['label'=>'Machine à café'],
  [ 'label'=>'Bouilloire'],
  [ 'label'=>'Grille-pain'],
  [ 'label'=>'Mixeur'],
  [ 'label'=>'Micro-ondes'],
   ['label'=>'Four'],
  [ 'label'=>'Plaques de cuisson'],
  [ 'label'=>'Ustensiles de cuisine'],
   ['label'=>'Vaisselle et couverts'],
  [ 'label'=>'Lave-vaisselle'],
   ['label'=>'Réfrigérateur'],
   [ 'label'=>'Congélateur'],
  [  'label'=>'Espace de travail adapté aux ordinateurs portables'],
  [ 'label'=>'Vue sur la mer/montagne/ville']
];


        foreach ($equipements as $equipement) {
            $Equipement = new Equipements();
            $Equipement->setLabel($equipement['label']);
            $manager->persist($Equipement);
        }
    }

    public function loadCategory(ObjectManager $manager): void

    {
        $category = [
            ['label'=>'Cabane'],
   [ 'label'=>'Camping'],
   ['label'=>'Chateau'],
   [ 'label'=>'Bord de mer'],
   [ 'label'=>'Surf'],
        ];

        foreach ($category as $category) {
            $Category = new Category();
            $Category->setLabel($category['label']);
            $manager->persist($Category);
        }
    }


    public function loadHouses(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setLabel('Cabane');
        
        // Créer une maison
        $house = new House();
        $house->setName('Cabane');
        $house->setDescription('Cabane de campagne');
        $house->setCategory($category);
        $house->setImagePath('public/images/cabane.jpg'); 
        $house->setNumberGuest(2);
        $house->setNumberRooms(1);

        // Persistez les entités
        $manager->persist($category);
        $manager->persist($house);

    }
}
