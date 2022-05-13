<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;
    private $task;

    public function setUp() : void
    {
        $this->user = new User();
        $this->task = new Task();
    }

    public function testId() : void
    {
        $this->assertNull($this->user->getId());
    }

    public function testUsername()
    {
        $this->user->setUsername('Dylan');
        $this->assertSame('Dylan', $this->user->getUsername());
        $this->assertTrue($this->user->getUsername() === 'Dylan');
        $this->assertFalse($this->user->getUsername() === 'NotDylan');
    }

    public function testEmail()
    {
        $this->user->setEmail('true@test.fr');
        $this->assertSame('true@test.fr', $this->user->getEmail());
        $this->assertTrue($this->user->getEmail() === 'true@test.fr');
        $this->assertFalse($this->user->getEmail() === 'false@test.fr');
    }

    public function testPassword()
    {
        $this->user->setPassword('password');
        $this->assertSame('password', $this->user->getPassword());
        $this->assertTrue($this->user->getPassword() === 'password');
        $this->assertFalse($this->user->getPassword() === 'false');
    }

    public function testRolesUser() : void
    {
        $this->user->setRoles(['ROLE_USER']);
        $this->assertSame(['ROLE_USER'], $this->user->getRoles());
        $this->assertTrue($this->user->getRoles([]) === ['ROLE_USER']);
        $this->assertFalse($this->user->getRoles([]) === 'false');
    }

    public function testTasks()
    {
        $this->user->addTask($this->task);
        $this->assertEquals(false, $this->user->getTasks()->isEmpty());
        $this->user->removeTask($this->task);
        $this->assertEquals(true, $this->user->getTasks()->isEmpty());
    }

    public function testSalt() : void
    {
        $this->assertNull($this->user->getSalt());
    }

    public function testEraseCredentials() : void
    {
        $this->assertNull($this->user->eraseCredentials());
    }

    public function testIsEmpty()
    {
        $this->assertEmpty($this->user->getUsername());
        $this->assertEmpty($this->user->getEmail());
        $this->assertEmpty($this->user->getPassword());
        $this->assertEmpty($this->user->getTasks());
    }
}
