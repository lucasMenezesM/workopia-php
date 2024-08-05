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
    $viewPath = basePath("views/{$name}.view.php");

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
 * @return void
 * 
 */
function loadPartial($name)
{
    $partialPath = basePath("views/partials/{$name}.php");

    if (file_exists($partialPath)) {
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
