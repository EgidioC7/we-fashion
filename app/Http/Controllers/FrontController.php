<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public $paginate = 6;

    public function __construct()
    {
        // méthode pour injecter des données à une vue partielle
        view()->composer('partials.menu', function ($view) {
            $categories = Category::all(); // on récupère un tableau associatif
            $view->with('categories', $categories); // on passe la données à la vue
        });
    }

    public function index()
    {
        $products = Product::published()->paginate($this->paginate);

        return view('front.index', ['products' => $products, 'selectCount' => '']);
    }

    public function show(int $id)
    {
        $product = Product::find($id);

        return view('front.show', ['product' => $product]);
    }

    // Return Number of product

    public static function getNbProducts($selectCount = '')
    {
        // Check if custom variable isn't empty or integer
        if (!empty($selectCount) && is_int($selectCount)) {
            return Product::published()->where('category_id', $selectCount)->count();
        } else if (!empty($selectCount) && $selectCount === 'sold') {
            return Product::sold()->where('status_publish', 1)->count();
        } else {
            return Product::published()->count();
        }
    }

    public function sold()
    {

        $products = Product::sold()->where('status_publish', 1)->paginate($this->paginate);

        return view('front.index', ['products' => $products, 'selectCount' => 'sold']);
    }

    public function showByCategory(string $categoryName)
    {
        $category = Category::where('title', $categoryName)->first();

        $products = Product::published()->where('category_id', $category->id)->paginate($this->paginate);

        return view('front.index', ['products' => $products, 'selectCount' => $category->id]);
    }

}
