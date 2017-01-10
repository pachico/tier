<?php

use Pachico\Tier\Tier;

require __DIR__ . '/../vendor/autoload.php';

$tier = new Tier(Tier::DEVELOPMENT, [
    Tier::DEVELOPMENT,
    Tier::STAGING,
    Tier::PRODUCTION
    ]
);

echo $tier . PHP_EOL; // development
echo json_encode($tier, JSON_PRETTY_PRINT) . PHP_EOL;
/**
{
    "tier": "development",
    "applicationTiers": [
        "development",
        "staging",
        "production"
    ]
}
*/