<?php

function admin_route($route,$params = []){

    $prefix = config('app.backend_uri');
    return route($prefix.'.'.$route, $params);
}