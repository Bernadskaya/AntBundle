<?php

namespace Ant\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ant\Bundle\Entity\OrderForm;
use Ant\Bundle\Form\OrderFormType;

/**
 * OrderForm controller.
 *
 */
class OrderFormController extends Controller
{

    /**
     * Creates a new OrderForm entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new OrderForm();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('order_show', array('id' => $entity->getId())));
        }

        return $this->render('AntBundle:OrderForm:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a OrderForm entity.
     *
     * @param OrderForm $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OrderForm $entity)
    {
        $form = $this->createForm(new OrderFormType(), $entity, array(
            'action' => $this->generateUrl('order_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OrderForm entity.
     *
     */
    public function newAction()
    {
        $entity = new OrderForm();
        $form   = $this->createCreateForm($entity);

        return $this->render('AntBundle:OrderForm:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

}
