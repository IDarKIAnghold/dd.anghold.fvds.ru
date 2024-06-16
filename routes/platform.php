<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

use App\Orchid\Screens\PlatformScreen;

use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;

use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;

use App\Orchid\Screens\Manufacturer\ManufacturersScreen;
use App\Orchid\Screens\Manufacturer\ManufacturersEditScreen;

use App\Orchid\Screens\Product\ProductsScreen;
use App\Orchid\Screens\Product\ProductsAddScreen;
use App\Orchid\Screens\Product\ProductsEditScreen;
use App\Orchid\Screens\Product\AttributesEditScreen;

use App\Orchid\Screens\Category\CategoryScreen;
use App\Orchid\Screens\Category\CategroyEditScreen;

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

//USERS

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn(Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->id, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// ROLES

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn(Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

//MANUFACTURES

// Platform > System > Manufacturers >Manufacturer
Route::screen('manufacturers/{manufacturer}/edit', ManufacturersEditScreen::class)
    ->name('platform.systems.manufacturers.edit')
    ->breadcrumbs(fn(Trail $trail, $manufacturer) => $trail
        ->parent('platform.systems.manufacturers')
        ->push($manufacturer->name, route('platform.systems.manufacturers.edit', $manufacturer)));

// Platform > System > Manufacturers > Create
Route::screen('manufacturers/create', ManufacturersEditScreen::class)
    ->name('platform.systems.manufacturers.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.manufacturers')
        ->push(__('Create'), route('platform.systems.manufacturers.create')));

// Platform > System > Manufacturers
Route::screen('manufacturers', ManufacturersScreen::class)
    ->name('platform.systems.manufacturers')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Manufacturers'), route('platform.systems.manufacturers')));

// PRODUCTS

// Platform > System > Products > Product
Route::screen('products/{products}/edit', ProductsEditScreen::class)
    ->name('platform.systems.products.edit')
    ->breadcrumbs(fn(Trail $trail, $products) => $trail
        ->parent('platform.systems.products')
        ->push($products->name, route('platform.systems.products.edit', $products)));

// Platform > System > Products > Create
Route::screen('products/create', ProductsAddScreen::class)
    ->name('platform.systems.products.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.products')
        ->push(__('Create'), route('platform.systems.products.create')));

Route::screen('products/{products}/attributes', AttributesEditScreen::class)
    ->name('platform.systems.products.attributes')
    ->breadcrumbs(fn(Trail $trail, $products) => $trail
        ->parent('platform.systems.products')
        ->push($products->name, route('platform.systems.products.attributes', $products)));


// Platform > System > Products
Route::screen('products', ProductsScreen::class)
    ->name('platform.systems.products')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Products'), route('platform.systems.products')));

Route::screen('catetory/{productTypes}/edit', CategroyEditScreen::class)
    ->name('platform.systems.category.edit')
    ->breadcrumbs(fn(Trail $trail, $productTypes) => $trail
        ->parent('platform.systems.category')
        ->push($productTypes->name, route('platform.systems.category.edit', $productTypes)));

// Platform > System > Category > Create
Route::screen('catetory/create', CategroyEditScreen::class)
    ->name('platform.systems.category.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.category')
        ->push(__('Create'), route('platform.systems.category.create')));

// Platform > System > Category
Route::screen('category', CategoryScreen::class)
    ->name('platform.systems.category')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Category'), route('platform.systems.category')));


// Examples
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');
