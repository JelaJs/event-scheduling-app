<?php

namespace App;

enum ReservationStatus: string
{
    case PENDING_STATUS = 'pending';
    case APPROVED_STATUS = 'approved';
    case REJECTED_STATUS = 'rejected';
}
