<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GeoService.
 */
class GeoService
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    const URL = 'https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s';

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
     * @param $addressString
     *
     * @return bool
     */
    public function geoCodeAddress($addressString)
    {
        $key = $this->container->getParameter('google_geocode_api_key');

        $encodedAddress = urlencode($addressString);

        $url = sprintf(self::URL, $encodedAddress, $key);

        $content = file_get_contents($url);
        $array = json_decode($content);

        if (isset($array->results[0]) && isset($array->results[0]->geometry->location)) {
            return $array->results[0]->geometry->location;
        }

        return false;
    }
}
