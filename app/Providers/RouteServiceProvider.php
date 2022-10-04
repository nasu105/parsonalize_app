<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Controller;
// use App\Http\Controllers\Admin\UsersItemController;
use App\Http\Controllers\Admin\UsersItemController;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/user/item/create';
    public const ADMIN_HOME = '/admin/dashboard';
    // public const ADMIN_HOME = route('admin/usersitem/index');
    // public const ADMIN_HOME = route('admin/usersitem/index');
    // public const ADMIN_HOME = 'redirects';

    /* public function __construct() {
        $this->ADMIN_HOME = (route('admin.usersitem.index')) ->ADMIN_HOME;
        // $this->ADMIN_HOME = 'admin/usersitem/index' ->ADMIN_HOME;
        // $order_items = Item::query()
        //     ->where('order_flg','1')
        //     ->orderBy('created_at', 'desc')
        //     ->get();
    } */

    /* public function __construct(Router $router)
    {
        // ルートパラメータを取得する
        $routeParamName = 'prefecture_slug';
        $defaultValue = null;
        $routeParam = $router->getCurrentRoute()->getParameter($paramName, $defaultValue)
        
        // 全てのルートパラメータを取得したい場合は以下のようにする
        $allRouteParams = $router->getCurrentRoute()->parameters();
    } */
    



    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::prefix('admin')
                ->as('admin.')
                ->middleware('web')
                ->group(base_path('routes/admin.php'));

            // Route::prefix('/')
            Route::prefix('user')
                ->as('user.')
                ->middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
