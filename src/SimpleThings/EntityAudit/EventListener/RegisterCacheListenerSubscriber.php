<?php

declare (strict_types=1);

namespace SimpleThings\EntityAudit\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegisterCacheListenerSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    private $cacheListener;

    public function __construct(EntityManagerInterface $entityManager, CacheListener $cacheListener)
    {
        $this->entityManager = $entityManager;
        $this->cacheListener = $cacheListener;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.request' => [
                'registerCacheListener',
            ],
            'console.command' => [
                'registerCacheListener',
            ],
        ];
    }

    public function registerCacheListener(): void
    {
        $this->entityManager->getEventManager()->addEventSubscriber($this->cacheListener);
    }
}
