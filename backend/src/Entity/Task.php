<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    const STATUS_UNDONE = 1;
    const STATUS_DONE = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var TaskCategory
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskCategory", inversedBy="tasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="cascade")
     * })
     */
	private TaskCategory $taskCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
	private string $text;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", options={"default":1})
     */
	private int $status = self::STATUS_UNDONE;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
	private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return TaskCategory
     */
    public function getTaskCategory(): TaskCategory
    {
        return $this->taskCategory;
    }

    /**
     * @param TaskCategory $taskCategory
     * @return Task
     */
    public function setTaskCategory($taskCategory): Task
    {
        $this->taskCategory = $taskCategory;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return Task
     */
    public function setUser(?User $user): Task
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Task
     */
    public function setText($text): Task
    {
        $this->text = $text;
        return $this;
    }
    /**
     * Get text
     *
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }
    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Task
     */
    public function setStatus($status): Task
    {
        $this->status = $status;
        return $this;
    }
    /**
     * Get status
     *
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     *
     * @return Task
     */
    public function setCreatedAt($createdAt): Task
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
}
