<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Models\Images;
use App\Models\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $repository;

    //Injeta o model product no construtor
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Pegando todos os produtos - with trás o relacionamento de category
        $products = $this->repository
                            ->orderBy('name')
                            ->relationships('category')
                            ->paginate(50);                     
        //Enviando para View
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Pega categories de AppServiceProvider.php
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductFormRequest $request)
    {

        if ($request->hasFile('photo') && $request->photo->isValid()){
            //Em app/config => 'default' => env('FILESYSTEM_DRIVER', 'public'), excluir do .env FILESYSTEM, Criar o link simbólico   
            $nameFile = $request->name . '.' . $request->photo->extension();    
            $imagePath = $request->photo->storeAs('products', $nameFile);
            $data['photo'] = $imagePath;
        }

         // primeira forma de cadastrar
         $category = Category::find($request->category_id);
         //products() - Models/Category.php
         $product = $category->products()->create(array_merge($request->all(), $data));

         if($request->file('image') && isset($request->image)){
            foreach ($request->file('image') as $imagefile) {
                $image = new Images;
                $path = $imagefile->store("product-images/{$product->id}", ['disk' =>   'public']);
                $image->image = $path;
                $image->product_id = $product->id;
                $image->save();
            }
         }

        //$product = $this->repository->store(array_merge($request->all(), $data));
        
        return redirect()
                ->route('products.index')
                ->withSuccess('Cadastro realizado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //with = pega o relacionamento do model product
        //$product = $this->repository->where('id', $id)->first();
        $product = $this->repository->findWhereFirst('id', $id);

        if(!$product)
        return redirect()->back();

        $images = $product->imageProduct()->get(); 

        return view('admin.products.show', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Pega categories de AppServiceProvider.php

        if(!$product = $this->repository->findById($id))
            return redirect()->back();

        $images = $product->imageProduct()->get(); 
        
        return view('admin.products.edit', compact('product', 'images'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        if ($request->hasFile('photo') && $request->photo->isValid()){
            $nameFile = $request->name . '.' . $request->photo->extension();    
            $imagePath = $request->photo->storeAs('products', $nameFile);
            $data['photo'] = $imagePath;
        }

        if(isset($data)){
            $this->repository->update($id, array_merge($request->all(), $data));
        }else{
            $this->repository->update($id, $request->all());    
        }

        if($request->file('image') && isset($request->image)){
        foreach ($request->file('image') as $imagefile) {
            $image = new Images;
             $path = $imagefile->store("/product-images/{$id}", ['disk' =>   'public']);
             $image->image = $path;
             $image->product_id = $id;
             $image->save();
        }
        }
        //$this->repository->update($id, $request->all()); 

        return back();

        // return redirect()
        //                 ->route('products.index')
        //                 ->withSuccess('Cadastro atualizado com sucesso');
        }  
        
    
    //Apagar todas as fotos do produto
    public function fotodestroyall($id)
    {
        $product = $this->repository->findById($id);
         if(!$product)
           return redirect()->back();
        
        $images = $product->imageProduct()->get();

        foreach ($images as $image){
            $image->delete();
        }

        Storage::disk('public')->deleteDirectory("/product-images/{$id}");

        return redirect()->back();
    }

    //Apagar última foto do produto    
    public function fotodestroylast($id)
    {
        $product = $this->repository->findById($id);
         if(!$product)
           return redirect()->back();
        
        $images = $product->imageProduct()->get()->last();
        $images->delete();

        return redirect()->back();
    }

   
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        $product = $this->repository->findById($id);
         if(!$product)
           return redirect()->back();

         if ($product->photo && Storage::exists($product->photo)) {
             Storage::delete($product->photo);
        }    

        $directory = ("storage/public/product-images/{$id}");
        $this->repository->cleanDirectory($directory);        

        Storage::disk('public')->deleteDirectory("/product-images/{$id}");

        $this->repository->delete($id);

        return redirect()
                 ->route('products.index')
                 ->withSuccess('Cadastro deletado com sucesso');
    }

    public function search(Request $request)
    {
        //Pega todos os campos exceto o token
        $filters = $request->except('_token');

        //form name = "filtro"
        $products = $this->repository->search($request);

        return view('admin.products.index', compact('products', 'filters'));
    }
}
