<?php

namespace App\Enums;

enum PostType: string
{
    case TEXT = 'text';
    case IMAGE = 'image';
    case VIDEO = 'video';
    case REAL = 'real';
    case STORY = 'story';
}
