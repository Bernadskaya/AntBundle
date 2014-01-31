<?php

namespace Ant\Bundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ant\Bundle\Entity\PortfolioItem;
use Ant\Bundle\Entity\Portfolio;

/**
 * PortfolioItem controller.
 *
 */
class PortfolioItemController extends Controller
{

    /**
     * Lists all PortfolioItem entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $portfolioSet = $em->getRepository('AntBundle:Portfolio')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $portfolioSet,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        foreach ($portfolioSet as $portfolio) {
            $portfolioId = $portfolio->getId();
            $this->ImageAction($portfolioId);
        };

        return $this->render('AntBundle:PortfolioItem:index.html.twig', array(
            'portfolio' =>$portfolio,
            'portfolioSet'=>$portfolioSet,
            'pagination' => $pagination
        ));
    }


    public function ImageAction ($portfolioId) {
        $em = $this->getDoctrine()->getManager();
        $portfolioItemSet = $em->getRepository('AntBundle:PortfolioItem')->findByPortfolioId($portfolioId);

        foreach ($portfolioItemSet as $portfolioItem) {
            $webPath = $portfolioItem->getWebPath();

            return $this->render('AntBundle:PortfolioItem:image.html.twig', array(
                'portfolioItem' => $portfolioItem,
                'portfolioItemSet' => $portfolioItemSet,
                'webPath'=>$webPath
            ));
        }
    }

    public function lastAction()
    {

        $em = $this->get('doctrine.orm.entity_manager');
        $portfolioSet = $em->getRepository('AntBundle:Portfolio')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $portfolioSet,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        foreach ($portfolioSet as $portfolio) {
            $portfolioId = $portfolio->getId();
            $this->ImageAction($portfolioId);
        }

        return $this->render('AntBundle:PortfolioItem:last.html.twig', array(
            'portfolio' =>$portfolio,
            'portfolioSet'=>$portfolioSet,
            'pagination' => $pagination
        ));
    }





    /**
     * Finds and displays a PortfolioItem entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $portfolio = $em->getRepository('AntBundle:Portfolio')->find($id);
        $portfolioItem = $em->getRepository('AntBundle:PortfolioItem')->findByPortfolioId($id);

        if (!$portfolioItem) {
            throw $this->createNotFoundException('Unable to find PortfolioItem entity.');
        }

        return $this->render('AntBundle:PortfolioItem:show.html.twig', array(
            'portfolioItem'      => $portfolioItem,
            'portfolio'          => $portfolio
        ));
    }
}
