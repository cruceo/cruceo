<?php
namespace Cruceo\UserBundle\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Cruceo\PortalBundle\Lib\Util;

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
                $oldDir = $entity->getUploadRootDir($eventArgs->getOldValue('nombre'));
                $newDir = $entity->getUploadRootDir($eventArgs->getNewValue('nombre'));
                if (is_dir($oldDir)) {
                    rename($oldDir, $newDir);
                }
            }
        }

        if ($entity instanceof \Cruceo\PortalBundle\Entity\Fotos) {
            $dir = $entity->getBarco()->getUploadRootDir();
            $this->removeThumbs($dir);
        }
    }

    private function removeThumbs($dir)
    {
        Util::deleteDir($dir.DIRECTORY_SEPARATOR.'thumbs');
    }
}