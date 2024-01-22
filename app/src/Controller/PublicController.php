<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicController extends AbstractController
{

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
      return $this->render('public/listCabane.html.twig');
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

}