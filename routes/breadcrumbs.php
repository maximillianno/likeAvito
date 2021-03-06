<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});
Breadcrumbs::for('cabinet', function ($trail) {
    $trail->parent('home');
    $trail->push('Cabinet', route('cabinet'));
});


Breadcrumbs::for('admin.home', function ($trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.home'));
});

//for admin.users
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});
//Breadcrumbs::for('admin.users.show', function ($trail, \App\User $user) {
Breadcrumbs::for('admin.users.show', function ($trail, $id) {
    $user = \App\User::findOrFail($id);
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});
Breadcrumbs::for('admin.users.edit', function ($trail, $id) {
    $user = \App\User::findOrFail($id);
    $trail->parent('admin.users.show', $id);
    $trail->push('Edit', route('admin.users.edit', $user));
});


//for admin.regions
Breadcrumbs::for('admin.regions.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Regions', route('admin.regions.index'));
});
Breadcrumbs::for('admin.regions.create', function ($trail) {
    $trail->parent('admin.regions.index');
    $trail->push('Create', route('admin.regions.create'));
});
//Breadcrumbs::for('admin.regions.show', function ($trail, \App\User $user) {
Breadcrumbs::for('admin.regions.show', function ($trail, $id) {
    $region = \App\Region::findOrFail($id);
    if ($parent = $region->parent){
        $trail->parent('admin.regions.show', $parent->id);
    } else {
        $trail->parent('admin.regions.index');
    }
    $trail->push($region->name, route('admin.regions.show', $region));
});
Breadcrumbs::for('admin.regions.edit', function ($trail, $id) {
    $region = \App\Region::findOrFail($id);
    $trail->parent('admin.regions.show', $id);
    $trail->push('Edit', route('admin.regions.edit', $region));
});


// Home > Login
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('login'));
});




// Home > About
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('about'));
});

// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});