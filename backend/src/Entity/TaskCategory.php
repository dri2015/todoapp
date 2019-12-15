<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskCategoryRepository")
 */
class TaskCategory
{
    /**
    * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
	private string $name;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="todoList", cascade={"all"}, orphanRemoval=true)
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    /**
     * @param int $id
     * @return TaskCategory
     */
    public function setId($id): TaskCategory
    {
        $this->id = $id;

        return $this;
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
     * Set name
     *
     * @param string $name
     *
     * @return TaskCategory
     */
    public function setName($name): TaskCategory
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * @return Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }
    /**
     * @param Collection $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }
    /**
     * @param Task $task
     */
    public function addTask(Task $task)
    {
        $this->tasks->add($task);
    }
    /**
     * @param Task $task
     */
    public function removeTask(Task $task)
    {
        $this->tasks->removeElement($task);
    }
}
