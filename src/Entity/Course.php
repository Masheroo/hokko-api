<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    private const DRAFT_DESCRIPTION = 'Черновик описания';
    private const DRAFT_SKILLS = 'Черновик навыков';
    private const DRAFT_TITLE = 'Черновик';

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $title= self::DRAFT_TITLE,

        #[ORM\Column(length: 255)]
        private string $description = self::DRAFT_DESCRIPTION,

        #[ORM\Column(length: 255)]
        private string $skills = self::DRAFT_SKILLS
    ) {
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $preview = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getSkills(): string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): void
    {
        $this->skills = $skills;
    }

    public function getPreview(): string
    {
        return $this->preview;
    }

    public function setPreview(string $preview): void
    {
        $this->preview = $preview;
    }
}
