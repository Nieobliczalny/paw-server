<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:38
 */

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\TaskDAO;
use Doctrine\ORM\EntityManager;
use Example\SampleBundle\Entity\Task;


class TaskService
{
    protected $taskDAO;
    protected $em;
    protected $cardService;
    public function __construct(EntityManager $entityManager, CardService $cardService)
    {
        $this->em = $entityManager;
        $this->taskDAO = new TaskDAO($this->em);
        $this->cardService = $cardService;

    }
    public function getTaskById($id)
    {
        return $this->taskDAO->getTask($id);
    }
    public function addTask($cardId, $name)
    {
        $card = $this->cardService->getCardById($cardId);
        $task = new Task();
        $task->setName($name)->setCard($card)->setDescription("much description wow");
        return $this->taskDAO->addTask($task);
    }
    public function updateTaskName($id, $name)
    {
        return $this->taskDAO->updateTask($id, $name);
    }
    public function deleteTaskById($id)
    {
        return $this->taskDAO->delete($id);
    }
}