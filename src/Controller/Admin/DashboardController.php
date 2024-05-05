<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(CourseCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Site');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Курсы', 'fas fa-list', Course::class);
        yield MenuItem::linkToCrud('Уроки', 'fas fa-tablet', Lesson::class);
        yield MenuItem::linkToCrud('Пользователи', 'fas fa-user', User::class);
    }
}
