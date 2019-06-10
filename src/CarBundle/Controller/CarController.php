<?php

namespace CarBundle\Controller;

use CarBundle\Entity\Car;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Car controller.
 *
 * @Route("/admin/car")
 */
class CarController extends Controller
{
    /**
     * Lists all car entities.
     *
     * @Route("/", name="car_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('CarBundle:Car')->findAll();

        return array(
            'cars' => $cars
        );
    }

    /**
     * Creates a new car entity.
     *
     * @Route("/new", name="car_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm('CarBundle\Form\CarType', $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_show', array('id' => $car->getId()));
        }

        return array(
            'car' => $car,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a car entity.
     *
     * @Route("/{id}", name="car_show")
     * @Template()
     */
    public function showAction(Car $car)
    {
        return array(
            'car' => $car,
        );
    }

    /**
     * Displays a form to edit an existing car entity.
     *
     * @Route("/{id}/edit", name="car_edit")
     * @Template()
     */
    public function editAction(Request $request, Car $car)
    {
        $editForm = $this->createForm('CarBundle\Form\CarType', $car);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_edit', array('id' => $car->getId()));
        }

        return array(
            'car' => $car,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Deletes a car entity.
     *
     * @Route("/{id}", name="car_delete")
     *
     */
  /*  public function deleteAction(Request $request, Car $car)
    {
        $form = $this->createDeleteForm($car->getId());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($car);
            $em->flush();
        }

        return $this->redirectToRoute('car_index');
    }*/

    /**
     * Creates a form to delete a car entity.
     *
     * @param Car $car The car entity
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    /*private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            //->setAction($this->generateUrl('car_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm();
    }*/

    /**
     * @Route("/admin/car/remove/{id}", name="car_remove", requirements={"id" = "\d+"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function removeAction($id)
    {
        $car = $this->getDoctrine()
            ->getRepository('CarBundle:Car')
            ->findOneById($id);
        if ($car === null) {
            throw $this->createNotFoundException('The car does not exist');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($car);
        $em->flush();
        $this->addFlash(
            'notice',
            'Car successfully deleted!'
        );
        return $this->redirectToRoute('car_index');
    }
}
