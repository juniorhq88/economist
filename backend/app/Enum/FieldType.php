<?php

namespace App\Enum;

enum FieldType: string
{
    case text = 'text';
    case textarea = 'textarea';
    case select = 'select';
    case radio = 'radio';
    case checkbox = 'checkbox';
}
