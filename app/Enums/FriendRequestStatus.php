<?php
namespace App\Enums;

enum FriendRequestStatus : string
{
    case PENDING='pending';
    case ACCEPTED='accepted';
    case DECLINED='declined';
}
