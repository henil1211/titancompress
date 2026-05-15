<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AIController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Web\RFQController as WebRFQController;
use App\Http\Controllers\Web\ComparisonController as WebComparisonController;

use App\Http\Controllers\Web\ProductController as WebProductController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/about', 'web.pages.about')->name('about');
Route::view('/contact', 'web.pages.contact')->name('contact');
Route::post('/contact', function (\Illuminate\Http\Request $request) {
    return back()->with('success', 'Thank you! Your message has been sent successfully. Our team will contact you shortly.');
})->name('contact.submit');

// Products Public Routes
Route::get('/products', [WebProductController::class, 'index'])->name('products.index'); 
Route::get('/products/{slug}', [WebProductController::class, 'show'])->name('products.show');

Route::post('/ai/chat', [AIController::class, 'chat'])->name('ai.chat');

// Public RFQ Routes
Route::get('/request-quote', [WebRFQController::class, 'show'])->name('rfq.show');
Route::post('/request-quote', [WebRFQController::class, 'submit'])->name('rfq.submit');

// Comparison Engine Routes
Route::get('/compare', [WebComparisonController::class, 'index'])->name('compare.index');
Route::post('/compare/add', [WebComparisonController::class, 'add'])->name('compare.add');
Route::post('/compare/remove', [WebComparisonController::class, 'remove'])->name('compare.remove');
Route::post('/compare/analyze', [WebComparisonController::class, 'analyze'])->name('compare.analyze');

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SpecificationController;

use App\Http\Controllers\Admin\RFQController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\KnowledgeController;

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Guest Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    // Authenticated Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
        Route::get('/knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');
        Route::post('/knowledge', [KnowledgeController::class, 'store'])->name('knowledge.store');
        Route::post('/knowledge/{document}/index', [KnowledgeController::class, 'indexDocument'])->name('knowledge.index_doc');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Product Management
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::get('specifications', [SpecificationController::class, 'index'])->name('specifications.index');
        Route::post('specifications/groups', [SpecificationController::class, 'storeGroup'])->name('specifications.groups.store');
        Route::post('specifications/attributes', [SpecificationController::class, 'storeAttribute'])->name('specifications.attributes.store');
        
        // RFQ Management
        Route::get('/rfqs', [RFQController::class, 'index'])->name('rfqs.index');
        Route::get('/rfqs/{rfq}', [RFQController::class, 'show'])->name('rfqs.show');
        Route::patch('/rfqs/{rfq}/status', [RFQController::class, 'updateStatus'])->name('rfqs.status');
        Route::patch('/rfqs/{rfq}/assign', [RFQController::class, 'assign'])->name('rfqs.assign');
        Route::post('/rfqs/{rfq}/note', [RFQController::class, 'addNote'])->name('rfqs.note');
    });
});
