<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\Login\Login;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

class UserControllerTest extends Login
{

    public function testListUser()
    {
        $this->loginAdmin();
        $this->client->request('GET', '/users');
        //dd($this->httpClient->getResponse()->getContent());
        $this->assertSelectorTextContains('h1', 'Liste des utilisateurs');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $this->loginAdmin();
        $faker = Factory::create();

        $crawler = $this->client->request('GET', '/users/create');


        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = $faker->firstName();
        $form['user[email]'] = $faker->email();
        $form['user[roles]'] = 'ROLE_ADMIN';
        $password = $faker->password();
        $form['user[password]'] = $password;

        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testEditAction()
    {
        $this->loginAdmin();

        $faker = Factory::create();
        $user = $this->entityManager->getRepository(User::class)->findLastUser();

        $crawler = $this->client->request('GET', '/users/'. $user[0]->getId() . '/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]'] = $faker->firstName();
        $form['user[email]'] = $faker->email();
        $form['user[roles]'] = 'ROLE_USER';
        $password = $faker->password();
        $form['user[password]'] = $password;

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
        $this->assertGreaterThan(0, $crawler->filter('div:contains("utilisateur a bien été modifié")')->count());
    }

}
