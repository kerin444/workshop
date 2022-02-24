<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\Client;
use App\Form\ClientType;
use App\Form\DeviceType;
use App\Repository\DeviceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/device')]
class DeviceController extends AbstractController
{

    #[Route('/', name: 'device_index', methods: ['GET'])]
    public function index(DeviceRepository $deviceRepository): Response
    {
        return $this->render('device/index.html.twig', [
            'devices' => $deviceRepository->findAll(),
        ]);
    }

    //Création d'un nouveau matériel en atelier (saisie du client)
    #[Route('/new', name: 'device_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $device = new Device();
        $device->setCreatedAt(new \DateTimeImmutable());
        $device->setCreatedBy($this->getUser());
        $options = [
            'step' => 0
        ];

        $form = $this->createForm(DeviceType::class, $device, $options);
        $form->handleRequest($request);

        //On vérifie si on doit créer un nouveau client
        if( !$device->getClient() )
        {
            $new_client = new Client();
            $form2 = $this->createForm(ClientType::class,$new_client);
            $form2->handleRequest($request);
            if ($form2->isSubmitted() && $form2->isValid()) {
                $entityManager->persist($new_client);
                $entityManager->flush();
                $device->setClient($new_client);
            }
        }
        if ($form->isSubmitted() && $form->isValid() && $device->getClient() instanceof Client) {
            $entityManager->persist($device);
            $entityManager->flush();
            return $this->redirectToRoute('device_edit1', ['id' => $device->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/new.html.twig', [
            'device' => $device,
            'form' => $form,
            'form2' => $form2
        ]);
    }

    //Saisie des informations sur le matériel et la panne
    #[Route('/{id}/edit1', name: 'device_edit1', methods: ['GET', 'POST'])]
    public function edit1(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        $options = [
            'step' => 1
        ];

        $form = $this->createForm(DeviceType::class, $device, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($device);
            $entityManager->flush();
            return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/edit1.html.twig', [
            'device' => $device,
            'form' => $form
        ]);
    }

    //Saisie du diagnostic, de la solution et du devis de réparation
    #[Route('/{id}/edit2', name: 'device_edit2', methods: ['GET', 'POST'])]
    public function edit2(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        $options = [
            'step' => 2
        ];

        $form = $this->createForm(DeviceType::class, $device, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($device);
            $entityManager->flush();
            return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/edit2.html.twig', [
            'device' => $device,
            'form' => $form
        ]);
    }

    //Saisie des relances et du feeback client
    #[Route('/{id}/edit3', name: 'device_edit3', methods: ['GET', 'POST'])]
    public function edit3(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        $options = [
            'step' => 3
        ];

        $form = $this->createForm(DeviceType::class, $device, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($device);
            $entityManager->flush();
            return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/edit3.html.twig', [
            'device' => $device,
            'form' => $form
        ]);
    }

    #[Route('/{id}/edit4', name: 'device_edit4', methods: ['GET', 'POST'])]
    public function edit4(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        $options = [
            'step' => 4
        ];

        $form = $this->createForm(DeviceType::class, $device, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($device);
            $entityManager->flush();
            return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/edit3.html.twig', [
            'device' => $device,
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'device_show', methods: ['GET'])]
    public function show(Device $device): Response
    {
        return $this->render('device/show.html.twig', [
            'device' => $device,
        ]);
    }

    #[Route('/{id}/edit', name: 'device_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/edit.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'device_delete', methods: ['POST'])]
    public function delete(Request $request, Device $device, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$device->getId(), $request->request->get('_token'))) {
            $entityManager->remove($device);
            $entityManager->flush();
        }

        return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
    }
}
