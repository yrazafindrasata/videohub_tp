<?php


namespace App\Controller;

use App\Entity\Video;
use App\Form\AddVideoType;
use App\Form\ArticleSelectUserType;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends AbstractController
{
    /**
     * @Route("/video/{id}", name="video_profile")
     */
    public function seevideo(Video $video,Request $request,EntityManagerInterface $em)
    {
        return $this->render('video/video.html.twig', [
            'video' => $video,
        ]);
    }


    /**
     * @Route("/account/video", name="videoEdit")
     */
    public function showVideoAccount()
    {
        return $this->render('video/videoAccount.html.twig');
    }

    /**
     * @Route("/addVideo", name="addVideo")
     */
    public function index(Request $request,VideoRepository $videoRepository,EntityManagerInterface $em)
    {
        $video =new Video();
        $form = $this->createForm(AddVideoType::class,$video);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            $em->persist($video);
            $em->flush();
            unset($video);
            unset($form);
            $video =new Video();
            $form = $this->createForm(AddVideoType::class,$video);
        }


        return $this->render('video/addvideo.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}