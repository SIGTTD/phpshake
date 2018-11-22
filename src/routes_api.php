<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 02.11.2018
 * Time: 23:06
 */

return [
	'~^articles/(\d+)$~' => [\Controllers\Api\ArticlesApiController::class, 'view'],
	'~^articles/add$~' => [\Controllers\Api\ArticlesApiController::class, 'add'],
];