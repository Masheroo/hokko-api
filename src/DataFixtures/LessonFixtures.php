<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Entity\LessonBlock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use joshtronic\LoremIpsum;

class LessonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $lessonBlockRepository = $manager->getRepository(LessonBlock::class);
        $lessonBlock = $lessonBlockRepository->findAll()[0];

        assert($lessonBlock != null);

        $lorem = new LoremIpsum();

        for ($i = 0; $i < 10; $i++) {
            $lesson = new Lesson('Урок №'.$i);
            $lesson->setText($lorem->paragraphs(2));
            $lesson->setBlock($lessonBlock);
            $lesson->setOrderNumber($i);
            $manager->persist($lesson);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CourseFixtures::class
        ];
    }
}
