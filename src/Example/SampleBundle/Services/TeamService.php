<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:38
 */

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\TeamDAO;
use Doctrine\ORM\EntityManager;
use Example\SampleBundle\Entity\Team;


class TeamService
{
    protected $TeamDAO;
    protected $em;
    protected $BoardService;
    protected $userService;
    public function __construct(EntityManager $entityManager, BoardService $BoardService, UserService $userService)
    {
        $this->em = $entityManager;
        $this->TeamDAO = new TeamDAO($this->em);
        $this->BoardService = $BoardService;
        $this->userService = $userService;
    }
    public function getTeamById($id)
    {
        return $this->TeamDAO->getTeam($id);
    }
    public function addTeam($name)
    {
        //$board = $this->BoardService->getBoardById($BoardId);
        $team = new Team();
        $team->setName($name);
        return $this->TeamDAO->addTeam($team);
    }
    public function deleteTeam($id)
    {
        return $this->TeamDAO->deleteTeam($id);
    }
    public function updateTeamName($id, $name)
    {
        return $this->TeamDAO->updateTeamName($id,$name);
    }
    public function addUserToTeam($teamId, $userId){
        $user = $this->userService->getUserById($userId);
        return $this->TeamDAO->addUserToTeam($teamId, $user);
    }
    public function removeUserFromTeam($teamId, $userId){
        $user = $this->userService->getUserById($userId);
        return $this->TeamDAO->removeUserFromTeam($teamId, $user);
    }

    public function addBoardToTeam($teamId, $boardId)
    {
        $board = $this->BoardService->getBoardById($boardId);
        return $this->TeamDAO->addBoardToTeam($teamId, $board);
    }
    public function removeBoardFromTeam($teamId, $boardId)
    {
        $board = $this->BoardService->getBoardById($boardId);
        return $this->TeamDAO->removeBoardFromTeam($teamId, $board);
    }
}