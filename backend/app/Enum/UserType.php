<?php

namespace App\Enum;

enum UserType: string
{
    case SuperAdmin = 'SuperAdmin';
    case Customer = 'Customer';
    case Tramitee = 'Tramitee';
    case Executive = 'Executive';
}
