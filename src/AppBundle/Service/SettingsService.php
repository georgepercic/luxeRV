<?php

namespace AppBundle\Service;

use BookingsBundle\Entity\Settings;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SettingsService.
 */
class SettingsService
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * GeoService constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return Settings|bool
     */
    public function getCurrentAppSettings()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->container->get('doctrine.orm.entity_manager');

        $settings = $entityManager->getRepository('BookingsBundle:Settings')->findAll();

        if (count($settings) > 0) {
            /** @var Settings $settingNamespace */
            $settingNamespace = array_shift($settings);

            return $settingNamespace;
        }

        return false;
    }
}
