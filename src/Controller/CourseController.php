<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/course')]
class CourseController extends AbstractController
{
    #[Route('', name: 'get_all_courses', methods: ['GET'])]
    public function getAll(CourseRepository $courseRepository): JsonResponse
    {
        $courses = $courseRepository->findAll();;
        return $this->json($courses);
    }

    #[Route('/{id}', name: 'get_one_course', methods: ['GET'])]
    public function getOne(Course $course): JsonResponse
    {
        return $this->json($course);
    }

    #[Route('/{id}/blocks', name:'get_lesson_blocks', methods: ['GET'])]
    public function getLessonBlocks(Course $course): JsonResponse
    {
        return $this->json($course->getLessonBlocks(), context: ['groups' => 'block_list']);
    }
}
