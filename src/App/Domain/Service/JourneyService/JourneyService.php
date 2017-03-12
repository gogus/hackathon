<?php

namespace App\Domain\Service\JourneyService;

use App\Domain\ApiClient\AddressApiClient\AddressApiClient;
use App\Domain\ApiClient\JourneyApiClient\JourneyApiClient;
use App\Domain\Exception\LocalizationRequiredException;
use App\Domain\Service\ServiceInterface;
use Psr\Log\LoggerInterface;

class JourneyService implements ServiceInterface
{
    /**
     * @var AddressApiClient
     */
    protected $addressApiClient;

    /**
     * @var JourneyApiClient
     */
    protected $journeyApiClient;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param AddressApiClient $addressApiClient
     * @param JourneyApiClient $journeyApiClient
     * @param LoggerInterface  $logger
     */
    public function __construct(
        AddressApiClient $addressApiClient,
        JourneyApiClient $journeyApiClient,
        LoggerInterface $logger
    )
    {
        $this->addressApiClient = $addressApiClient;
        $this->journeyApiClient = $journeyApiClient;
        $this->logger = $logger;
    }

    public function ask($query = null, $token = '')
    {
        try {
            $journeyQuery = $this->parseQuery($query);
            $route = $this->findRoute($journeyQuery);
        } catch (LocalizationRequiredException $localizationRequiredException) {
            throw $localizationRequiredException;
        } catch (\Exception $e) {
            $this->logger->error((string)$e);

            return 'Route not found';
        }

        return new Answer($journeyQuery->getFrom(), $journeyQuery->getTo(), $route);
    }

    /**
     * @param string $query
     *
     * @return Query
     * @throws \Exception
     */
    private function parseQuery($query)
    {
        $matches = [];
        $matched = preg_match('/(journey|go|get|bus|way|route|train)\s+(?:from\s+?(?<from>.*)\s+)?(?:to\s+?(?<to>[a-zA-Z 0-9]+))(?<location>\[(?<lat>.*) (?<lon>.*)\])?/', $query, $matches);

        if ($matched === false || $matched == 0 || !isset($matches['to'])) {
            throw new \Exception('Query parsing failed');
        }

        $to = $this->getLocationByName($matches['to']);

        file_put_contents('debug4', $query);
        file_put_contents('debug3', var_export($matches, true));

        if (!empty($matches['from'])) {
            $from = $this->getLocationByName($matches['from']);
        } elseif (!empty($matches['location'])) {
            $to = $this->getCurrentLocation($matches);
        } else {
            throw new LocalizationRequiredException();
        }

        return new Query($from, $to);
    }

    /**
     * @param string $name
     *
     * @return Location
     */
    private function getLocationByName($name)
    {
        return Location::fromArray($this->addressApiClient->makeCall($name));
    }

    /**
     * @param array $matches
     *
     * @return Location
     */
    private function getCurrentLocation(array $matches)
    {
        return new Location('Your location', new Coordinates($matches['lat'], $matches['lon']));
    }

    /**
     * @param Query $query
     *
     * @return string[]
     */
    private function findRoute(Query $query)
    {
        $response = $this->journeyApiClient->makeCall($query);

        $plan = $response['plan'];

        // An Itinerary is one complete way of getting from the start location to the end location.
        $itineraries = $plan['itineraries'];

        // for now we just get the first itinerary
        $itinerary = $itineraries[0];
        $route = [];
        $legs = $itinerary['legs'];

        foreach ($legs as $leg) {
            $desc = '';
            $mode = $leg['mode'];
            if ($mode === 'WALK') {
                $desc .= 'Walk';
            } elseif ($mode === 'BUS') {
                $desc .= 'Take bus ' . $leg['routeShortName'];
            } elseif ($mode === 'TRAIN') {
                $desc .= 'Take train ' . $leg['routeShortName'];
            }

            if ($leg['from']['name'] !== 'NONE')
            {
                $desc .= ' from ' . $leg['from']['name'];
            }
            if ($leg['to']['name'] !== 'NONE')
            {
                $desc .= ' to ' . $leg['to']['name'];
            }

            $route[] = $desc;
        }

        return $route;
    }
}