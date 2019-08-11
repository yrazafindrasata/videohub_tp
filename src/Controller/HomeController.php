<?php

namespace App\Controller;

use App\Manager\VideoManager;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(VideoRepository $videoRepository,EntityManagerInterface $em, VideoManager $vm)
    {
        $videosPublished = $vm->getPublishedVideos();
        return $this->render('home/index.html.twig', [
            'videosPublished' => $videosPublished ,
        ]);
    }


}
