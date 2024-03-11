<?php
function setActive(array $routes)
{
    foreach ($routes as $route) {
        if (request()->routeIs($route))
            return "active";
    }
}
