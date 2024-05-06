<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Attribute\Ignore;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[Vich\Uploadable()]
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
    private string $skills = self::DRAFT_SKILLS)
    {
        $this->lessons = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Ignore]
    #[Vich\UploadableField(mapping: 'courses', fileNameProperty: 'previewFilename')]
    private ?File $preview = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $previewFilename = null;

    /**
     * @var Collection<int, Lesson>
     */
    #[Ignore]
    #[ORM\OneToMany(targetEntity: Lesson::class, mappedBy: 'course', orphanRemoval: true)]
    private Collection $lessons;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
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

    public function getPreviewFilename(): ?string
    {
        return $this->previewFilename;
    }

    public function setPreviewFilename(?string $previewFilename): void
    {
        $this->previewFilename = $previewFilename;
    }

    public function getPreview(): ?File
    {
        return $this->preview;
    }

    public function setPreview(?File $preview): void
    {
        $this->preview = $preview;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): static
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons->add($lesson);
            $lesson->setCourse($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): static
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getCourse() === $this) {
                $lesson->setCourse(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
