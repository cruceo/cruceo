<?php
namespace Cruceo\UserBundle\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Move files photos from old dir to new dir
 * if names's ship was changed
 * Remove old dir.
 *
 * @author xaz
 */
class RenameImagesDir
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if ($entity instanceof \Cruceo\PortalBundle\Entity\Barcos || $entity instanceof \Cruceo\PortalBundle\Entity\Cruceros) {
            if ($eventArgs->hasChangedField('nombre')) {
                rename(
                    $entity->getUploadRootDir($eventArgs->getOldValue('nombre')),
                    $entity->getUploadRootDir($eventArgs->getNewValue('nombre'))
                );
            }
        }
    }
}