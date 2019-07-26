<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;
use DB;

class ProductsController extends Controller
{
   public function products(){
       $categories = DB::table('categories')->get();
       $products = DB::table('products')->get();
       $data['products'] = $products;
       $data['categories'] = $categories;
dd($data);
    return view('products.products',$data);
   }

   public function addProduct($id=null){
       $product = null;
       $images = null;
       if($id!=null){
           $product = DB::table('products')->where('id',$id)->first();
           $images = DB::table('images')->where('product_id',$id)->get();
       }
       $categories = DB::table('categories')->get();
       $subCategories = DB::table('sub_categories')->get();
       $subSubCategories = DB::table('sub_sub_categories')->get();
       $sizes = DB::table('sizes')->get();
       $colors = DB::table('colors')->get();
       $data = array(
         'product' => $product,
         'sizes' => $sizes,
         'colors' => $colors,
         'categories' => $categories,
         'sub_categories' => $subCategories,
         'sub_sub_categories' => $subSubCategories,
         'images' => $images,
       );
    return view('products.add',$data);
   }
    public function add(Request $request){
        $data = $request->except('_token');

        $rules = [
            'name' => 'required|string|max:100',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }
        $input = array(
            'name' => $data['name'],
            'description' => strip_tags($data['description']),
            'color' => json_encode($data['color']),
            'size' => json_encode($data['size']),
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'sub_sub_category_id' => $data['sub_sub_category_id'],
        );
        if($data['id']!=null){
            DB::table('products')->where('id',$data['id'])->update($input);
        }
        else{
            DB::table('products')->insert($input);
        }

        return redirect()->route('products');
    }
    public function delete($id){
        DB::table('products')->where('id',$id)->delete();
        return redirect('products')->with('status', 'Successfully Deleted.');
    }

}
