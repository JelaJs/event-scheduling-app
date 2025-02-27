<?php

namespace App;

enum UserRole: string
{
    case BAND_MANAGER_ROLE = 'band_manager';
    case CUSTOMER_ROLE = "customer";
    case RESTAURANT_MANAGER_ROLE = 'restaurant_manager';
}
