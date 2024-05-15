<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="STIVE LA CAVE", version="0.1")
 * @OA\Server(
 *     url="http://localhost:8888/",
 *     description="API LACAVE"
 * )
 */
require("vendor/autoload.php");
$openapi = \OpenApi\Generator::scan(['C:\xampp\htdocs\La-Cave']);
header('Content-Type: application/json');
echo $openapi->toJson();