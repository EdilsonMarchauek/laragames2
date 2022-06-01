<?php

namespace App\Repositories\Core\Eloquent;

use Illuminate\Http\Request;
use App\Models\Models\Product;
use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;

class EloquentProductRepository extends BaseEloquentRepository implements ProductRepositoryInterface
{

    public function entity()
    {
        return Product::class;
    }

    public function search(Request $request)
    {
        return $this->entity
                            ->with('category')
                            ->where(function ($query) use($request) {

                                $location1 = Product::where('category_id', $request->category)
                                                        ->get()
                                                        ->first();
                                                                                             
                                $location2 = Product::where('name', 'LIKE', "%{$request->name}%")
                                                        ->get()
                                                        ->first();

                                if(isset($location1) && isset($location2)){
                                    $um = $location1->category_id;                        
                                    $dois = $location2->category_id;

                                    if($um == $dois){   
                                        $query->where( 'name', 'LIKE', "%{$request->name}%");
                                    }  
                                }

                                //verifica se foi preenchido
                                if ($request->name){
                                        $filter = $request->name;
                                        $query->where(function ($querysub) use ($filter) {
                                        $querysub->where( 'name', 'LIKE', "%{$filter}%")
                                                 ->orWhere('description', 'LIKE', "%{$filter}%");
                                     });    
                                } 

                                if ($request->category){
                                        $query->where('category_id', $request->category);
                                }    
                               
                            })
                            //->toSql();
                            //dd($products);
                            ->paginate(30);
    }
}