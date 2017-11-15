<?php

return [
    /**
     * User Model
     *
     * This is the user model that will be used for your restaurants
     */
    'user_model' => config('auth.providers.users.model', App\User::class),

    /**
     * Users Table
     *
     * This is the users table that will be used for your restaurants
     */
    'users_table' => 'users',
];
