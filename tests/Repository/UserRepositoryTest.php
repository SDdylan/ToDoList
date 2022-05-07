<?php

namespace App\Tests\Repository;

use App\Entity\Task;
use App\Entity\User;
use App\Tests\Login\Login;

class UserRepositoryTest extends Login
{
    public function testAdd()
    {
        $user = new User();
        $user->setUsername('DylanS')
            ->setRoles(['ROLE_USER'])
            ->encodePassword('123456789@d')
            ->setEmail('dylan.test@outlook.com');

        $this->entityManager->getRepository(User::class)->add($user);

        $userFlushed = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'DylanS']);

        $this->assertEquals($user, $userFlushed);
    }

    public function testUpgradePassword()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'DylanS']);
        $oldPassword = $user->getPassword();

        $this->entityManager->getRepository(User::class)->upgradePassword($user, "newPassword@d");
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'DylanS']);

        $this->assertNotEquals($oldPassword, $user->getPassword());
    }

    public function testRemove()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'DylanS']);

        $this->entityManager->getRepository(User::class)->remove($user);

        $this->assertNull($this->entityManager->getRepository(User::class)->findOneBy(['username' => 'DylanS']));
    }
}
