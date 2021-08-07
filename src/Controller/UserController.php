<?php


namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends  AbstractController
{

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $input, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $user->setData($input);
        $password = $input->get(password);
        $encoded = $encoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();
    }
}
