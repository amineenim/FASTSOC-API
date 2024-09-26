<?php

namespace App\Enums;

enum FilterParameter: string
{
    case OFFER_ID = 'offer_id';
    case TECHNOLOGY_ID = 'technology_id';
    case CLIENT_ID = 'client_id';
    case STATUS = 'status';
}
