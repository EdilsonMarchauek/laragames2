<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = DB::table('categories')->get();

        $products = $this->repository
        ->orderBy('id')
        ->relationships('category')
        ->paginate(30);

        return view('site.home.index', compact('products', 'categories'));
    }

    public function quemsomos()
    {
        return view('site.home.quemsomos');
    }   
    
    public function faleconosco()
    {
        return view('site.home.faleconosco');
    }   

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request);

        return view('site.home.index', compact('products', 'filters'));
    }

    public function show($id)
    {
        $product = $this->repository->findWhereFirst('id', $id);

        if(!$product)
        return redirect()->back();

        $images = $product->imageProduct()->get(); 

        return view('site.home.show', compact('product', 'images'));
    }

}
