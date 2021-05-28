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

    }

    public function testCreateContactEmailOnError()
    {
        $formData = [
            'lastname' => '',
            'firstname' => '',
            'email' => 'simon.amoyal4gmail.com',
            'phone' => '',
            'tag' => '',
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

        $this->assertNotEquals($expected, $contact);


    }

    public function testCreateContactPhoneOnError()
    {

        $contact = new Contact();
        $contact->setLastname('Amo');
        $contact->setFirstname('simon');
        $contact->setEmail('simon.amoyal4@gmail.com');
        $contact->setPhone('064708082');
        $contact->setTag('bureau');



        $this->assertFalse($contact->getPhone() == 10);
        $this->assertEquals('06', substr($contact->getPhone(), 0, 2));



    }
}