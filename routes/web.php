<?php

use Illuminate\Support\Facades\Route;

Route::prefix(config('oanna.route_prefix', 'oanna'))->group(function () {
    // GET /monpackage/config → renvoie un sous-ensemble de la config
    Route::get('/config', function () {
        $all = config('oanna', []);
        $expose = $all['expose_keys'] ?? [];

        if (is_array($expose) && $expose) {
            $allowed = array_intersect_key($all, array_flip($expose));
        } else {
            $allowed = $all; // fallback si tu veux tout exposer (déconseillé si sensible)
        }

        return response()->json($allowed);
    });

    Route::get('oanna.min.js', [static::class, 'oannaMinJs']);
});
