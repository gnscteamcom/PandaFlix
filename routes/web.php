<?php

use Illuminate\Support\Facades\File;
use App\Components\Common\Helper\ComponentHelper;

$api_routes = ComponentHelper::getWebRouteFiles();

foreach ($api_routes as $route_file) {
    File::requireOnce($route_file);
}
