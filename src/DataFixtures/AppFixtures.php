<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        //création de user et admin
        $user = new User();
        $user->setEmail("test.user@gmail.com")
            ->setRoles(['ROLE_USER'])
            ->encodePassword("123456789@u")
            ->setUsername($faker->userName());

        $manager->persist($user);

        $admin = new User();
        $admin->setEmail("test.admin@gmail.com")
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->encodePassword("123456789@a")
            ->setUsername($faker->userName());

        $manager->persist($admin);

        $anonyme = new User();
        $anonyme->setEmail('anonyme@gmail.com')
            ->setRoles(['ROLE_USER'])
            ->encodePassword($faker->password(6))
            ->setUsername('anonyme');

        $manager->persist($anonyme);


        //creation de taches de test
        for ($i = 0; $i<3; $i++) {
            $task = new Task();
            $task->setUser($anonyme)
                ->setCreatedAt(new \DateTime())
                ->setTitle($faker->sentence(2))
                ->setContent($faker->sentence(10))
                ->setIsDone(false);

            $manager->persist($task);
        }

        for ($i = 0; $i<3; $i++) {
            $task = new Task();
            $task->setUser($user)
                ->setCreatedAt(new \DateTime())
                ->setTitle($faker->sentence(2))
                ->setContent($faker->sentence(10))
                ->setIsDone(false);

            $manager->persist($task);
        }

        $manager->flush();
    }
}
