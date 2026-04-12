<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Shopping list item completion routes
Route::patch('/shopping-list/items/{item}/complete', [App\Http\Controllers\ShoppingListController::class, 'markCompleted'])->name('shopping-list.items.complete');
Route::patch('/shopping-list/items/{item}/incomplete', [App\Http\Controllers\ShoppingListController::class, 'unmarkCompleted'])->name('shopping-list.items.incomplete');
