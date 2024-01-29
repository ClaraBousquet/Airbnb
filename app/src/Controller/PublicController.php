<?php

namespace App\Controller;

use App\Entity\House;
use App\Repository\UserRepository;
use App\Repository\HouseRepository;
use App\Repository\AnnonceRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EquipementsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PublicController extends AbstractController
{

    private $equipementsRepo;
    private $annoncesRepo;
    private $categoryRepo;
    private $houseRepo;
    private $userRepo;

    public function __construct(EquipementsRepository $equipementsRepo , AnnonceRepository $annoncesRepo, CategoryRepository $categoryRepo, HouseRepository $houseRepo, UserRepository $userRepo)
    {
        $this->equipementsRepo = $equipementsRepo;
        $this->annoncesRepo = $annoncesRepo;
        $this->categoryRepo = $categoryRepo;
        $this->houseRepo = $houseRepo;
        $this->userRepo = $userRepo;
    }

    #[Route('/accueil', name: 'accueil')]
  public function index()
  {
      return $this->render('public/accueil.html.twig', [
        "house"=> $this->houseRepo->findAll(),
      ]);
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


// #[Route('/login', name: 'login')]
// public function login(AuthenticationUtils $authenticationUtils): Response
// {
//             $error = $authenticationUtils->getLastAuthenticationError();
//             $lastUsername = $authenticationUtils->getLastUsername();
//     return $this->render('security/login.html.twig',[
//            "user"=> $this->userRepo->findAll(),
//            "error" => $error,
//            "email"=>$this->userRepo->findAll(),
//            "lastUsername" => $lastUsername,
           
//     ]);
 
// }

   #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
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


#[Route('/myHouses', name: 'myHouses')]
public function myHouses(SessionInterface $session)
{
    $userHouses = $session->get('user_houses', []);
    return $this->render('public/myHouses.html.twig', [
        'userHouses' => $userHouses,
    ]);
}

 
}