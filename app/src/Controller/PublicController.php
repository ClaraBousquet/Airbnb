<?php

namespace App\Controller;

use App\Entity\House;
use App\Repository\AnnonceRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EquipementsRepository;
use App\Repository\HouseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicController extends AbstractController
{

    private $equipementsRepo;
    private $annoncesRepo;
    private $categoryRepo;
    private $houseRepo;

    public function __construct(EquipementsRepository $equipementsRepo , AnnonceRepository $annoncesRepo, CategoryRepository $categoryRepo, HouseRepository $houseRepo)
    {
        $this->equipementsRepo = $equipementsRepo;
        $this->annoncesRepo = $annoncesRepo;
        $this->categoryRepo = $categoryRepo;
        $this->houseRepo = $houseRepo;
    }

    #[Route('/accueil', name: 'accueil')]
  public function index()
  {
      return $this->render('public/accueil.html.twig', [
        "house"=> $this->houseRepo->findAll(),
      ]);
  }


#[Route('/userAccount', name: 'userAccount')]
public function userAccount()
{
    return $this->render('public/userAccount.html.twig');
}


#[Route('/listcabane', name: 'listcabane')]
  public function Listcabane(HouseRepository $houseRepo, CategoryRepository $categoryRepo)
  {
    $cabaneCategory = $categoryRepo->findOneBy(['label' => 'cabane']);

    if ($cabaneCategory) {
        $houses = $houseRepo->findBy(['category' => $cabaneCategory]);
    } else {
        $houses = [];
    }
      return $this->render('public/listCabane.html.twig',[
    "houses"=> $houses,
      ]);

  }

  #[Route('/listcamping', name: 'listcamping')]
  public function Listcamping(HouseRepository $houseRepo, CategoryRepository $categoryRepo)
  {
     $campingCategory = $categoryRepo->findOneBy(['label' => 'camping']);

    if ($campingCategory) {
        $houses = $houseRepo->findBy(['category' => $campingCategory]);
    } else {
        $houses = [];
    }
      return $this->render('public/listCamping.html.twig',[
      "houses"=> $houses,
      ]);
  }

 #[Route('/listsurf', name: 'listsurf')]
  public function Listsurf(HouseRepository $houseRepo, CategoryRepository $categoryRepo)
  {
 $surfCategory = $categoryRepo->findOneBy(['label' => 'surf']);

    if ($surfCategory) {
        $houses = $houseRepo->findBy(['category' => $surfCategory]);
    } else {
        $houses = [];
    }
      return $this->render('public/listSurf.html.twig',[
      "houses"=> $houses,
      ]);  }

 #[Route('/listmer', name: 'listmer')]
  public function Listmer(HouseRepository $houseRepo, CategoryRepository $categoryRepo)
  {
$merCategory = $categoryRepo->findOneBy(['label' => 'Bord de mer']);

    if ($merCategory) {
        $houses = $houseRepo->findBy(['category' => $merCategory]);
    } else {
        $houses = [];
    }
      return $this->render('public/listMer.html.twig',[
      "houses"=> $houses,
      ]);  }

 #[Route('/listchateau', name: 'listchateau')]
  public function Listchateau(HouseRepository $houseRepo, CategoryRepository $categoryRepo)
  {
$chateauCategory = $categoryRepo->findOneBy(['label' => 'chateau']);

    if ($chateauCategory) {
        $houses = $houseRepo->findBy(['category' => $chateauCategory]);
    } else {
        $houses = [];
    }
      return $this->render('public/listChateau.html.twig',[
      "houses"=> $houses,
      ]);   }


#[Route('/login', name: 'login')]
public function login()
{
    return $this->render('public/login.html.twig');
}


#[Route('/formLogement', name: 'formLogement')]
public function formLogement()
{
    return $this->render('public/formLogement.html.twig', [
    "equipements"=> $this->equipementsRepo->findAll(),
    "category"=>$this->categoryRepo->findAll(),
    "annonce"=> $this->annoncesRepo->findAll(),
    ]);
}


#[Route('/submitLogement', name: 'submitLogement')]
public function submitLogement(Request $request, EntityManagerInterface $entityManager)
{
    $house = new House();

   
    
    $entityManager->flush();


    return $this->redirectToRoute('accueil');
}
 
}