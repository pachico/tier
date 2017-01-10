<?php

namespace Pachico\Tier;

use Pachico\Tier\Exception;

/**
 * @see https://en.wikipedia.org/wiki/Deployment_environment
 */
class Tier implements \JsonSerializable
{
    /**
     * Developer's desktop/workstation
     */
    const LOCAL = 'local';

    /**
     * Development server aka sandbox. This is where unit testing is performed by the developer.
     */
    const DEVELOPMENT = 'development';

    /**
     * CI build target, or for developer testing of side effects
     */
    const INTEGRATION = 'integration';

    /**
     * This is the stage where interface testing is performed.
     * Quality analysis team make sure that the new code will not have any impact on the existing
     * functionality and they test major functionalities of the system once after deploying the
     * new code in their respective environment(i.e. QA environment)
     */
    const TEST = 'test';

    /**
     * Mirror of production environment
     */
    const STAGING = 'staging';

    /**
     * Serves end-users/clients
     */
    const PRODUCTION = 'production';

    /**
     * @var array
     */
    private $allPossibleTiers;

    /**
     * @var string
     */
    private $tier;

    /**
     * @var array
     */
    private $applicationTiers;

    /**
     * @param string $tier
     * @param array|null $applicationTiers
     */
    public function __construct($tier, array $applicationTiers = null)
    {
        $this->allPossibleTiers = [
            static::LOCAL,
            static::DEVELOPMENT,
            static::INTEGRATION,
            static::TEST,
            static::STAGING,
            static::PRODUCTION
        ];

        $uniqueApplicationTiers = array_unique($applicationTiers);
        $this->applicationTiers = empty($uniqueApplicationTiers) ? $this->allPossibleTiers : $uniqueApplicationTiers;
        $this->validateDefinition($tier, $this->applicationTiers);
        $this->tier = $tier;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->tier;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->get();
    }

    /**
     * @return array
     */
    public function getApplicationTiers()
    {
        return $this->applicationTiers;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'tier' => $this->tier,
            'applicationTiers' => $this->applicationTiers
        ];
    }

    /**
     * @param string $tier
     * @param array $applicationTiers
     *
     * @throws Exception\InvalidArgumentException
     */
    private function validateDefinition($tier, array $applicationTiers)
    {
        if (!is_string($tier) || empty($tier) || !in_array($tier, $this->allPossibleTiers)) {
            throw new Exception\InvalidArgumentException(sprintf('Tier name (%s) is not valid', $tier));
        }

        foreach ($applicationTiers as $applicationTier) {
            if (!in_array($applicationTier, $this->allPossibleTiers)) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'At least one available tier (%s) is invalid',
                    $applicationTier
                ));
            }
        }

        if (!in_array($tier, $applicationTiers)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Tier (%s) must be one of available environments',
                $tier
            ));
        }
    }
}
