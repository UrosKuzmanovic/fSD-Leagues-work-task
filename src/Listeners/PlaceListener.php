<?php


namespace App\Listeners;


use App\Entity\Place;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class PlaceListener implements EventSubscriber
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postLoad,
            Events::prePersist,
            Events::preUpdate,
            Events::preRemove,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $place = $args->getEntity();
        if ($place instanceof Place
            && $this->security->isGranted(
                "ROLE_ADMIN"
            )
        ) {
            $place->setCreatedBy($this->security->getUser()->getUsername());
        } else {
            throw new AccessDeniedException();
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $place = $args->getEntity();
        if ($place instanceof Place) {
            if (!$this->security->isGranted("ROLE_ADMIN")) {
                throw new AccessDeniedException();
            }
        }
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $place = $args->getEntity();
        if ($place instanceof Place) {
            if (!$this->security->isGranted("ROLE_ADMIN")) {
                throw new AccessDeniedException();
            }
        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $place = $args->getEntity();
        if ($place instanceof Place) {
            if (!$this->security->isGranted("ROLE_ADMIN")) {
                throw new AccessDeniedException();
            }
        }
    }
}