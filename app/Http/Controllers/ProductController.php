<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public $paginate = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate($this->paginate);

        return view('back.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title', 'id')->all();

        return view('back.product.create', ['categories' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'price' => 'required|numeric|between:0,99.99',
            'reference' => 'required|alpha_num',
            'size' => 'required',
            'status_publish' => 'boolean',
            'status_product' => 'in:sold,standard',
            'picture' => 'required|image|max:3600',
        ]);

        $category_id = $request->category_id;
        $category_name = Category::find($category_id)->title;

        if ($request->status_product == 'sold') {

            $salePrice = $request->price - ($request->price * (20 / 100));
            $request->request->add(['salePrice' => $salePrice]);
        }
        $image = $request->file('picture');

        if (!empty($image)) {

            $link = $image->store(Str::plural($category_name));

            $request->request->add(['image_url' => $link]);
        }

        $requestData = $request->all();

        $requestData['size'] = serialize($request->size);

        Product::create($requestData);

        return redirect()->route('product.index')->with('message', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::pluck('title', 'id')->all();

        return view('back.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'price' => 'required|numeric|between:0,99.99',
            'reference' => 'required|alpha_num',
            'size' => 'required',
            'status_publish' => 'boolean',
            'status_product' => 'in:sold,standard',
            'picture' => 'image|max:3600',
        ]);

        $product = Product::find($id);

        $category_id = $request->category_id;
        $category_name = Category::find($category_id)->title;


        if ($product->status_product !== 'sold' || $request->price !== $product->salePrice) {
            if ($request->status_product == 'sold') {
                $salePrice = $request->price - ($request->price * (20 / 100));
                $request->request->add(['salePrice' => $salePrice]);
            }
        } else if ($request->status_product == 'standard') {
            $save_price = $request->price;
        } else {
            $save_price = $product->price;
        }

        $image = $request->file('picture');

        if (!empty($img)) {
            $link = $image->store('images/' . $category_name);
            $link = explode('images/', $link)[1];

            if (!is_null($product->image_url)) {
                Storage::disk('local')->delete($product->image_url);
            }
            $request->request->add(['image_url' => $link]);
        }

        $requestData = $request->all();

        $requestData['size'] = serialize($request->size);

        if (!empty($save_price))
            $requestData['price'] = $save_price;

        $product->update($requestData);


        return redirect()->route('product.index')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('product.index')->with('message', 'success');
    }
}
