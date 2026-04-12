<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API endpoints for shopping list item completion state
Route::patch('/shopping-list/items/{item}/complete', [App\Http\Controllers\ShoppingListController::class, 'markCompleted']);
Route::patch('/shopping-list/items/{item}/incomplete', [App\Http\Controllers\ShoppingListController::class, 'unmarkCompleted']);
