<?php

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SystemDetailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BusinessDayController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Route::get('/role', function () {
//     $user = User::find(2);
//     $user->assignRole('admin');
//     dd('Done');
// });

Route::get('/custom/logout', function () {
    $user = auth()->user();
    if ($user) {
        Auth::logout($user);
        dd('done');
    }

});

Route::get('/seed-permission', function () {
    $permissions = [
        'building-read',
        'building-create',
        'building-edit',
        'building-delete',
        'floor-read',
        'floor-create',
        'floor-edit',
        'floor-delete',
        'category-read',
        'category-create',
        'category-edit',
        'category-delete',
        'amenity-read',
        'amenity-create',
        'amenity-edit',
        'amenity-delete',
        'room-read',
        'room-edit',
        'room-create',
        'room-edit',
        'room-delete',
        'frontdesk-read',
        'frontdesk-book',
        'booking',
        'discount-report',
        'debt-report',
        'cancel-report',
        'reserve-report',
        'vacant-report',
        'user-read',
        'user-create',
        'user-edit',
        'user-delete',
        'roles-read',
        'roles-edit',
        'roles-delete',
        'roles-create',
        'system-read',
        'system-edit',
        'dashboard',
        'print-receipt',
        'booking-read',
        'booking-create',
        'booking-edit',
        'booking-delete',
    ];

    foreach ($permissions as $permission) {
        Permission::firstorcreate(['name' => $permission]);
    }

});

// Route::get('/home', function(){
//       return redirect('admin/dashboard');
// });

// Route::get('/', function(){
//     return redirect('admin/dashboard');
// });

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Auth::routes();

Route::middleware('active_user')->group(function () {
/* ===============ADMIN ROUTES ===========================*/
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Frontdesk
        Route::get('/frontdesk', [DashboardController::class, 'frontdesk'])->name('frontdesk');

        // Booking
        Route::controller(BookingController::class)->prefix('booking')->name('booking.')->group(function () {
            Route::get('/room/{uid}', 'index')->name('index');
            Route::post('/room/{uid}', 'store')->name('store');
            Route::get('/list', 'list')->name('list');
            Route::get('/receipt/{id}', 'receipt')->name('receipt');
            // Route::post('/ajax/checkout', 'checkoutRoom')->name('ajax.checkout-room');

            Route::post('/checkout', 'postCheckoutRoom')->name('checkout-room');
            Route::post('/get-checkout-room', 'getCheckoutRoom')->name('ajax.checkout-room');
            Route::post('/get-clean-room', 'getCleanRoom')->name('ajax.clean-room');
            Route::post('/get-pay-debt', 'getPayDebt')->name('ajax.pay-debt');
            Route::post('/ajax/cancel', 'cancelRoom')->name('ajax.cancel-room');
            Route::post('/cancel/{id}', 'cancelRoom')->name('cancel');
            Route::post('/activate/{id}', 'activateRoom')->name('activate');
            Route::post('/pay-debt/{id}', 'payDebt')->name('pay-debt');
            Route::get('/reservation', 'reservation')->name('reservation');
            Route::get('/list-reservation', 'listReservation')->name('list-reservations');
            Route::post('/reservation', 'reserveRoom')->name('reserve');
            Route::post('/get-cancelroom', 'getCancelRoom')->name('get-cancel-room');
        });
        /* ==========BUILDINGS CONTROLLER ==========*/
        Route::controller(BuildingController::class)->prefix('building')->name('building.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
        });
        /* ==========FLOORS CONTROLLER ==========*/
        Route::controller(FloorController::class)->prefix('floor')->name('floor.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
        });
        /* ==========CATEGORY CONTROLLER ==========*/
        Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
        });
        /* ==========AMENITIES CONTROLLER ==========*/
        Route::controller(AmenityController::class)->prefix('amenity')->name('amenity.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
        });
        /* ==========ROOMS CONTROLLER ==========*/
        Route::controller(RoomController::class)->prefix('room')->name('room.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/clean/{id}', 'clean')->name('clean');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
        });

        /* ==========REPORTS CONTROLLER ==========*/
        Route::controller(ReportController::class)->prefix('report')->name('report.')->group(function () {
            Route::get('/discount', 'showDiscount')->name('discount');
            Route::get('/debt', 'showDebt')->name('debt');
            Route::get('/cancel', 'showCancel')->name('cancel');
            Route::get('/sales', 'showSales')->name('sales');
            Route::get('/reserve', 'showReserve')->name('reserve');
            Route::get('/vacant', 'showVacant')->name('vacant');
            Route::get('/general', 'showGeneral')->name('general');
        });
        /* ==========ROLES AND PRIVILEDGES CONTROLLER ==========*/
        Route::controller(RoleController::class)->prefix('role')->name('role.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
            Route::get('/permissions/{id}', 'getPermission')->name('permission');
            Route::post('/update-permissions/{id}', 'updatePermission')->name('permissions-update');
        });
        /* ==========USERS CONTROLLER ==========*/
        Route::controller(UserController::class)->prefix('users')->name('user.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
            Route::get('/permissions/{id}', 'getPermission')->name('permission');
            Route::post('/update-permissions/{id}', 'updatePermission')->name('permissions-update');
        });

        /* ==========SystemDetailController CONTROLLER ==========*/
        Route::controller(SystemDetailController::class)->prefix('system')->name('system.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('destroy');
        });

        Route::controller(BusinessDayController::class)->prefix('end-business-day')->name('end-business.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'updateBusinessDay')->name('update');
        });

        /* ==========BUILDINGS CONTROLLER ==========*/
        Route::controller(CustomerController::class)->prefix('customers')->name('customer.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

/* =====================USER ROUTE ============================*/
    Route::prefix('user')->middleware(['auth'])->name('user.')->group(function () {

        // dashboard
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        // dispatch
        Route::post('/dashboard/dispatch/{id}', [UserDashboardController::class, 'dispatchProduct'])->name('product.dispatchProduct');

        // report
        Route::get('/report', [UserDashboardController::class, 'report'])->name('report');
    });
});
