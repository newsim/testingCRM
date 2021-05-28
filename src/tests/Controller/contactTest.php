<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\Test\TypeTestCase;
use App\Entity\Contact;
use App\Form\ContactType;



class ContactTest extends TypeTestCase
{
    public function testCreateContact()
    {
        $formData = [
            'lastname' => 'Amo',
            'firstname' => 'simon',
            'email' => 'simon.amoyal4@gmail.com',
            'phone' => '0647080827',
            'tag' => 'bureau',
        ];
        $contact = new Contact();
        

        $form = $this->factory->create(ContactType::class, $contact);
        $expected = new Contact();
        $expected->setLastname('Amo');
        $expected->setFirstname('simon');
        $expected->setEmail('simon.amoyal4@gmail.com');
        $expected->setPhone('0647080827');
        $expected->setTag('bureau');


        $form->submit($formData);


        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());

        // check that $formData was modified as expected when the form was submitted
        $this->assertEquals($expected, $contact);

//verifier si les champs sont valides verifie une methode de l'email et du tel


    }
}