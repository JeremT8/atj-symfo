<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\Calendar1Type;
use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/calendar/crud')]
class CalendarCrudController extends AbstractController
{
    #[Route('/', name: 'app_calendar_crud_index', methods: ['GET'])]
    public function index(CalendarRepository $calendarRepository): Response
    {
        return $this->render('calendar_crud/index.html.twig', [
            'calendars' => $calendarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_calendar_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CalendarRepository $calendarRepository): Response
    {
        $calendar = new Calendar();
        $form = $this->createForm(Calendar1Type::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendarRepository->add($calendar);
            return $this->redirectToRoute('app_calendar_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendar_crud/new.html.twig', [
            'calendar' => $calendar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_calendar_crud_show', methods: ['GET'])]
    public function show(Calendar $calendar): Response
    {
        return $this->render('calendar_crud/show.html.twig', [
            'calendar' => $calendar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_calendar_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Calendar $calendar, CalendarRepository $calendarRepository): Response
    {
        $form = $this->createForm(Calendar1Type::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendarRepository->add($calendar);
            return $this->redirectToRoute('app_calendar_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendar_crud/edit.html.twig', [
            'calendar' => $calendar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_calendar_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Calendar $calendar, CalendarRepository $calendarRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendar->getId(), $request->request->get('_token'))) {
            $calendarRepository->remove($calendar);
        }

        return $this->redirectToRoute('app_calendar_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
