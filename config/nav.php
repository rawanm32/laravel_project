<?php
return [
    [
        'icon' => 'person', 
        'title' => 'profile',
        'route' => 'dashboard.profile.edit',
        'active' => 'dashboard.profile.*',
    ],
    [
        'icon' => 'dashboard', // صححت إلى dashboard بدلاً من home
        'title' => 'dashboard',
        'route' => 'dashboard.index',
        'active' => 'dashboard.*', // صححت النمط
    ],
    [
        'icon' => 'category',
        'title' => 'categories',
        'route' => 'dashboard.categories.index',
        'active' => 'dashboard.categories.*',
        'ability' => 'categories.view'
    ],
    [
        'icon' => 'menu_book',
        'title' => 'Books',
        'route' => 'dashboard.books.index',
        'active' => 'dashboard.books.*',
        'ability' => 'books.view'
    ],
    [
        'icon' => 'person_outline',
        'title' => 'Authors',
        'route' => 'dashboard.authors.index',
        'active' => 'dashboard.authors.*',
        'ability' => 'authors.view'
    ],
    [
        'icon' => 'security', // صححت أيقونة الأدوار
        'title' => 'Roles',
        'route' => 'roles.index',
        'active' => 'roles.*',
        'ability' => 'roles.view'
    ],
    [
        'icon' => 'people',
        'title' => 'Admins',
        'route' => 'admins.index',
        'active' => 'admins.*',
        'ability' => 'admins.view'
    ],
];