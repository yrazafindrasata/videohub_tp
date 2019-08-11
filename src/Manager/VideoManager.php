<?php


namespace App\Manager;


use App\Entity\Video;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;

class VideoManager
{
    private $repository;
    private $em;

    public function __construct( VideoRepository $repository,EntityManagerInterface $em)
    {
        $this->repository=$repository;
        $this->em=$em;
    }

    public function getPublishedVideos()
    {
        return $this->repository->findBy([
            'published'=>true,
        ]);
    }

    public function getPublishedVideosByCategory($idCategory)
    {
        return $this->repository->findBy([
            'published'=>true,
            'category'=>$idCategory,
        ]);
    }




}