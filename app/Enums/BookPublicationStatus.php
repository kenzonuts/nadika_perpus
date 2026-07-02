<?php

namespace App\Enums;

enum BookPublicationStatus: string
{
    case Published = 'published';
    case Draft = 'draft';
    case Archived = 'archived';
}
