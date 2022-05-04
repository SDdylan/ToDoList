<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testContentPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertSame(1, $crawler->filter('h1')->count());
        //5 boutons : créer utilisateur, connexion et boutons de tâches
        $this->assertSame(5, $crawler->filter('a.btn')->count());
        $this->assertSelectorTextContains('h1', 'Bienvenue sur Todo List, l\'application vous permettant de gérer l\'ensemble de vos tâches sans effort !');
        $this->assertSelectorTextContains('a.btn.btn-info', 'Consulter la liste des tâches à faire');
        $this->assertSelectorTextContains('a.btn.btn-secondary', 'Consulter la liste des tâches terminées');
    }

}