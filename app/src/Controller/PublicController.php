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
      return $this->render('public/accueil.html.twig');
  }


#[Route('/userAccount', name: 'userAccount')]
public function userAccount()
{
    return $this->render('public/userAccount.html.twig');
}


#[Route('/listcabane', name: 'listcabane')]
  public function Listcabane()
  {
      return $this->render('public/listCabane.html.twig',[
    "houses"=> $this->houseRepo->findAll(),
      ]);

  }

  #[Route('/listcamping', name: 'listcamping')]
  public function Listcamping()
  {
      return $this->render('public/listCamping.html.twig');
  }

 #[Route('/listsurf', name: 'listsurf')]
  public function Listsurf()
  {
      return $this->render('public/listSurf.html.twig');
  }

 #[Route('/listmer', name: 'listmer')]
  public function Listmer()
  {
      return $this->render('public/listMer.html.twig');
  }

 #[Route('/listchateau', name: 'listchateau')]
  public function Listchateau()
  {
      return $this->render('public/listChateau.html.twig');
  }


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


// #[Route('/submitLogement', name: 'submitLogement')]
// public function submitLogement(Request $request, EntityManagerInterface $entityManager)
// {
//     $house = new House();

//     $form = $this->createForm(House::class, $house);

//     $form->handleRequest($request);

//     if($form->isSubmitted() && $form->isValid())
//     {
//         foreach ($house->getImages() as $image) 
//         {
//             $image->setHouse($house);
//             $entityManager->persist($image);
//         }

// $house->setName($this->)
    
//     $entityManager->flush();


//     return $this->redirectToRoute('accueil');
// }
 
 }