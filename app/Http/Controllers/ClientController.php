<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function CategoryPage($id)
    {   
        $category= Category::findOrFail($id);
        $products = Product::where('product_category_id' , $id)->latest()->get();
        return view('user_template.category', compact('category','products'));
    }
    public function SingleProduct($id)
    {   $product = Product::findOrFail($id);
        $subcategory_id= Product::where('id', $id)->value('product_subcategory_id');
        $relatedproducts= Product::where('product_subcategory_id', $subcategory_id)->latest()->get();
        return view('user_template.product', compact('product', 'relatedproducts'));
    }
    public function AddToCart()
    {
        return view('user_template.addtocart');
    }
    public function Checkout()
    {
        return view('user_template.checkout');
    }
    public function UserProfile()
    {
        return view('user_template.userprofile');
    }
    public function Pendingorder()
    {
        return view('user_template.pendingorder');
    }
    public function History()
    {
        return view('user_template.history');
    }
    
    public function NewRelease()
    {
        return view('user_template.newrelease');
    } 
    public function TodaysDeal()
    {
        return view('user_template.todaysdeal');
    }
     public function CustomerService()
    {
        return view('user_template.customerservice');
    }
 
}
