<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    public function testDisplayFormLogin()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testConnexion()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $link = $crawler->selectLink('Se connecter')->link();
        $crawler = $client->click($link);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Se connecter')->form();
        $form['_username'] = 'test.admin@gmail.com';
        $form['_password'] = '123456789@a';

        $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $crawler = $client->followRedirect();
        $this->assertResponseIsSuccessful();

        $this->assertSame(1, $crawler->filter('a.pull-right.btn.btn-danger')->count());
    }

    public function testLogout()
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test.admin@gmail.com']);

        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/');

        //$this->assertSame(1, $crawler->filter('a.pull-right.btn.btn-danger', 'Se déconnecter')->count());
        $this->assertSelectorTextContains('a.pull-right.btn.btn-danger', 'Se déconnecter');

        $link = $crawler->selectLink('Se déconnecter')->link();
        $crawler = $client->click($link);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains('a.btn.btn-success', 'Se connecter');

    }

    public function testBadLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();
        $form['_username'] = 'test.admin@gmail.com';
        $form['_password'] = 'mauvaisMdp';

        $client->submit($form);

        $client->followRedirect();
        $this->assertSelectorExists('.alert-danger');
    }
}
