<?php

class ErrorController
{
    /**
     * Loads the Error View with 404 error.
     *
     * @param string $message
     * @return void
     */
    public static function notFound(string $message = "Resource not found"): void
    {
        http_response_code(404);
        loadView("error", ["httpCode" => 404, "message" => $message]);
    }

    /**
     * Loads the Error View with 403 error.
     *
     * @param string $message
     * @return void
     */
    public static function unauthorized(string $message = "You are not authorized to view this resource"): void
    {
        http_response_code(403);
        loadView("error", ["httpCode" => 403, "message" => $message]);
    }
}
