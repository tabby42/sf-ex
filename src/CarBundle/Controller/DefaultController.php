<?php

namespace CarBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DefaultController extends Controller
{
    /**
     * @Route("/cars", name="car_list")
     */
    public function indexAction(Request $request)
    {
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        $cars = $carRepository->findCarsWithDetails();
        /*$cars = [
            ['make' => 'BMW', 'name' => 'X1'],
            ['make' => 'Tesla', 'name' => 'ST'],
            ['make' => 'Audi', 'name' => 'Q7']
        ];*/
        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class,[
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->add('submit', SubmitType::class,
                [
                    'attr' => ['class' => 'btn btn-primary']
                ]
            )
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('@Car/Default/index.html.twig',
            [
                'cars' => $cars,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param $id
     * @Route("/cars/{id}", name="car_detail")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        $car = $carRepository->findSingleCarWithDetailsById($id);
        return $this->render('@Car/Default/car_detail.html.twig', ['car' => $car]);
    }
}
