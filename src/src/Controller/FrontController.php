<?php

namespace App\Controller;


use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $allContacts = $entityManager->getRepository(Contact::class)->findAll();

        return $this->render('front/index.html.twig', [
            'list_contact' => $allContacts,
        ]);
    }

    //creation d'un  nouveau contact dans le repertoire
    /**
     * @Route("/new", name="new")
     */
    public function newContact(Request $request): Response
    {
        // just setup a fresh $contact object (remove the example data)
        $contact = new Contact();
    
        $form = $this->createForm(ContactType::class, $contact);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$contact` variable has also been updated
            $contact = $form->getData();
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
    
            return $this->redirectToRoute('index');
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteContact(Request $request, int $id): Response
    {
    
        $entityManager = $this->getDoctrine()->getManager();
        $deleteContact = $entityManager->getRepository(Contact::class)->findOneBy(['id'=>$id]);
        $entityManager->remove($deleteContact);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function viewContact(Request $request, int $id): Response
    {
    
        $entityManager = $this->getDoctrine()->getManager();
        $viewContact = $entityManager->getRepository(Contact::class)->findOneBy(['id'=>$id]);

        $form = $this->createForm(ContactType::class, $viewContact);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$contact` variable has also been updated
            $contact = $form->getData();
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
    
            return $this->redirectToRoute('index');
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/read/{id}", name="read")
     */
    public function readContact(Request $request, int $id): Response
    {
    
        $entityManager = $this->getDoctrine()->getManager();
        $viewContact = $entityManager->getRepository(Contact::class)->findOneBy(['id'=>$id]);


        return $this->render('contact/view.html.twig', [
            'contact' => $viewContact,
        ]);
    }

}
