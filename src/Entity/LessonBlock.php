<?php

namespace App\Entity;

use App\Repository\LessonBlockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: LessonBlockRepository::class)]
class LessonBlock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['block_list'])]
    private ?int $id = null;

    #[Groups(['block_list'])]
    #[ORM\OneToMany(targetEntity: Lesson::class, mappedBy: 'block', orphanRemoval: true)]
    private Collection $lessons;

    #[ignore]
    #[ORM\ManyToOne(inversedBy: 'lessonBlocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    public function __construct(
        #[ORM\Column(length: 255)]
        #[Groups(['block_list'])]
        private string $name = 'Черновик блока уроков'
    )
    {
        $this->lessons = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name . ' (' . $this->course .')';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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
            $lesson->setBlock($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): static
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getBlock() === $this) {
                $lesson->setBlock(null);
            }
        }

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }
}
