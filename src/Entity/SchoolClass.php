<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SchoolClassRepository")
 * @UniqueEntity(
 *     fields={"number", "letter"},
 *     message="Такой класс уже существует"
 * )
 */
class SchoolClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $letter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="schoolclass", cascade="remove")
     * @OrderBy({"id" = "DESC"})
     */
    private $students;

    /**
     * Schoolclass constructor
     */
    public function __construct(){
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getLetter(): ?string
    {
        return $this->letter;
    }

    public function setLetter(?string $letter): self
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * Add student
     *
     * @param \App\Entity\Student $student
     *
     * @return SchoolClass
     */
    public function addStudent(Student $student){
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \App\Entity\Student $student
     */
    public function removeStudent(Student $student){
        $this->students->removeElement($student);
    }

    /**
     * Get student
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents(){
        return $this->students;
    }
}
