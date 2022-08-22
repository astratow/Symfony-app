<?php

namespace App\Controller;

use App\Entity\Dish; //added object
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
        $dishEdit = $dishRepository->findAll();
        return $this->render('dish/index.html.twig', [
            'dishEdit' => $dishEdit
        ]);
    }
    //  new function and routing
    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine){
        $dish = new Dish();
        // set name property for Dish object
        $dish->setName('Pizza');

        // Entity Manager
        // $entityManager = doctrine->getManager();
        $entityManager = $doctrine->getManager();
        // new dish object
        $entityManager->persist($dish);
        // send data to database with flush method
        $entityManager->flush();
        // response
        return new Response('New Dish has been created.');
    }
}
