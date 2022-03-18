<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Entity\Jeu;
use App\Form\AdherentType;
use App\Form\JeuType;
use App\Repository\AdherentRepository;
use App\Repository\JeuRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/jeu')]
class JeuController extends AbstractController
{
    #[Route('/', name: 'jeu')]
    public function index(JeuRepository $jeuRepository): Response
    {
        return $this->render('jeu/index.html.twig', [
            'jeu' => $jeuRepository->findAll(),
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/new', name: 'jeu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, JeuRepository $jeuRepository): Response
    {
        $jeu = new Jeu();
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jeuRepository->add($jeu);
            return $this->redirectToRoute('jeu', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jeu/new.html.twig', [
            'jeu' => $jeu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'jeu_show', methods: ['GET'])]
    public function show(Jeu $jeu): Response
    {
        return $this->render('jeu/show.html.twig', [
            'jeu' => $jeu,
        ]);
    }


    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/{id}/edit', name: 'jeu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jeu $jeu, JeuRepository $jeuRepository): Response
    {
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jeuRepository->add($jeu);
            return $this->redirectToRoute('adherent', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jeu/edit.html.twig', [
            'jeu' => $jeu,
            'form' => $form,
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/{id}', name: 'jeu_delete', methods: ['POST'])]
    public function delete(Request $request, Jeu $jeu, JeuRepository $jeuRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeu->getId(), $request->request->get('_token'))) {
            $jeuRepository->remove($jeu);
        }

        return $this->redirectToRoute('adherent', [], Response::HTTP_SEE_OTHER);
    }

}
