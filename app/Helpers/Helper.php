<?php
// Set active for admin navbar
function setActive(array $routes)
{
    foreach ($routes as $route) {
        if (request()->routeIs($route))
            return "active";
    }
};

// Check table is Empty 
function isTableEmpty($model){
    return $model->isEmpty();
}
 