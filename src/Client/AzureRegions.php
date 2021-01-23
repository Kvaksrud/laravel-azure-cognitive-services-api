<?php

namespace Kvaksrud\AzureCognitiveServices\Api\Client;

class AzureRegions {

    const AUSTRALIA_EAST = 'australiaeast';
    const BRAZIL_SOUTH = 'brazilsouth';
    const CANADA_CENTRAL = 'canadacentral';
    const CENTRAL_INDIA = 'centralindia';
    const CENTRAL_US = 'centralindia';

    const EAST_ASIA = 'eastasia';
    const EAST_US = 'eastus';
    const EAST_US_2 = 'eastus2';
    const FRANCE_CENTRAL = 'francecentral';
    const JAPAN_EAST = 'japaneast';

    const JAPAN_WEST = 'japanwest';
    const KOREA_CENTRAL = 'koreacentral';
    const NORTH_CENTRAL_US = 'northcentralus';
    const NORTH_EUROPE = 'northeurope';
    const SOUTH_AFRICA_NORTH = 'southafricanorth';

    const SOUTH_CENTRAL_US = 'southcentralus';
    const SOUTHEAST_ASIA = 'southeastasia';
    const UK_SOUTH = 'uksouth';
    const WEST_CENTRAL_US = 'westcentralus';
    const WEST_EUROPE = 'westeurope';

    const WEST_US = 'westus';
    const WEST_US_2 = 'westus2';

    static public function getRegionEndpointBaseUri($region = AzureRegions::NORTH_EUROPE): string
    {
        return 'https://'.$region.'.api.cognitive.microsoft.com/';
    }

}
