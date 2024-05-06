<?php

namespace App\Controller;

use App\Entity\Lesson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/lesson')]
class LessonController extends AbstractController
{
    #[Route('/{id}', name: 'get_one_lesson', methods: ['GET'])]
    public function getDetailLesson(Lesson $lesson): JsonResponse
    {
        return $this->json($lesson);
    }
}