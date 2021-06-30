<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"},message="This one is already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email()
     */
    private $email;

   
    /**
     * @ORM\Column (type="string" , length=32 )
     */
    private $firstName;

    /**
     * @ORM\Column (type="string" , length=32 )
     */
    private $lastName;


    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\File(mimeTypes={"image/jpeg"})
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="user")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=Answers::class, mappedBy="user")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=QuestionComments::class, mappedBy="user")
     */
    private $questionComments;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->questionComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }


    public function getlastName(): ?string
    {
        return $this->lastName;
    }
    public function setlastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setUser($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getUser() === $this) {
                $question->setUser(null);
            }
        }

        return $this;
    }



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
        $answer->setUser($this);
    }

    return $this;
}

public function removeAnswer(Answers $answer): self
{
    if ($this->answers->removeElement($answer)) {
        // set the owning side to null (unless already changed)
        if ($answer->getUser() === $this) {
            $answer->setUser(null);
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
        $questionComment->setUser($this);
    }

    return $this;
}

public function removeQuestionComment(QuestionComments $questionComment): self
{
    if ($this->questionComments->removeElement($questionComment)) {
        // set the owning side to null (unless already changed)
        if ($questionComment->getUser() === $this) {
            $questionComment->setUser(null);
        }
    }

    return $this;
}


}
