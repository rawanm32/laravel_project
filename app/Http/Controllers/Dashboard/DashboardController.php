<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
        public function index()
    {
      $stats=[
        'total_user'=>User::count(),
        'total_books'=>Book::count(),
        'total_authors'=>Author::count(),
        'total_categories'=>Category::count(),
        'active_categories'=>Category::where('status','active')->count(),
        'available_books'=>Book::where('status','available')->count()

      ];
      return view('dashboard.pages.home',compact('stats'));
    }
}
