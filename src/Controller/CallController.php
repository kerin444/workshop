<?php

namespace App\Controller;

use App\Entity\Call;
use App\Form\CallType;
use App\Repository\CallRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/call')]
class CallController extends AbstractController
{
    #[Route('/', name: 'call_index', methods: ['GET'])]
    public function index(CallRepository $callRepository): Response
    {
        return $this->render('call/index.html.twig', [
            'calls' => $callRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'call_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $call = new Call();
        $form = $this->createForm(CallType::class, $call);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($call);
            $entityManager->flush();

            return $this->redirectToRoute('call_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('call/new.html.twig', [
            'call' => $call,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'call_show', methods: ['GET'])]
    public function show(Call $call): Response
    {
        return $this->render('call/show.html.twig', [
            'call' => $call,
        ]);
    }

    #[Route('/{id}/edit', name: 'call_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Call $call, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CallType::class, $call);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('call_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('call/edit.html.twig', [
            'call' => $call,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'call_delete', methods: ['POST'])]
    public function delete(Request $request, Call $call, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$call->getId(), $request->request->get('_token'))) {
            $entityManager->remove($call);
            $entityManager->flush();
        }

        return $this->redirectToRoute('call_index', [], Response::HTTP_SEE_OTHER);
    }
}
