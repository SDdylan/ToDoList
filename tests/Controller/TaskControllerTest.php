<?php

namespace App\Tests\Controller;

use App\Entity\Task;
use App\Tests\Login\Login;
use Faker\Factory;

class TaskControllerTest extends Login
{
    public function testListAction()
    {
        $this->client->request('GET', '/tasks');
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $this->loginUser();
        $faker = Factory::create();

        $crawler = $this->client->request('GET', '/tasks/create');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('input#task_title')->count());
        $this->assertSame(1, $crawler->filter('textarea#task_content')->count());

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[content]'] = $faker->sentence(4);
        $form['task[title]'] = $faker->words(2, true);

        $crawler = $this->client->submit($form);

        $this->assertResponseRedirects('/tasks');
        $this->client->followRedirect();
        $this->assertSelectorExists('.alert-success');
    }

    public function testEditAction()
    {
        $this->loginUser();
        $faker = Factory::create();

        //Dans les fixtures, l'utilisateur USER appartient aux premières tâches créée.
        $task = $this->entityManager->getRepository(Task::class)->findFirstTask();
        $crawler = $this->client->request('GET', '/tasks/'. $task[0]->getId() . '/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[content]'] = $faker->sentence(4);
        $form['task[title]'] = $faker->words(2, true);
        $crawler = $this->client->submit($form);

        $crawler = $this->client->followRedirect();

        $this->assertResponseIsSuccessful();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
        $this->assertSame(1, $crawler->filter('html:contains("Superbe ! La tâche a bien été modifiée.")')->count());
    }

    public function testToggleTaskAction()
    {
        $this->loginUser();

        $task = $this->entityManager->getRepository(Task::class)->findLastTask();

        $this->client->request('GET', '/tasks/' . $task[0]->getId() . '/toggle');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testDeleteAction()
    {
        $this->loginUser();
        $faker = Factory::create();

        //Plus tôt on à utiliser l'utilisateur User pour créer un tache
        $task = $this->entityManager->getRepository(Task::class)->findLastTask();
        $crawler = $this->client->request('GET', '/tasks/'. $task[0]->getId() . '/delete');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->assertResponseRedirects('/tasks');
        $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertSelectorExists('.alert-success');

    }

    public function testBadDeleteAction()
    {
        $this->loginAdmin();
        $faker = Factory::create();

        //Ici, l'admin n'est pas lié a la tache en question.
        $task = $this->entityManager->getRepository(Task::class)->findFirstTask();
        $crawler = $this->client->request('GET', '/tasks/'. $task[0]->getId() . '/delete');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->assertResponseRedirects('/tasks');
        $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertSelectorExists('.alert-danger');

        //On vérifie que l'entité existe toujours
        $this->assertEquals($task[0], $this->entityManager->getRepository(Task::class)->find($task[0]->getId()));
    }
}
