<?php

namespace App\Controller;

use App\Entity\Dish; //added object
use App\Form\DishType;
use App\Repository\DishRepository;
use Doctrine\Persistence\ManagerRegistry as ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dish', name: 'dish.')]
class DishController extends AbstractController
{
    #[Route('/', name: 'edit')]
    public function index(DishRepository $dishRepository): Response
    {
        $dishes = $dishRepository->findAll();
        return $this->render('dish/index.html.twig', [
            'dishes' => $dishes
        ]);
    }
    //  new function and routing
    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine){
        $dish = new Dish();
        // form
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            // $dish = $form->getData();
            // Entity Manager
            // $entityManager = doctrine->getManager();
            $entityManager = $doctrine->getManager();
            // new dish object
            $entityManager->persist($dish);
            // send data to database with flush method
            $entityManager->flush();
            return $this->redirect($this->generateUrl('dish.create'));
        }
        // $dish->setDescription('Italian dish, dough base with meat/veges/cheese/seafood on top');
        
        // response
        return $this->render('dish/create.html.twig', [
            'createForm' => $form->createView()
        ])
        // new Response('New Dish has been created.');
        ;}
    #[Route('/delete/{id}', name: 'delete')]
    public function delete($id, DishRepository $dishRepository, ManagerRegistry $doctrine)
    {
        // Entity Manager

        $entityManager = $doctrine->getManager();
        $dish = $dishRepository->find($id);
        $entityManager->remove($dish);
        $entityManager->flush();
        $this->addFlash('success', 'Dish was removed successfuly');
        return $this->redirect($this->generateUrl('dish.create'));

    }

}
