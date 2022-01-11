<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Color;
use App\Models\Comment;
use App\Models\order;
use App\Models\OrderDetail;
use App\Models\Orderstatus;
use App\Models\Size;
use App\Models\ProductType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', function () {
        return view('pages.auth.register');
    });
    Route::get('/login', function () {
        return view('pages.auth.login');
    })->name('login');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Product
    Route::get('/products', function () {
        $product = Product::all();
        return view('products.index', ['product' => $product]);
    });
    Route::get('/products/add', function () {
        $sizes = Size::all();
        $colors = Color::all();
        $product_types = ProductType::all();
        $response['sizes']  = $sizes;
        $response['colors']  = $colors;
        $response['product_types']  = $product_types;
        return view('products.add', ['data' => $response]);
    });

    // Account
    Route::get('/users', function () {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    });
    Route::get('/users/add', function () {
        $user_type = UserType::all();
        return view('users.add', ['user_type' => $user_type]);
    });
    Route::get('/users/{user}', function (User $user) {
        $user_type = UserType::all();
        $data['user'] = $user;
        $data['user_type'] = $user_type;
        return view('users.update', ['data' => $data]);
    });

    // Cart
    Route::get('/carts', function () {
        $carts = Cart::all();
        return view('carts.index', ['carts' => $carts]);
    });

    // Color
    Route::get('/colors', function () {
        $colors = Color::all();
        return view('colors.index', ['colors' => $colors]);
    });
    Route::get('/colors/add', function () {
        return view('colors.add');
    });
    Route::get('/colors/{color}', function (Color $color) {
        return view('colors.update', ['color' => $color]);
    });

    // Order
    Route::get('/orders', function () {
        $orderStatus = Orderstatus::all();
        $orders = Order::all();
        $data['orders'] = $orders;
        $data['orders_status'] = $orderStatus;
        return view('orders.index', ['data' => $data]);
    });
    Route::get('/orders/add', function () {
        return view('orders.add');
    });
    Route::get('/orders/{order}', function ($id) {
        $orders = Order::find($id);
        return view('orders.update', ['order' => $orders]);
    });


    // Size
    Route::get('/sizes', function () {
        $sizes = Size::all();
        return view('sizes.index', ['sizes' => $sizes]);
    });
    Route::get('/sizes/add', function () {
        $product_types = ProductType::all();
        return view('sizes.add', ['product_types' => $product_types]);
    });
    Route::get('/sizes/{size}', function (Size $size) {
        $product_types = ProductType::all();
        $data['size'] = $size;
        $data['product_types'] = $product_types;
        return view('sizes.update', ['data' => $data]);
    });

    // Product Type
    Route::get('/producttypes', function () {
        $product = ProductType::all();
        return view('producttypes.index', ['product' => $product]);
    });

    Route::get('/producttypes/add', function () {
        return view('producttypes.add');
    });
    Route::get('/producttypes/{producttype}', function (ProductType $producttype) {
        return view('producttypes.update', ['producttype' => $producttype]);
    });

    Route::get('/producttypes/{producttype}', function (ProductType $producttype) {
        return view('producttypes.update', ['producttype' => $producttype]);
    });

    // Order Status
    Route::get('/orders_status', function () {
        $orders_status = Orderstatus::all();
        return view('orders_status.index', ['orders_status' => $orders_status]);
    });

    Route::get('/orders_status/add', function () {
        return view('orders_status.add');
    });

    Route::get('/orders_status/{orderstatus}', function (Orderstatus $orderstatus) {
        return view('orders_status.update', ['order_status' => $orderstatus]);
    });



    // Comments
    Route::get('/comments', function () {
        $comments = Comment::all();
        return view('comments.index', ['comment' => $comments]);
    });
});


Route::group(['prefix' => 'email'], function () {
    Route::get('inbox', function () {
        return view('pages.email.inbox');
    });
    Route::get('read', function () {
        return view('pages.email.read');
    });
    Route::get('compose', function () {
        return view('pages.email.compose');
    });
});

Route::group(['prefix' => 'apps'], function () {
    Route::get('chat', function () {
        return view('pages.apps.chat');
    });
    Route::get('calendar', function () {
        return view('pages.apps.calendar');
    });
});

Route::group(['prefix' => 'ui-components'], function () {
    Route::get('alerts', function () {
        return view('pages.ui-components.alerts');
    });
    Route::get('badges', function () {
        return view('pages.ui-components.badges');
    });
    Route::get('breadcrumbs', function () {
        return view('pages.ui-components.breadcrumbs');
    });
    Route::get('buttons', function () {
        return view('pages.ui-components.buttons');
    });
    Route::get('button-group', function () {
        return view('pages.ui-components.button-group');
    });
    Route::get('cards', function () {
        return view('pages.ui-components.cards');
    });
    Route::get('carousel', function () {
        return view('pages.ui-components.carousel');
    });
    Route::get('collapse', function () {
        return view('pages.ui-components.collapse');
    });
    Route::get('dropdowns', function () {
        return view('pages.ui-components.dropdowns');
    });
    Route::get('list-group', function () {
        return view('pages.ui-components.list-group');
    });
    Route::get('media-object', function () {
        return view('pages.ui-components.media-object');
    });
    Route::get('modal', function () {
        return view('pages.ui-components.modal');
    });
    Route::get('navs', function () {
        return view('pages.ui-components.navs');
    });
    Route::get('navbar', function () {
        return view('pages.ui-components.navbar');
    });
    Route::get('pagination', function () {
        return view('pages.ui-components.pagination');
    });
    Route::get('popovers', function () {
        return view('pages.ui-components.popovers');
    });
    Route::get('progress', function () {
        return view('pages.ui-components.progress');
    });
    Route::get('scrollbar', function () {
        return view('pages.ui-components.scrollbar');
    });
    Route::get('scrollspy', function () {
        return view('pages.ui-components.scrollspy');
    });
    Route::get('spinners', function () {
        return view('pages.ui-components.spinners');
    });
    Route::get('tabs', function () {
        return view('pages.ui-components.tabs');
    });
    Route::get('tooltips', function () {
        return view('pages.ui-components.tooltips');
    });
});

Route::group(['prefix' => 'advanced-ui'], function () {
    Route::get('cropper', function () {
        return view('pages.advanced-ui.cropper');
    });
    Route::get('owl-carousel', function () {
        return view('pages.advanced-ui.owl-carousel');
    });
    Route::get('sweet-alert', function () {
        return view('pages.advanced-ui.sweet-alert');
    });
});

Route::group(['prefix' => 'forms'], function () {
    Route::get('basic-elements', function () {
        return view('pages.forms.basic-elements');
    });
    Route::get('advanced-elements', function () {
        return view('pages.forms.advanced-elements');
    });
    Route::get('editors', function () {
        return view('pages.forms.editors');
    });
    Route::get('wizard', function () {
        return view('pages.forms.wizard');
    });
});

Route::group(['prefix' => 'charts'], function () {
    Route::get('apex', function () {
        return view('pages.charts.apex');
    });
    Route::get('chartjs', function () {
        return view('pages.charts.chartjs');
    });
    Route::get('flot', function () {
        return view('pages.charts.flot');
    });
    Route::get('morrisjs', function () {
        return view('pages.charts.morrisjs');
    });
    Route::get('peity', function () {
        return view('pages.charts.peity');
    });
    Route::get('sparkline', function () {
        return view('pages.charts.sparkline');
    });
});

Route::group(['prefix' => 'tables'], function () {
    Route::get('basic-tables', function () {
        return view('pages.tables.basic-tables');
    });
    Route::get('data-table', function () {
        return view('pages.tables.data-table');
    });
});

Route::group(['prefix' => 'icons'], function () {
    Route::get('feather-icons', function () {
        return view('pages.icons.feather-icons');
    });
    Route::get('flag-icons', function () {
        return view('pages.icons.flag-icons');
    });
    Route::get('mdi-icons', function () {
        return view('pages.icons.mdi-icons');
    });
});

Route::group(['prefix' => 'general'], function () {
    Route::get('blank-page', function () {
        return view('pages.general.blank-page');
    });
    Route::get('faq', function () {
        return view('pages.general.faq');
    });
    Route::get('invoice', function () {
        return view('pages.general.invoice');
    });
    Route::get('profile', function () {
        return view('pages.general.profile');
    });
    Route::get('pricing', function () {
        return view('pages.general.pricing');
    });
    Route::get('timeline', function () {
        return view('pages.general.timeline');
    });
});



Route::group(['prefix' => 'error'], function () {
    Route::get('404', function () {
        return view('pages.error.404');
    });
    Route::get('500', function () {
        return view('pages.error.500');
    });
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::any('/{page?}', function () {
    return View::make('pages.error.404');
})->where('page', '.*');
