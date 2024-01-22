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

}