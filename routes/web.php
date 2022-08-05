<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\ConvairController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DockController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsideController;
use App\Http\Controllers\LoaderController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PolicyDetailController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\ScaleController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\ShipingContractorController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ShipTripController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TrailerController;
use App\Http\Controllers\VehicleController;
use App\Models\contractor;
use App\Models\ShipTrip;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index']);
Route::resource('ship', ShipController::class);
Route::resource('port', PortController::class);
Route::resource('contractor', ContractorController::class);
Route::resource('shipingcontractor', ShipingContractorController::class);
Route::resource('loader', LoaderController::class);
Route::resource('convair', ConvairController::class);
Route::resource('vehicle', VehicleController::class);
Route::resource('trailer', TrailerController::class);
Route::resource('origin', OriginController::class);
Route::resource('driver', DriverController::class);
Route::resource('operator', \App\Http\Controllers\OperatorController::class);
Route::resource('draft', \App\Http\Controllers\DraftController::class);

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('cargo', CargoController::class);
Route::resource('store', StoreController::class);
Route::resource('dock', DockController::class);
Route::resource('shiptrip', ShipTripController::class);
Route::resource('release', ReleaseController::class);
Route::resource('destination', DestinationController::class);
Route::resource('policy', PolicyController::class);
Route::resource('policydetail', PolicyDetailController::class);
Route::resource('secondscale', ScaleController::class);
Route::resource('outgoing', ShippingController::class);
Route::resource('shipping', ShippingController::class);
Route::resource('inbetween', InsideController::class);
Route::resource('terminal', \App\Http\Controllers\TerminalController::class);

Route::resource('storage', \App\Http\Controllers\StorageController::class);
Route::get('shipping', [ShippingController::class, 'getShipping']);

Route::resource('underway', \App\Http\Controllers\EndShippingController::class);

Route::resource('inbetween', InsideController::class);
Route::resource('redirect', \App\Http\Controllers\RedirectController::class);

Route::resource('endstorage', \App\Http\Controllers\EndStorageController::class);

Route::get('print_policy/{id}', [PolicyController::class, 'print_policy']);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',\App\Http\Controllers\RoleController::class);
    Route::resource('users',\App\Http\Controllers\UserController::class);
});

Route::get('transported', [\App\Http\Controllers\TransController::class, 'index']);
Route::post('Search_policies', [\App\Http\Controllers\TransController::class, 'Search_policies']);

Route::get('storagereport', [\App\Http\Controllers\TransController::class, 'view_storage']);
Route::post('Search_storage', [\App\Http\Controllers\TransController::class, 'Search_storage']);

Route::get('shippingreport', [\App\Http\Controllers\TransController::class, 'view_shipping']);
Route::post('Search_shipping', [\App\Http\Controllers\TransController::class, 'Search_shipping']);

Route::get('/{page}', [AdminController::class, 'index']);
