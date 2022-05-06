<?php

namespace App\Tests\Repository;

use App\Entity\Task;
use App\Entity\User;
use App\Tests\Login\Login;

class TaskRepositoryTest extends Login
{
    public function testAdd()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'test.user@gmail.com']);

        $task = new Task();
        $task->setUser($user)
            ->setIsDone(false)
            ->setCreatedAt(new \DateTime())
            ->setContent('Contenu de la tâche')
            ->setTitle('Titre de la tâche');

        $this->entityManager->getRepository(Task::class)->add($task);

        $taskFlushed = $this->entityManager->getRepository(Task::class)->findOneBy(['title' => 'Titre de la tâche']);

        $this->assertEquals($task->getTitle(), $taskFlushed->getTitle());
    }

    public function testRemove()
    {
        $task = $this->entityManager->getRepository(Task::class)->findOneBy(['title' => 'Titre de la tâche']);

        $this->entityManager->getRepository(Task::class)->remove($task);

        $this->assertNull($this->entityManager->getRepository(Task::class)->findOneBy(['title' => 'Titre de la tâche']));
    }

}