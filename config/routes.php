<?php

declare(strict_types=1);

use Yiisoft\Http\Method;
use Yiisoft\Router\Route;
use App\Library\Controller\BookController;
use App\Library\Controller\GenreController;
use App\Library\Controller\AuthorController;

return [
    Route::get('/', [BookController::class, 'index'])->name('book/index'),
    Route::methods([Method::GET, Method::POST], '/book/create', [BookController::class, 'create'])->name('book/create'),
    Route::methods([Method::GET, Method::POST], '/book/update/{id:\w+}', [BookController::class, 'update'])->name('book/update'),
    Route::methods([Method::GET, Method::POST], '/book/delete/{id:\w+}', [BookController::class, 'delete'])->name('book/delete'),

    Route::get('/author', [AuthorController::class, 'index'])->name('author/index'),
    Route::methods([Method::GET, Method::POST], '/author/create', [AuthorController::class, 'create'])->name('author/create'),
    Route::methods([Method::GET, Method::POST], '/author/update/{id:\w+}', [AuthorController::class, 'update'])->name('author/update'),
    Route::methods([Method::GET, Method::POST], '/author/delete/{id:\w+}', [AuthorController::class, 'delete'])->name('author/delete'),

    Route::get('/genre', [GenreController::class, 'index'])->name('genre/index'),
    Route::methods([Method::GET, Method::POST], '/genre/create', [GenreController::class, 'create'])->name('genre/create'),
    Route::methods([Method::GET, Method::POST], '/genre/update/{id:\w+}', [GenreController::class, 'update'])->name('genre/update'),
    Route::methods([Method::GET, Method::POST], '/genre/delete/{id:\w+}', [GenreController::class, 'delete'])->name('genre/delete'),
];
