<?php

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;

class InMemoryVideoRepository implements VideoRepository
{
    private MemoryVideos $videos;

    public function __construct()
    {
        $this->videos = new MemoryVideos();
    }

    public function add(Video $video): void
    {
        $this->videos->add($video);
    }

    public function videosFor(Student $student): array
    {
        return $this->videos->getVideosFor($student);
    }
}
