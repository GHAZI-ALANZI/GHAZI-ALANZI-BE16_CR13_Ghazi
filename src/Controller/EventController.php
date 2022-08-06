<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Form\EventType;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_event')]
    public function index(ManagerRegistry $doctrine): Response
    {
        
        $event = $doctrine->getRepository(Event::class)->findAll();

       return $this->render('event/index.html.twig', ['event' => $event]);
    }

    #[Route('/create', name: 'event_create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $event= new Event();
        $form = $this->createForm(EventType::class, $event);
 
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $now = new \DateTime('now');
            $event = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($event);
            $em->flush();
 
            $this->addFlash(
                'notice',
                'Event Added'
                );
      
            return $this->redirectToRoute('event_create');
        }
 
 
        return $this->render('event/create.html.twig', ['form' => $form->createView()]);
    }
 
  
    #[Route('/edit/{id}', name: 'event_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
  {
      $event = $doctrine->getRepository(Event::class)->find($id);
      $form = $this->createForm(EventType::class, $event);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $now = new \DateTime('now');
          $event = $form->getData();
          $event->setCreateDate($now);
          $em = $doctrine->getManager();
          $em->persist($event);
          $em->flush();
          $this->addFlash(
               'notice',
               'Event Edited'
               );

          return $this->redirectToRoute('event_edit');
      }

      return $this->render('event/edit.html.twig', ['form' => $form->createView()]);
  }
  
    #[Route('/details/{id}', name: 'todo_details')]
    public function details(ManagerRegistry $doctrine, $id): Response
    {
        $event = $doctrine->getRepository(Event::class)->find($id);
  
        return $this->render('event/details.html.twig', ['event' => $event]);
    }
    #[Route('/delete/{id}', name: 'event_delete')]
   public function delete($id,ManagerRegistry $doctrine): Response
   {
    $event = $doctrine->getRepository(Event::class)->find($id);

       $em = $doctrine->getManager();
       
       $em->remove($event);
       
       $em->flush();
       
       
       return $this->redirectToRoute('event_del');
   }
   #[Route('/del', name: 'event_del')]
    public function del(): Response
    {

       return $this->render('event/del.html.twig');
    }

   
    #[Route('/filter', name: 'event_filter')]
    public function filter(ManagerRegistry $doctrine): Response
    {
           

$event = $doctrine->getRepository(Event::class)->findBy(['Type' => "music"]);

       return $this->render('event/filter.html.twig', ['event' => $event]);
    }
}