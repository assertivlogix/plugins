<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserDashboardController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'landing'])->withoutMiddleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/plugins', [ProductController::class, 'index'])->name('products.index');

// Individual plugin pages
// Individual plugin pages
    // Route::get('/plugins/{slug}', [ProductController::class, 'show'])->name('plugins.show');
    // However, existing links in legacy code might rely on specific names if not updated.
    // The previous steps ensure dynamic links use route('products.show') style logic, but let's conform to the plan.
    // We'll use a generic route that catches all.
    Route::get('/plugin/{slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/plugin/{slug}/download', [ProductController::class, 'download'])->name('products.download');

// Public checkout success route (must come before auth group)
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// Admin routes for WordPress plugin management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Plugin management routes
    Route::get('/plugins', [\App\Http\Controllers\Admin\WordPressPluginController::class, 'index'])->name('plugins.index');
    Route::get('/plugins/create', [\App\Http\Controllers\Admin\WordPressPluginController::class, 'create'])->name('plugins.create');
    Route::post('/plugins', [\App\Http\Controllers\Admin\WordPressPluginController::class, 'store'])->name('plugins.store');
    Route::get('/plugins/{id}', [\App\Http\Controllers\Admin\WordPressPluginController::class, 'show'])->name('plugins.show');
    Route::get('/plugins/{id}/edit', [\App\Http\Controllers\Admin\WordPressPluginController::class, 'edit'])->name('plugins.edit');
    Route::put('/plugins/{id}', [\App\Http\Controllers\Admin\WordPressPluginController::class, 'update'])->name('plugins.update');
    Route::delete('/plugins/{id}', [\App\Http\Controllers\Admin\WordPressPluginController::class, 'destroy'])->name('plugins.destroy');
    
    // Subscription renewal route
    Route::post('/subscriptions/renew', [\App\Http\Controllers\Admin\SubscriptionController::class, 'renew'])->name('subscriptions.renew');
    
    Route::resource('users', 'App\Http\Controllers\Admin\UserController');
    Route::get('/licenses', [\App\Http\Controllers\Admin\LicenseController::class, 'index'])->name('licenses.index');
    Route::get('/licenses/{license}', [\App\Http\Controllers\Admin\LicenseController::class, 'show'])->name('licenses.show');
    Route::put('/licenses/{license}', [\App\Http\Controllers\Admin\LicenseController::class, 'update'])->name('licenses.update');
    Route::delete('/licenses/{license}', [\App\Http\Controllers\Admin\LicenseController::class, 'destroy'])->name('licenses.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/{product:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/checkout/verify', [CheckoutController::class, 'verify'])->name('checkout.verify');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    // Note: /checkout/success is handled by the public route above
    
    // User subscription renewal routes
    Route::post('/subscriptions/renew', [\App\Http\Controllers\UserSubscriptionController::class, 'renew'])->name('user.subscriptions.renew');
    Route::post('/subscriptions/renew/razorpay', [\App\Http\Controllers\UserSubscriptionController::class, 'createRenewalOrder'])->name('user.subscriptions.renew.razorpay');
    Route::post('/subscriptions/renew/verify', [\App\Http\Controllers\UserSubscriptionController::class, 'verifyRenewal'])->name('user.subscriptions.renew.verify');
    
    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/licenses', [UserDashboardController::class, 'licenses'])->name('licenses');
        Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('/billing-history', [UserDashboardController::class, 'billingHistory'])->name('billing.history');
        
        // Initial purchase details
        Route::get('/licenses/{licenseId}/initial-purchase', [UserDashboardController::class, 'getInitialPurchase'])->name('licenses.initial-purchase');
        
        // License renewal history
        Route::get('/licenses/{licenseId}/renewal-history', [\App\Http\Controllers\UserSubscriptionController::class, 'getRenewalHistory'])->name('licenses.renewal-history');
        
        // Invoices
        Route::get('/invoices/{transaction}', [UserDashboardController::class, 'downloadInvoice'])->name('invoices.download');
    });
    
    // Alias routes for convenience
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/licenses', [UserDashboardController::class, 'licenses'])->name('licenses');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
});


Route::get('/test-success', function() {
    return 'Test route is working';
});

Route::get('/test-checkout-success', function() {
    return 'Checkout success route test - this should work';
});

Route::get('/test-auth', function() {
    return 'Auth test: ' . (auth()->check() ? 'Logged in' : 'Not logged in');
});
// Solution Routes
Route::prefix('solutions')->name('solutions.')->group(function () {
    Route::get('/security', [\App\Http\Controllers\SolutionController::class, 'security'])->name('security');
    Route::get('/seo', [\App\Http\Controllers\SolutionController::class, 'seo'])->name('seo');
    Route::get('/backup', [\App\Http\Controllers\SolutionController::class, 'backup'])->name('backup');
    Route::get('/performance', [\App\Http\Controllers\SolutionController::class, 'performance'])->name('performance');
});
// Support Routes
Route::prefix('support')->name('support.')->group(function () {
    Route::get('/', [\App\Http\Controllers\SupportController::class, 'index'])->name('index'); // Support Center
    Route::get('/documentation', [\App\Http\Controllers\SupportController::class, 'documentation'])->name('documentation');
    Route::get('/contact', [\App\Http\Controllers\SupportController::class, 'contact'])->name('contact');
    // Route::get('/forum', [\App\Http\Controllers\SupportController::class, 'forum'])->name('forum');
    
    // Create new group for Forum
    Route::get('/forum', [\App\Http\Controllers\ForumController::class, 'index'])->name('forum');
    Route::get('/forum/create', [\App\Http\Controllers\ForumController::class, 'create'])->name('forum.create')->middleware('auth');
    Route::post('/forum', [\App\Http\Controllers\ForumController::class, 'store'])->name('forum.store')->middleware('auth');
    Route::get('/forum/{slug}', [\App\Http\Controllers\ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{slug}/reply', [\App\Http\Controllers\ForumController::class, 'reply'])->name('forum.reply')->middleware('auth');
});

Route::get('/pricing', [\App\Http\Controllers\PricingController::class, 'index'])->name('pricing');
