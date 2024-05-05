<?php

namespace App\Normalizer;

use App\Entity\Course;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final readonly class CourseNormalizer implements NormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private NormalizerInterface $normalizer,
        private FilesystemOperator $defaultStorage
    ) {
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $data = $this->normalizer->normalize($object);

        $data['previewLink'] = $data['previewFilename']
             ? $this->defaultStorage->publicUrl($data['previewFilename'])
             : null;

        unset($data['previewFilename']);

        return $data;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Course;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Course::class => true
        ];
    }
}