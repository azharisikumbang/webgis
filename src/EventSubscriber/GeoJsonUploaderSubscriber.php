<?php

namespace App\EventSubscriber;

use App\Entity\GeoJson;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;

class GeoJsonUploaderSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['onBeforeEntityPersistedEvent'],
        ];
    }

    public function onBeforeEntityPersistedEvent(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof GeoJson)) {
            return;
        }

        dump($event);
        die;
    }
}
