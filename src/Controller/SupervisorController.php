<?php

namespace App\Controller;

use App\Entity\Drivers;
use App\Form\DriversFormType;
use App\Repository\DriversRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupervisorController extends AbstractController
{
    private $em;
    private $driversRepository;

    public function __construct(DriversRepository $driversRepository, EntityManagerInterface $em){
        $this->driversRepository = $driversRepository;
        $this->em = $em;
    }

    #[Route('/supervisor', name: 'supervisor')]
    public function index(): Response
    {
        $drivers = $this->driversRepository->findAll();

        return $this->render('pages/index.html.twig', [
            'drivers' => $drivers
        ]);
    }

    #[Route('/supervisor/create', name: 'create_driver')]
    public function create(Request $request): Response
    {
        $driver = new Drivers();
        $form = $this->createForm(DriversFormType::class, $driver);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newDriver = $form->getData();

            $this->em->persist($newDriver);
            $this->em->flush();

            return $this->redirectToRoute('supervisor');
        }

        return $this->render('pages/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/supervisor/edit/{id}', name: 'edit_driver')]
    public function edit($id, Request $request): Response
    {
        $driver = $this->driversRepository->find($id);
        $form = $this->createForm(DriversFormType::class, $driver);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $driver->setName($form->get('name')->getData());
            $driver->setWorkDays($form->get('workDays')->getData());
            $driver->setVehicle($form->get('vehicle')->getData());

            $this->em->flush();
            return $this->redirectToRoute('supervisor');
        }

        return $this->render('pages/edit.html.twig', [
            'driver' => $driver,
            'form' => $form->createView()
        ]);
    }

    #[Route('/supervisor/delete/{id}', methods: ['POST'], name: 'delete_driver')]
    public function delete($id, Request $request): Response
    {
        if ($request->get('_method', 'POST') !== 'DELETE'){
            throw new \Exception('Vous ne pouvez pas supprimer ce conducteur !', 409);
        }
        $driver = $this->driversRepository->find($id);
        $this->em->remove($driver);
        $this->em->flush();

        return $this->redirectToRoute('supervisor');
    }
}
