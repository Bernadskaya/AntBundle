<?php
/**
 * Created by PhpStorm.
 * User: nevada
 * Date: 24.01.14
 * Time: 14:36
 */

namespace Ant\Bundle\Block;


use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\Pool;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author     Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class AdminHeadBlockService extends BaseBlockService
{
    protected $pool;

    /**
     * @param string                                                     $name
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Sonata\AdminBundle\Admin\Pool                             $pool
     */
    public function __construct($name, EngineInterface $templating, Pool $pool)
    {
        parent::__construct($name, $templating);

        $this->pool = $pool;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $dashboardGroups = $this->pool->getDashboardGroups();

        $settings = $blockContext->getSettings();

        $visibleGroups = array();
        foreach ($dashboardGroups as $name => $dashboardGroup) {
            if (!$settings['groups'] || in_array($name, $settings['groups'])) {
                $visibleGroups[] = $dashboardGroup;
            }
        }

        return $this->renderPrivateResponse(('AntBundle::head_blocks.html.twig'), array(
            'block'         => $blockContext->getBlock(),
            'settings'      => $settings,
            'admin_pool'    => $this->pool,
            'groups'        => $visibleGroups
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        // TODO: Implement validateBlock() method.
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Admin Head List';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'groups' => false
        ));

        $resolver->setAllowedTypes(array(
            'groups' => array('bool', 'array')
        ));
    }
}
