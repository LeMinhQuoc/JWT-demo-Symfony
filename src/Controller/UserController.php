<?php


namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class UserController extends  AbstractController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $input, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $data = json_decode($input->getContent(),true);
        $user->setData($input);
        $passwords = $data['password'];
        $encoded = $encoder->encodePassword($user, $passwords);
        $user->setPassword($encoded);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();
        return new JsonResponse(['success' => true]);

    }
}
