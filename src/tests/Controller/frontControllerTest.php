<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('table', 'Firstname');
        $this->assertSelectorTextContains('table', 'Lastname');
        $this->assertSelectorTextContains('table', 'email');
        $this->assertSelectorTextContains('table', 'phone');
        $this->assertSelectorTextContains('table', 'tag');

    }

    public function testNewContact()
    {
        $client = static::createClient();
        $client->request('GET', '/new');

        

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('form', 'Lastname');


    }

}