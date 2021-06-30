<?php

namespace App\Entity;

use App\Repository\AnswersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswersRepository::class)
 */
class Answers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\Column(type="text", length=255)
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
     * @ORM\OneToMany(targetEntity=AnswerComments::class, mappedBy="answer")
     */
    private $answercomments;

    public function __construct()
    {
        $this->answercomments = new ArrayCollection();
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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question):self
    {
        $this->question = $question;

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

    /**
     * @return Collection|AnswerComments[]
     */
    public function getAnswercomments(): Collection
    {
        return $this->answercomments;
    }

    public function addAnswercomment(AnswerComments $answercomment): self
    {
        if (!$this->answercomments->contains($answercomment)) {
            $this->answercomments[] = $answercomment;
            $answercomment->setAnswer($this);
        }

        return $this;
    }

    public function removeAnswercomment(AnswerComments $answercomment): self
    {
        if ($this->answercomments->removeElement($answercomment)) {
            // set the owning side to null (unless already changed)
            if ($answercomment->getAnswer() === $this) {
                $answercomment->setAnswer(null);
            }
        }

        return $this;
    }
}
