<?php

namespace App\Controller;

use App\Entity\House;
use App\Form\HouseType;
use App\Repository\HouseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\Loader\Configurator\session;

#[Route('/house')]
class HouseController extends AbstractController
{
    #[Route('/', name: 'app_house_index', methods: ['GET'])]
    public function index(HouseRepository $houseRepository): Response
    {
        return $this->render('house/index.html.twig', [
            'houses' => $houseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_house_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $house = new House();
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $imageFile = $form->get('imagePath')->getData();
        if ($imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            try {
                $imageFile->move(
                    $this->getParameter('dossier_images'), // Paramètre à définir dans config/services.yaml
                    $newFilename
                );
            } catch (FileException $e) {
                dd($e);
                 $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
            }

            // Mettre à jour la propriété avec le nom de fichier
            $house->setImagePath($newFilename);
        }

            $entityManager->persist($house);
            $entityManager->flush();

             $userHouses = $session->get('user_houses', []);

              // Ajouter la nouvelle maison à la liste
        $userHouses[] = $house;

          // Mettre à jour la session avec la liste mise à jour
        $session->set('user_houses', $userHouses);

            return $this->redirectToRoute('app_house_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('house/new.html.twig', [
            'house' => $house,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_house_show', methods: ['GET'])]
    public function show(House $house): Response
    {
        return $this->render('house/show.html.twig', [
            'house' => $house,
        ]);
    }


#[Route('/{id}/details', name: 'app_house_details', methods: ['GET'])]
    public function houseDetails(House $house, int $id)
    {
        return $this->render('public/houseDetail.html.twig', [
            'house' => $house,
            'id' => $id
        ]);
    }

#[Route('/{id}/reserve', name: 'app_house_reserve', methods: ['POST'])]
public function reserveHouse(House $house, SessionInterface $session)
{
    // Récupérez la liste actuelle des réservations de l'utilisateur depuis la session
    $userReservations = $session->get('user_reservations', []);

    // Ajoutez la maison réservée à la liste des réservations
    $userReservations[] = $house->getId();

    // Mettez à jour la session avec la nouvelle liste de réservations
    $session->set('user_reservations', $userReservations);

    // Redirigez l'utilisateur vers la page de détails de la maison ou toute autre page appropriée
    // Vous pouvez également afficher un message de confirmation ici
    return $this->redirectToRoute('app_house_details', ['id' => $house->getId()]);
}

    #[Route('/{id}/edit', name: 'app_house_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, House $house, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_house_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('house/edit.html.twig', [
            'house' => $house,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_house_delete', methods: ['POST'])]
    public function delete(Request $request, House $house, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$house->getId(), $request->request->get('_token'))) {
            $entityManager->remove($house);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_house_index', [], Response::HTTP_SEE_OTHER);
    }


#[Route('/reservation', name: 'reservation')]
public function reservation(SessionInterface $session)
{
    $userHouses = $session->get('user_houses', []);
    return $this->render('public/reservations.html.twig', [
        'reservations' => $userHouses,
    ]);
}
}
