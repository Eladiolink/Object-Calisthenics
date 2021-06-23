<?php

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;
use DateTimeImmutable;

class MemoryVideos
{
    private array $videos;

    public function add(Video $video)
    {
        $this->videos[] = $video;
    }

    public function getVideosFor(Student $student): array
    {
        $today = new DateTimeImmutable();
        return array_filter($this->videos, fn (Video $video) => $video->getAgeLimit() <= $student->age());
    }
}
