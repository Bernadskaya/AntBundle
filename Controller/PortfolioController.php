<?php

namespace Ant\Bundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ant\Bundle\Entity\Portfolio;

/**
 * Portfolio controller.
 *
 */
class PortfolioController extends Controller
{

    /**
     * Lists all Portfolio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AntBundle:Portfolio')->findAll();

        return $this->render('AntBundle:Portfolio:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Portfolio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AntBundle:Portfolio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Portfolio entity.');
        }

        return $this->render('AntBundle:Portfolio:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
