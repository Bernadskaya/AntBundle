<?php

namespace Ant\Bundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ant\Bundle\Entity\Page;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AntBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('AntBundle:Page:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
