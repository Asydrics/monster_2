<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

// ROUTE PAR DÉFAUT
Route::get('/', [PostsController::class, 'index'])->name('posts.index');

// ROUTE D'AFFICHAGE DES MONSTRES
Route::get('/monsters', [PostsController::class, 'showMonsters'])->name('posts.monsters');

// RECHERCHE DE NOM
Route::get('/posts/monsters/search', [PostsController::class, 'showSearch'])->name('posts.search');

// RECHERCHE DE CRITÈRES
Route::get('/posts/monsters/search/crit', [PostsController::class, 'showSearchCrit'])->name('posts.crit');

// DÉTAIL D'UN POST
Route::get('/posts/{id}', [PostsController::class, 'show'])
->where(['id' =>  '[0-9]+'])
    ->name('posts.show');

// AJOUT D'UN MONSTRE (Formulaire d'ajout)
Route::get('/new-monster', [PostsController::class, 'addMonster'])->name('posts.addMonster');

// ENREGISTREMENT D'UN MONSTRE (Méthode POST)
Route::post('/monster/store', [PostsController::class, 'store'])->name('monsters.store');

// MODIFICATION D'UN MONSTRE (Formulaire d'édition)
Route::get('/edit/{id}', [PostsController::class, 'edit'])
    ->where(['id' => '[0-9]+'])
    ->name('posts.edit');

// MISE À JOUR D'UN MONSTRE (Méthode PUT)
Route::put('/monster/update/{id}', [PostsController::class, 'update'])
    ->where(['id' => '[0-9]+'])
    ->name('monster.update');

// SUPPRESSION D'UN MONSTRE (Méthode DELETE)
Route::delete('/monster/delete/{id}', [PostsController::class, 'destroy'])->name('monster.destroy');

// ROUTE D'URGENCE POUR SUPPRIMER LE DERNIER MONSTRE
Route::get('/monster/destroy-latest', [PostsController::class, 'destroyLatestMonster'])->name('monster.destroyLatest');
