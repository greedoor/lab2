<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonController extends AbstractController
{
    #[Route('/person/new', name: 'person_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($person);
            $entityManager->flush();

            $this->addFlash('success', 'Person added successfully!');

            return $this->redirectToRoute('person_list');
        }

        return $this->render('person/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/person/list', name: 'person_list')]
    public function list(PersonRepository $personRepository): Response
    {
        $persons = $personRepository->findAll();

        return $this->render('person/list.html.twig', [
            'persons' => $persons,
        ]);
    }
}
