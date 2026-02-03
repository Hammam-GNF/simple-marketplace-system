<?

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\AdminTransactionController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    Route::middleware('api.role:customer')->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index']);
        Route::post('/transactions', [TransactionController::class, 'store']);
        Route::post('/transactions/{transaction}/pay', [TransactionController::class, 'pay']);
        Route::post('/transactions/{transaction}/cancel', [TransactionController::class, 'cancel']);
    });

    Route::middleware('api.role:admin')->prefix('admin')->group(function () {
        Route::get('/transactions', [AdminTransactionController::class, 'index']);
        Route::post('/transactions/{transaction}/confirm', [AdminTransactionController::class, 'confirm']);
    });

});