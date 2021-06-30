<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Answers::class, mappedBy="question")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=QuestionComments::class, mappedBy="question")
     */
    private $questionComments;

//    /**
//     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="question")
//     */
//    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->questionComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

//    /**
//     * @return Collection|Answer[]
//     */
//    public function getAnswers(): Collection
//    {
//        return $this->answers;
//    }
//
//    public function addAnswer(Answer $answer): self
//    {
//        if (!$this->answers->contains($answer)) {
//            $this->answers[] = $answer;
//            $answer->setQuestion($this);
//        }
//
//        return $this;
//    }

//    public function removeAnswer(Answer $answer): self
//    {
//        if ($this->answers->removeElement($answer)) {
//            // set the owning side to null (unless already changed)
//            if ($answer->getQuestion() === $this) {
//                $answer->setQuestion(null);
//            }
//        }
//
//        return $this;
//    }

/**
 * @return Collection|Answers[]
 */
public function getAnswers(): Collection
{
    return $this->answers;
}

public function addAnswer(Answers $answer): self
{
    if (!$this->answers->contains($answer)) {
        $this->answers[] = $answer;
        $answer->setQuestion($this);
    }

    return $this;
}

public function removeAnswer(Answers $answer): self
{
    if ($this->answers->removeElement($answer)) {
        // set the owning side to null (unless already changed)
        if ($answer->getQuestion() === $this) {
            $answer->setQuestion(null);
        }
    }

    return $this;
}

/**
 * @return Collection|QuestionComments[]
 */
public function getQuestionComments(): Collection
{
    return $this->questionComments;
}

public function addQuestionComment(QuestionComments $questionComment): self
{
    if (!$this->questionComments->contains($questionComment)) {
        $this->questionComments[] = $questionComment;
        $questionComment->setQuestion($this);
    }

    return $this;
}

public function removeQuestionComment(QuestionComments $questionComment): self
{
    if ($this->questionComments->removeElement($questionComment)) {
        // set the owning side to null (unless already changed)
        if ($questionComment->getQuestion() === $this) {
            $questionComment->setQuestion(null);
        }
    }

    return $this;
}
}
