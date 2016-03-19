<?php

function admin_route($route,$params = []){

    $prefix = config('app.backend_uri');
    return route($prefix.'.'.$route, $params);
}
function static_files_route($route){

    $base_url = config('app.base_url');
    $asset_info = config('basic.static_asset_url');
    if($asset_info['subdomain']!=null){
        $base_url =$asset_info['subdomain'].".".$base_url;
    }
    if($asset_info['public_folder']!=null){
        $base_url =$base_url."/".$asset_info['public_folder']."/";
    }
    $base_url = "http://".$base_url;
    return asset($base_url.$route);
}