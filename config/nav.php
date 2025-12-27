<?php
return [
    [
        'icon_name' => 'person', 
            'title' => 'profile',
            'route' => 'dashboard.profile.edit',
            'active' => 'dashboard.profile.*',
          
         

    ],
    [

        'icon_name' => 'dashboard',
        'icon'=>'nav-icon fas fa-th',
        'title'=>'dashboard',
        'route'=>'dashboard.index',
        'active'=>'*dashboard',
         
       
        
        
    ],
    [
        'icon'=>'far fa-circle nav-icon',
        'title'=>'categories',
        'route'=>'dashboard.categories.index',
        'active'=>'*.categories.*',
        'ability'=>'categories.view'
      

 
    ],
    [
        'icon'=>'nav-icon fas fa-book',
        'title'=>'Books',
        'route'=>'dashboard.books.index',
        'active'=>'*.books.*',
        'ability'=>'books.view'       
   
    ],
    [
        'icon'=>'fas fa-store',
        'title'=>'Authors',
        'route'=>'dashboard.authors.index',
        'active'=>'*.authors.*',
        'ability'=>'authors.view'
        
    ],
    [
        'icon'=>'fas fa-store',
        'title'=>'Roles',
        'route'=>'roles.index',
        'active'=>'*.roles.*',
        'ability'=>'roles.view',
       
    ],
    [
     'icon' =>'far fa-shield nav-icon',
        'title' => 'Admins',
        'route' => 'admins.index',
        'active' => '*.admins.*', 
        'ability'=>'admins.view'
        
       
    ],
];