<?php

namespace Ant\Bundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ant\Bundle\Entity\News;

/**
 * News controller.
 *
 */
class NewsController extends Controller
{

    /**
     * Lists all News entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AntBundle:News')->findAll();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/*page number*/,
            2/*limit per page*/
        );

        return $this->render('AntBundle:News:index.html.twig', array(
            'entities' => $entities,
            'pagination' => $pagination
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AntBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        return $this->render('AntBundle:News:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
