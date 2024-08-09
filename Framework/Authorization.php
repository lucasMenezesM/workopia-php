<?php

class Authorization
{
    public static function IsOwner(string $resourceId): bool
    {
        if (Session::has("user")) {
            $currentUserId = Session::getSession("user")["id"];
            return $currentUserId == $resourceId;
        }
        return false;
    }
}
