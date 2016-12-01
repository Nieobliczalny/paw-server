<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:51
 */
namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class TeamDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getTeamById($id)
    {
        $Team = $this->entityManager->getRepository('ExampleSampleBundle:Team')->find($id);
        return $Team;
    }

    public function getTeams()
    {
        $Team = $this->entityManager->getRepository('ExampleSampleBundle:Team')->findAll();
        return $Team;
    }

    public function getTeamByName($name)
    {
        $Team = $this->entityManager->getRepository('ExampleSampleBundle:Team')->findBy(array('name' => $name ));
        return $Team;
    }

    public function deleteTeam($id)
    {
        $Team = $this->getTeamById($id);
        $this->entityManager->remove($Team);
        $this->entityManager->flush();
        return $Team;
    }
    public function addTeam($Team){
        $this->entityManager->persist($Team);
        $this->entityManager->flush();
        return $Team;
    }
    public function updateTeamName($id, $name)
    {
        $Team = $this->getTeamById($id);
        if($name != '') $Team->setName($name);
        $this->entityManager->flush();
        return $Team;
    }
    public function addUserToTeam($teamId, $user){
        $team = $this->getTeamById($teamId);
        $team->addUser($user);
        $this->entityManager->flush();
        return $team;
    }
    public function removeUserFromTeam($teamId, $user){
        $team = $this->getTeamById($teamId);
        $team->removeUser($user);
        $this->entityManager->flush();
        return $team;
    }

    public function addBoardToTeam($teamId, $board)
    {
        $team = $this->getTeamById($teamId);
        $team->addBoard($board);
        $this->entityManager->flush();
        return $team;

    }
    public function removeBoardFromTeam($teamId, $board)
    {
        $team = $this->getTeamById($teamId);
        $Team->removeBoard($board);
        $this->entityManager->flush();
        return $Team;
    }
}