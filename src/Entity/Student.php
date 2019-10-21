<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $second_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $patronymic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SchoolClass", inversedBy="students")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     */
    private $schoolclass;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSecondName(): ?string
    {
        return $this->second_name;
    }

    public function setSecondName(?string $second_name): self
    {
        $this->second_name = $second_name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Set schoolclass
     *
     * @param \App\Entity\SchoolClass $schoolclass
     *
     * @return Student
     */
    public function setSchoolclass(SchoolClass $schoolclass = null){
        $this->schoolclass = $schoolclass;

        return $this;
    }

    /**
     * Get schoolclass
     *
     * @return \App\Entity\SchoolClass
     */
    public function getSchoolclass(){
        return $this->schoolclass;
    }
}
