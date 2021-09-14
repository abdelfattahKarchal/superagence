<?php

namespace App\Listener;

use App\Entity\Picture;
use App\Entity\Property;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
/**
 * Il faut ajoutrer ce service ImageCacheSubscriber sur le fichier services.yaml pour que ca sera pris en consideration
 */
class ImageCacheSubscriber implements EventSubscriber{

    /**
     * @var CacheManager
     */
    private $cacheManager;
    
    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
        
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::preRemove,
            Events::preUpdate
        );
    }


    public function preRemove(LifecycleEventArgs $args){

        $entity = $args->getEntity();
        if (!$entity instanceof Picture) {
            return;
        }

        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Picture) {
            return;
        }

        if ($entity->getImageFile() instanceof UploadedFile) {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }
        //dump($args->getEntity());
        //dump($args->getObject());
    }



    /**
     * Get the value of cacheManager
     */ 
    public function getCacheManager()
    {
        return $this->cacheManager;
    }

    /**
     * Set the value of cacheManager
     *
     * @return  self
     */ 
    public function setCacheManager($cacheManager)
    {
        $this->cacheManager = $cacheManager;

        return $this;
    }

    /**
     * Get the value of uploaderHelper
     */ 
    public function getUploaderHelper()
    {
        return $this->uploaderHelper;
    }

    /**
     * Set the value of uploaderHelper
     *
     * @return  self
     */ 
    public function setUploaderHelper($uploaderHelper)
    {
        $this->uploaderHelper = $uploaderHelper;

        return $this;
    }
}