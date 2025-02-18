<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

// ROUTE PAR DéFAUT
// PATTERN: /
// CTRL: PostsController
// ACTION: Index
Route::get('/', [PostsController::class, 'index'])->name('posts.index');

// ROUTE D AFFICHAGE DES MONSTRES
// PATTERN: /posts/monsters.html
// CTRL: PostsController
// ACTION: ShowMonsters
Route::get('/monsters', [PostsController::class, 'showMonsters'])->name('posts.monsters');

// AJOUT D'UN MONSTRE
// PATTERN: /posts/add-monster
// CTRL: PostsController
// ACTION: AddMonster
Route::get('/new-monster', [PostsController::class, 'addMonster'])->name('posts.addMonster');

// MODIFICATION D'UN MONSTRE
// PATTERN: /posts/modify-monster
// CTRL: PostsController
// ACTION: Modify
Route::get('/edit/{id}', [PostsController::class, 'edit'])
    ->where(['id' => '[0-9]+'])
    ->name('posts.edit');

// DETAIL D'UN POST
// PATTERN: /posts/id/nom
// CTRL: PostsController
// ACTION: Show
Route::get('/posts/{id}/{slug}', [PostsController::class, 'show'])
    ->where(['id' =>  '[0-9]+', 'slug' => '[a-z0-9][a-z0-9\-]*'])
    ->name('posts.show');

// RECHERCHE DE NOM
// PATTERN: /posts/monsters/search
// CTRL: PostsController
// ACTION: showSearch
Route::get('/posts/monsters/search', [PostsController::class, 'showSearch'])->name('posts.search');

// RECHERCHE DE CRITERES
// PATTERN: /posts/monsters/search/crit
// CTRL: PostsController
// ACTION: showSearch
Route::get('/posts/monsters/search/crit', [PostsController::class, 'showSearchCrit'])->name('posts.crit');

// Route pour ajouter un monstre via un formulaireavec la méthode POST
Route::post('/monster/store', [PostsController::class, 'store'])->name('monsters.store');

// Route pour supprimer un monstre avec la méthode DELETE
Route::delete('/monster/delete/{id}', [PostsController::class, 'destroy'])->name('monster.destroy');

// Route pour mettre à jour un monstre
Route::put('/monster/update/{id}', [PostsController::class, 'update'])
    ->where(['id' => '[0-9]+'])
    ->name('monster.update');

// Route d'urgence
Route::get('/monster/destroy-latest', [PostsController::class, 'destroyLatestMonster'])->name('monster.destroyLatest');
