<?php

namespace Pachico\Tier;

class TierTest extends \PHPUnit_Framework_TestCase
{
    public function testTierNotValidString()
    {
        // Arrange
        $this->setExpectedException(
            'Pachico\Tier\Exception\InvalidArgumentException',
            'Tier name () is not valid'
        );
        // Act
        new Tier('');
    }

    public function testConstructorInvalidTier()
    {
        // Arrange
        $this->setExpectedException(
            'Pachico\Tier\Exception\InvalidArgumentException',
            'Tier name (invalidTier) is not valid'
        );
        // Act
        new Tier('invalidTier', []);
    }

    public function testConstructorInvalidTierIsNotInApplicationTears()
    {
        // Arrange
        $this->setExpectedException(
            'Pachico\Tier\Exception\InvalidArgumentException',
            'Tier ('.Tier::PRODUCTION . ') must be one of available environments'
        );
        // Act
        new Tier(Tier::PRODUCTION, [Tier::DEVELOPMENT]);
    }

    public function testConstructorInvalidApplicationTiers()
    {
        // Arrange
        $this->setExpectedException(
            'Pachico\Tier\Exception\InvalidArgumentException',
            'At least one available tier (invalidTier) is invalid'
        );
        // Act
        new Tier(Tier::PRODUCTION, ['invalidTier']);
    }

    public function testConstructorDefaultTiers()
    {
        // Arrange
        $defaultTiers = [
            Tier::LOCAL,
            Tier::DEVELOPMENT,
            Tier::INTEGRATION,
            Tier::TEST,
            Tier::STAGING,
            Tier::PRODUCTION,
        ];
        $sut = new Tier(Tier::STAGING);
        // Act
        $output = $sut->getApplicationTiers();
        // Assert
        $this->assertSame($defaultTiers, $output);
    }

    public function testGetApplicationTiers()
    {
        // Arrange
        $applicationTiers = [
            Tier::STAGING,
            Tier::INTEGRATION
        ];
        $sut = new Tier(Tier::STAGING, $applicationTiers);
        // Act
        $output = $sut->getApplicationTiers();
        // Assert
        $this->assertSame($applicationTiers, $output);
    }

    public function testToString()
    {
        // Arrange
        $sut = new Tier(Tier::PRODUCTION);
        // Act
        $output = (string) $sut;
        // Assert
        $this->assertSame(Tier::PRODUCTION, $output);
    }

    public function testJsonSerializable()
    {
        // Arrange
        $applicationTiers = [
            Tier::DEVELOPMENT,
            Tier::STAGING,
            Tier::INTEGRATION
        ];
        $sut = new Tier(Tier::STAGING, $applicationTiers);
        // Act
        $output = json_encode($sut);
        // Assert
        $this->assertSame('{"tier":"staging","applicationTiers":["development","staging","integration"]}', $output);
    }

}
