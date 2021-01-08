<?php


namespace App\Listeners;


use App\Entity\Player;
use App\Service\ImageManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class ImageListener implements EventSubscriber
{
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postRemove,
        ];
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Player) {
            $this->imageManager->removeImage($entity);
        }
    }
}