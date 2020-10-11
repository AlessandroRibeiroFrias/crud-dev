<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;

use App\Application\Actions\Dev\ListDevAction;
use App\Application\Actions\Dev\ViewDevAction;
use App\Application\Actions\Dev\NewDevAction;
use App\Application\Actions\Dev\EditDevAction;
use App\Application\Actions\Dev\DeleteDevAction;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/developers', function (Group $group) {
        $group->get('', ListDevAction::class);
        $group->get('/{id}', ViewDevAction::class);
        $group->post('', NewDevAction::class);
        $group->put('/{id}', EditDevAction::class);
        $group->delete('/{id}', DeleteDevAction::class);
    });

  //   $app->group('/developers', function () use ($app) {
  //     // Get all
  //     $app->get('', 'App\Controllers\DevController:get');
  //     // Create new record
  //     $app->post('', 'App\Controllers\DevController:post');
  //     // Update record
  //     $app->put('', 'App\Controllers\DevController:put');
  //     // Get by id
  //     $app->get('/{id}', 'App\Controllers\DevController:getById');
  //     // Delete record with ID
  //     $app->delete('/{id}', 'App\Controllers\DevController:delete');
  // });
};
