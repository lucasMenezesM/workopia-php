<?php

class Session
{
    /**
     * Start the session
     *
     * @return void
     */
    public static function start(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session key/value pair
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function setSession(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session value by the key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getSession(string $key, mixed $default = null): mixed
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Check if session key exists
     *
     * @param string $key
     * @return boolean
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Clear session by key
     *
     * @param string $key
     * @return void
     */
    public static function clear(string $key): void
    {
        if (isset($_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Clear al session data
     *
     * @return void
     */
    public static function clearAll(): void
    {
        session_unset();
        session_destroy();
    }
}
