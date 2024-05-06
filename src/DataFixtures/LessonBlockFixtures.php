<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\LessonBlock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LessonBlockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
         $courseRepository = $manager->getRepository(Course::class);
         $course = $courseRepository->findAll()[0];

         assert($course != null);

         $lessonBlock = new LessonBlock('Тестовый блок уроков');
         $lessonBlock->setCourse($course);
         $manager->persist($lessonBlock);
         $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
          CourseFixtures::class
        ];
    }
}
