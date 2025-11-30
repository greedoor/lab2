<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Voiture;
use App\Form\VoitureFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function listevoiture(VoitureRepository $vr): Response
    {
        $voitures = $vr->findAll();
        return $this->render('voiture/listevoiture.html.twig', [
            'listevoitures' => $voitures,
        ]);
    }

    #[Route('/voiture/add', name: 'add_voiture')]
    public function addVoiture(Request $request, EntityManagerInterface $em): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureFormType::class, $voiture);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();

            return $this->redirectToRoute('app_voiture');
        }

        return $this->render('voiture/addVoiture.html.twig', [
            'form' => $form->createView(),
            'editMode' => false,
        ]);
    }

    #[Route('/voiture/update/{id}', name: 'update_voiture')]
    public function updateVoiture(Voiture $voiture, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(VoitureFormType::class, $voiture);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            return $this->redirectToRoute('app_voiture');
        }

        return $this->render('voiture/addVoiture.html.twig', [
            'form' => $form->createView(),
            'editMode' => true,
        ]);
    }

    #[Route('/voiture/delete/{id}', name: 'delete_voiture')]
    public function deleteVoiture(Voiture $voiture, EntityManagerInterface $em): Response
    {
        $em->remove($voiture);
        $em->flush();

        return $this->redirectToRoute('app_voiture');
    }
}