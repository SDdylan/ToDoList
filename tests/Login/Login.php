<?php

namespace App\Tests\Login;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;

class Login extends WebTestCase
{
    protected $client;

    protected $entityManager;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        // Entity manager
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    /**
     * login user
     *
     * @return void
     */
    public function loginUser(): void
    {
        $crawler = $this->client->request('GET', '/login');

        $button = $crawler->filter('form');
        $form = $button->form([
            '_username' => 'test.user@gmail.com',
            '_password' => '123456789@u'
        ]);

        $this->client->submit($form);
    }

    /**
     * login admin
     *
     * @return void
     */
    public function loginAdmin(): void
    {
        $crawler = $this->client->request('GET', '/login');

        $button = $crawler->filter('form');
        $form = $button->form([
            '_username' => 'test.admin@gmail.com',
            '_password' => '123456789@a'
        ]);

        $this->client->submit($form);
    }
}
