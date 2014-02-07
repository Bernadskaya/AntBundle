<?php
/**
 * Created by PhpStorm.
 * User: nevada
 * Date: 16.01.14
 * Time: 10:41
 */

namespace Ant\Bundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class FrontendBuilder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav')
            ->addChild('menu.frontend.index', array('route' => 'ad'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu['menu.frontend.index']
            ->addChild('menu.frontend.news', array('route' => 'news'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.portfolio', array('route' => 'portfolio'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.contacts', array('route' => 'contacts'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.order', array('route' => 'order_new'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.services', array())
            ->setExtra('translation_domain', 'AntBundle');
        $menu['menu.frontend.services']->setUri('#');
        $menu['menu.frontend.services']
            ->addChild('menu.frontend.services_1', array('route' => 'services_1'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu['menu.frontend.services'
            ]->addChild('menu.frontend.services_2', array('route' => ''))
            ->setExtra('translation_domain', 'AntBundle');
        $menu['menu.frontend.services']
            ->setChildrenAttributes(array ('id'=>'block','class'=>'nav collapse in'));
        $menu['menu.frontend.services']
            ->setLinkAttributes(array ('data-toggle'=>'collapse','data-target'=>'#block'));

        return $menu;
    }

    public function footerMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-pills nav-justified')
            ->addChild('menu.frontend.index', array('route' => 'ad'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.news', array('route' => 'news'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.portfolio', array('route' => 'portfolio'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.contacts', array('route' => 'contacts'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.order', array('route' => 'order_new'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu
            ->addChild('menu.frontend.services', array())
            ->setExtra('translation_domain', 'AntBundle');
        $menu['menu.frontend.services']->setUri('#');
        $menu['menu.frontend.services']
            ->addChild('menu.frontend.services_1', array('route' => 'services_1'))
            ->setExtra('translation_domain', 'AntBundle');
        $menu['menu.frontend.services'
        ]->addChild('menu.frontend.services_2', array('route' => ''))
            ->setExtra('translation_domain', 'AntBundle');
        $menu['menu.frontend.services']
            ->setChildrenAttributes(array ('class'=>'nav nav-pills nav-stacked'));


        return $menu;
    }

}
