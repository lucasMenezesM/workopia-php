<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */

function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a view
 * 
 * @param string $name
 * @param array $data
 * @return void
 * 
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View {$viewPath} not found";
    }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @param array $data
 * @return void
 * 
 */
function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "The path $partialPath was not found";
    }
}

/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return return
 */
function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

/**
 * Inspect a value and die(s)
 * 
 * @param mixed $value
 * @return return
 */
function inspectAndDie($value)
{
    echo "<pre>";
    die(var_dump($value));
    echo "</pre>";
}

/**
 * Format the given salary
 *
 * @param string $salary
 * @return string
 */
function formatSalary(string $salary): string
{
    return "$ " . number_format(floatval($salary));
}


/**
 * Sanitize Data
 *
 * @param string $dirty
 * @return string
 */
function sanitize(string $dirty): string
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect user to another route
 *
 * @param string $uri
 * @return void
 */
function redirect(string $url): void
{
    header("Location: $url");
    exit;
}
