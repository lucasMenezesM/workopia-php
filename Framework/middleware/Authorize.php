<?php

class Authorize
{

    /**
     * Check if iser is authenticatd
     * 
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return Session::has("user");
    }

    /**
     * handle the user's request
     * 
     *@param string $role
     * @return bool
     */
    public function handle(string $role)
    {
        if ($role === "guest" && $this->isAuthenticated()) {
            return redirect("/");
        } else if ($role === "auth" && !$this->isAuthenticated()) {
            return redirect("/auth/login");
        }
    }
}
