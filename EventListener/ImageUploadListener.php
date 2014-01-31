<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ant\Bundle\EventListener;


use Ant\Bundle\Entity\NewsInterface;
use Ant\Bundle\Uploader\ImageUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class ImageUploadListener
{
    protected $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

 public function uploadNewsImage(GenericEvent $event)
    {
        $subject = $event->getSubject();

        if (!$subject instanceof NewsInterface) {
            throw new \InvalidArgumentException('NewsInterface expected.');
        }

        if ($subject->hasFile()) {
            $this->uploader->upload($subject);
        }

    }

}
