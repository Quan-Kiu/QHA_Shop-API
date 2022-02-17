<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Color;
use App\Models\Comment;
use App\Models\order;
use App\Models\Discount;
use App\Models\Orderstatus;
use App\Models\Size;
use App\Models\ProductType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', function () {
        return view('site.auth.register');
    });
    Route::get('/login', function () {
        return view('site.auth.login');
    })->name('login');
    Route::get('/forgot-password', function () {
        return view('site.auth.forgot-password');
    })->name('forgot-password');
    Route::get('/reset-password', function () {
        return view('site.auth.reset-password');
    })->name('reset-password');
});


Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', function () {
            $from = date("2022-02-01");
            $to = date("2022-02-18");
            $orders = Order::whereBetween('created_at', [$from, $to]);
            $data = $orders->selectRaw('sum(unit_price) as unitPrice, Date(created_at) as date')->groupBy('date')->get();
            return view('admin.dashboard',['data' => $data]);
        })->name('dashboard');

        // Product
        Route::get('/products', function () {
            $product = Product::all();
            $product_type = ProductType::all();
            $data['products'] = $product;
            $data['product_type'] = $product_type;
            return view('admin.products.index', ['data' => $data]);
        });

        Route::get('/products/add', function () {
            $sizes = Size::all();
            $colors = Color::all();
            $product_types = ProductType::all();
            $response['sizes']  = $sizes;
            $response['colors']  = $colors;
            $response['product_types']  = $product_types;
            return view('admin.products.add', ['data' => $response]);
        });

        Route::get('/products/{product}', function (Product $product) {
            $sizes = Size::all();
            $colors = Color::all();
            $product_types = ProductType::all();
            $response['sizes']  = $sizes;
            $response['colors']  = $colors;
            $response['product_types']  = $product_types;
            $response['product']  = $product;
            return view('admin.products.update', ['data' => $response]);
        });


        Route::group(['prefix' =>'users'], function (){
            // Account
            Route::get('/', function () {
                $users = User::all();
                return view('admin.users.index', ['users' => $users]);
            });
            Route::get('/add', function () {
                $user_type = UserType::all();
                return view('admin.users.add', ['user_type' => $user_type]);
            });
            Route::get('/{user}', function (User $user) {
                $user_type = UserType::all();
                $data['user'] = $user;
                $data['user_type'] = $user_type;
                return view('admin.users.update', ['data' => $data]);
            });
        });

        // // Cart
        // Route::get('/carts', function () {
        //     $carts = Cart::all();
        //     return view('admin.carts.index', ['carts' => $carts]);
        // });

        Route::group(['prefix'=>'discounts'],function(){

            Route::get('/', function () {
                $discounts = Discount::all();
                return view('admin.discounts.index', ['discounts' => $discounts]);
            });
    
            Route::get('/add', function () {
                return view('admin.discounts.add');
            });

            Route::get('/{discount}', function (Discount $discount) {
                return view('admin.discounts.update',['discount' => $discount]);
            });
           

        });


    //    colors
        Route::group(['prefix' =>'colors'],function (){

            Route::get('/', function () {
                $colors = Color::all();
                return view('admin.colors.index', ['colors' => $colors]);
            });
            Route::get('/add', function () {
                return view('admin.colors.add');
            });
            Route::get('/{color}', function (Color $color) {
                return view('admin.colors.update', ['color' => $color]);
            });
    

        });

       
        // Order
        Route::get('/orders', function () {
            $orderStatus = Orderstatus::all();
            $orders = Order::all()->reverse();
            $data['orders'] = $orders;
            $data['orders_status'] = $orderStatus;
            return view('admin.orders.index', ['data' => $data]);
        });
        Route::get('/orders/add', function () {
            return view('admin.orders.add');
        });
        Route::get('/orders/{order}', function ($id) {
            $orders = Order::find($id);
            return view('admin.orders.update', ['order' => $orders]);
        });


        // Size
        Route::get('/sizes', function () {
            $sizes = Size::all();
            return view('admin.sizes.index', ['sizes' => $sizes]);
        });
        Route::get('/sizes/add', function () {
            $product_types = ProductType::all();
            return view('admin.sizes.add', ['product_types' => $product_types]);
        });
        Route::get('/sizes/{size}', function (Size $size) {
            $product_types = ProductType::all();
            $data['size'] = $size;
            $data['product_types'] = $product_types;
            return view('admin.sizes.update', ['data' => $data]);
        });

        // Product Type
        Route::get('/producttypes', function () {
            $product = ProductType::all();
            return view('admin.producttypes.index', ['product' => $product]);
        });

        Route::get('/producttypes/add', function () {
            return view('admin.producttypes.add');
        });
        Route::get('/producttypes/{producttype}', function (ProductType $producttype) {
            return view('admin.producttypes.update', ['producttype' => $producttype]);
        });

        Route::get('/producttypes/{producttype}', function (ProductType $producttype) {
            return view('admin.producttypes.update', ['producttype' => $producttype]);
        });

        // Order Status
        Route::get('/orders_status', function () {
            $orders_status = Orderstatus::all();
            return view('admin.orders_status.index', ['orders_status' => $orders_status]);
        });

        Route::get('/orders_status/add', function () {
            return view('admin.orders_status.add');
        });

        Route::get('/orders_status/{orderstatus}', function (Orderstatus $orderstatus) {
            return view('admin.orders_status.update', ['order_status' => $orderstatus]);
        });



        // Comments
        Route::get('/comments', function () {
            $comments = Comment::all();
            return view('admin.comments.index', ['comment' => $comments]);
        });
    });
});
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/home', function () {
        $product = Product::all();
        $producttype = ProductType::all();
        return view('user.home', compact('product','producttype'));
    })->name('homepage');
    // Route::get('/category/{slug}', function () {
    //     return view('user.category');
    // });

    Route::get('/detail/{product}', function ($id) {
        $product = Product::find($id);
        $size = Size::all();
        return view('user.detail', compact('product','size'));
    });

    Route::get('/category/{producttype}', function ($id) {
        $producttype = ProductType::all();
        $product = DB::table('products')->where('product_type_id','=', $id)->get();
        return view('user.category.menclothes',compact('product','producttype',));
    });
    Route::get('/menu', function () {
        $product = Product::all();
        $producttype = ProductType::all();
        return view('user.menu', compact('product','producttype'));
    });
    Route::get('/cart', function () {
        return view('user.cart');
    });

    Route::get('/checkout', function () {
        return view('user.checkout');
    });
    
   
});


Route::group(['prefix' => 'email'], function () {
    Route::get('inbox', function () {
        return view('admin.pages.email.inbox');
    });
    Route::get('read', function () {
        return view('admin.pages.email.read');
    });
    Route::get('compose', function () {
        return view('admin.pages.email.compose');
    });
});

Route::group(['prefix' => 'apps'], function () {
    Route::get('chat', function () {
        return view('admin.pages.apps.chat');
    });
    Route::get('calendar', function () {
        return view('admin.pages.apps.calendar');
    });
});

Route::group(['prefix' => 'ui-components'], function () {
    Route::get('alerts', function () {
        return view('admin.pages.ui-components.alerts');
    });
    Route::get('badges', function () {
        return view('admin.pages.ui-components.badges');
    });
    Route::get('breadcrumbs', function () {
        return view('admin.pages.ui-components.breadcrumbs');
    });
    Route::get('buttons', function () {
        return view('admin.pages.ui-components.buttons');
    });
    Route::get('button-group', function () {
        return view('admin.pages.ui-components.button-group');
    });
    Route::get('cards', function () {
        return view('admin.pages.ui-components.cards');
    });
    Route::get('carousel', function () {
        return view('admin.pages.ui-components.carousel');
    });
    Route::get('collapse', function () {
        return view('admin.pages.ui-components.collapse');
    });
    Route::get('dropdowns', function () {
        return view('admin.pages.ui-components.dropdowns');
    });
    Route::get('list-group', function () {
        return view('admin.pages.ui-components.list-group');
    });
    Route::get('media-object', function () {
        return view('admin.pages.ui-components.media-object');
    });
    Route::get('modal', function () {
        return view('admin.pages.ui-components.modal');
    });
    Route::get('navs', function () {
        return view('admin.pages.ui-components.navs');
    });
    Route::get('navbar', function () {
        return view('admin.pages.ui-components.navbar');
    });
    Route::get('pagination', function () {
        return view('admin.pages.ui-components.pagination');
    });
    Route::get('popovers', function () {
        return view('admin.pages.ui-components.popovers');
    });
    Route::get('progress', function () {
        return view('admin.pages.ui-components.progress');
    });
    Route::get('scrollbar', function () {
        return view('admin.pages.ui-components.scrollbar');
    });
    Route::get('scrollspy', function () {
        return view('admin.pages.ui-components.scrollspy');
    });
    Route::get('spinners', function () {
        return view('admin.pages.ui-components.spinners');
    });
    Route::get('tabs', function () {
        return view('admin.pages.ui-components.tabs');
    });
    Route::get('tooltips', function () {
        return view('admin.pages.ui-components.tooltips');
    });
});

Route::group(['prefix' => 'advanced-ui'], function () {
    Route::get('cropper', function () {
        return view('admin.pages.advanced-ui.cropper');
    });
    Route::get('owl-carousel', function () {
        return view('admin.pages.advanced-ui.owl-carousel');
    });
    Route::get('sweet-alert', function () {
        return view('admin.pages.advanced-ui.sweet-alert');
    });
});

Route::group(['prefix' => 'forms'], function () {
    Route::get('basic-elements', function () {
        return view('admin.pages.forms.basic-elements');
    });
    Route::get('advanced-elements', function () {
        return view('admin.pages.forms.advanced-elements');
    });
    Route::get('editors', function () {
        return view('admin.pages.forms.editors');
    });
    Route::get('wizard', function () {
        return view('admin.pages.forms.wizard');
    });
});

Route::group(['prefix' => 'charts'], function () {
    Route::get('apex', function () {
        return view('admin.pages.charts.apex');
    });
    Route::get('chartjs', function () {
        return view('admin.pages.charts.chartjs');
    });
    Route::get('flot', function () {
        return view('admin.pages.charts.flot');
    });
    Route::get('morrisjs', function () {
        return view('admin.pages.charts.morrisjs');
    });
    Route::get('peity', function () {
        return view('admin.pages.charts.peity');
    });
    Route::get('sparkline', function () {
        return view('admin.pages.charts.sparkline');
    });
});

Route::group(['prefix' => 'tables'], function () {
    Route::get('basic-tables', function () {
        return view('admin.pages.tables.basic-tables');
    });
    Route::get('data-table', function () {
        return view('admin.pages.tables.data-table');
    });
});

Route::group(['prefix' => 'icons'], function () {
    Route::get('feather-icons', function () {
        return view('admin.pages.icons.feather-icons');
    });
    Route::get('flag-icons', function () {
        return view('admin.pages.icons.flag-icons');
    });
    Route::get('mdi-icons', function () {
        return view('admin.pages.icons.mdi-icons');
    });
});

Route::group(['prefix' => 'general'], function () {
    Route::get('blank-page', function () {
        return view('admin.pages.general.blank-page');
    });
    Route::get('faq', function () {
        return view('admin.pages.general.faq');
    });
    Route::get('invoice', function () {
        return view('admin.pages.general.invoice');
    });
    Route::get('profile', function () {
        return view('admin.pages.general.profile');
    });
    Route::get('pricing', function () {
        return view('admin.pages.general.pricing');
    });
    Route::get('timeline', function () {
        return view('admin.pages.general.timeline');
    });
});



Route::group(['prefix' => 'error'], function () {
    Route::get('404', function () {
        return view('admin.pages.error.404');
    });
    Route::get('500', function () {
        return view('admin.pages.error.500');
    });
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::any('/{page?}', function () {
    return View::make('admin.pages.error.404');
})->where('page', '.*');
