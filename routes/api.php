<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InquiryController;
use App\Http\Controllers\Api\PortfolioItemController;
use App\Http\Controllers\Api\ProductCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImageController;
use App\Http\Controllers\Api\TestimonialController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('services', ServiceController::class);
Route::apiResource('products', ProductController::class);


// Public - anyone can read
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service}', [ServiceController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/product-categories', [ProductCategoryController::class, 'index']);
Route::get('/product-categories/{productCategory}', [ProductCategoryController::class, 'show']);
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show']);
Route::post('/inquiries', [InquiryController::class, 'store']);
Route::get('/portfolio-items', [PortfolioItemController::class, 'index']);
Route::get('/portfolio-items/{portfolioItem}', [PortfolioItemController::class, 'show']);


// Protected - only logged-in (admin) users can write
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{service}', [ServiceController::class, 'update']);
    Route::delete('/services/{service}', [ServiceController::class, 'destroy']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    Route::post('/product-categories', [ProductCategoryController::class, 'store']);
    Route::put('/product-categories/{productCategory}', [ProductCategoryController::class, 'update']);
    Route::delete('/product-categories/{productCategory}', [ProductCategoryController::class, 'destroy']);
    Route::post('/products/{product}/images', [ProductImageController::class, 'store']);
    Route::delete('/product-images/{productImage}', [ProductImageController::class, 'destroy']);
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update']);
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy']);
    Route::get('/inquiries', [InquiryController::class, 'index']);
    Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show']);
    Route::put('/inquiries/{inquiry}', [InquiryController::class, 'update']);
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy']);
    Route::post('/portfolio-items', [PortfolioItemController::class, 'store']);
    Route::put('/portfolio-items/{portfolioItem}', [PortfolioItemController::class, 'update']);
    Route::delete('/portfolio-items/{portfolioItem}', [PortfolioItemController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
