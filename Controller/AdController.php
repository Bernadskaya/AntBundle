<?php

namespace Ant\Bundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ant\Bundle\Entity\Ad;
use Ant\Bundle\Entity\AdGroup;


/**
 * Ad controller.
 *
 */
class AdController extends Controller
{


    /**
     * Lists all Ad entities.
     *
     */
    public function indexAction()
    {

        return $this->render('AntBundle:Ad:index.html.twig', array());
    }

    /**
     * Show list ads in group
     *
     */
    public function listOneGroupAction($id, $adGroupTemplate)
    {
        $em = $this->getDoctrine()->getManager();
        $ad = $em->getRepository('AntBundle:Ad')->findByAdGroup($id);

        $adGroup = $this->getDoctrine()
            ->getRepository('AntBundle:AdGroup')
            ->find($id);
        $adGroupTitle = '';
        if ($adGroup) {
            $adGroupTitle = $adGroup->getTitle();
        }

        return $this->render($adGroupTemplate, array(
            'ad'=>$ad,
            'adGroupTitle'=>$adGroupTitle,
        ));
    }


    /**
     * Finds and displays a Ad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AntBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        return $this->render('AntBundle:Ad:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
