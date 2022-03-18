<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\AdherentType;
use App\Repository\AdherentRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/adherent')]
class AdherentController extends AbstractController
{
    #[Route('/', name: 'adherent', methods: 'GET')]
    public function index(AdherentRepository $adherentRepository): Response
    {
        return $this->render('adherent/index.html.twig', [
            'adherent' => $adherentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'adherent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdherentRepository $adherentRepository): Response
    {
        $adherent = new Adherent();
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adherentRepository->add($adherent);
            return $this->redirectToRoute('adherent', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adherent/new.html.twig', [
            'adherent' => $adherent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'adherent_show', methods: ['GET'])]
    public function show(Adherent $adherent): Response
    {
        return $this->render('adherent/show.html.twig', [
            'adherent' => $adherent,
        ]);
    }


    #[Route('/{id}/edit', name: 'adherent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adherent $adherent, AdherentRepository $adherentRepository): Response
    {
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adherentRepository->add($adherent);
            return $this->redirectToRoute('adherent', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adherent/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form,
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/{id}', name: 'adherent_delete', methods: ['POST'])]
    public function delete(Request $request, Adherent $adherent, AdherentRepository $adherentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getId(), $request->request->get('_token'))) {
            $adherentRepository->remove($adherent);
        }

        return $this->redirectToRoute('adherent', [], Response::HTTP_SEE_OTHER);
    }




}
