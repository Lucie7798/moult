<?php

namespace App\EventListener;

use App\Entity\ProductImage;
use Doctrine\Persistence\Event\LifecycleEventArgs as EventLifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Filesystem\Filesystem;

class ProductImageRemoveListener
{
    private $filesystem;
    private $targetDirectory;

    public function __construct(Filesystem $filesystem, string $targetDirectory)
    {
        $this->filesystem = $filesystem;
        $this->targetDirectory = $targetDirectory;
    }

    public function preRemove(EventLifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof ProductImage) {
            return;
        }

        $this->filesystem->remove($this->targetDirectory . '/public/uploads/images/products/' . $entity->getPath());
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof ProductImage) {
            return;
        }

        if ($args->hasChangedField('path')) {
            $this->filesystem->remove($this->targetDirectory . '/' . $args->getOldValue('path'));
        }
    }
}
