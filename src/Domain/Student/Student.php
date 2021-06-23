<?php

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Email\Email;
use Alura\Calisthenics\Domain\Video\Video;
use DateTimeImmutable;
use DateTimeInterface;
use Ds\Map;

class Student
{
    private Email $email;
    private DateTimeInterface $bd;
    private WatchedVideos $watchedVideos;
    private FullName $fullName;
    private Address $address;

    public function __construct(Email $email, DateTimeInterface $bd, FullName $fullName, Address $address)
    {
        $this->watchedVideos = new WatchedVideos();
        $this->$email = $email;
        $this->bd = $bd;
        $this->address = $address;
        $this->fullName = $fullName;
    }

    public function getFullName(): string
    {
        return (string) $this->fullName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBd(): DateTimeInterface
    {
        return $this->bd;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() === 0) {
            return true;
        }

        $firstDate = $this->watchedVideos->dateOfFirstVideo();
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;

    }

    public function age(): int
    {
        $today = new DateTimeImmutable();
        $dateInterval = $this->bd->diff($today);

        return $dateInterval->y;
    }
}
