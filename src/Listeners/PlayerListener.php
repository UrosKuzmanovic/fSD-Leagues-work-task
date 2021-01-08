<?php


namespace App\Listeners;


use App\Entity\Player;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class PlayerListener implements EventSubscriber
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
            Events::preRemove,
            Events::postLoad,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $player = $args->getEntity();
        if ($player instanceof Player
            && $this->security->isGranted(
                "ROLE_ADMIN"
            )
        ) {
            $player->setCreatedBy($this->security->getUser()->getUsername());
        } else {
            throw new AccessDeniedException();
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $player = $args->getEntity();
        if ($player instanceof Player) {
            if (!$this->security->isGranted("ROLE_ADMIN")) {
                throw new AccessDeniedException();
            }
        }
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $player = $args->getEntity();
        if ($player instanceof Player) {
            if (!$this->security->isGranted("ROLE_ADMIN")) {
                throw new AccessDeniedException();
            }
        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $player = $args->getEntity();
        if ($player instanceof Player) {
            if (!$this->security->isGranted("ROLE_ADMIN")) {
                throw new AccessDeniedException();
            }
        }
    }
}