<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Repositories\CartFood\ICartFoodRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartRepo;
    public function __construct(ICartFoodRepository $repo){
      $this->cartRepo=$repo;
    } 
   

    
    public function store(Request $request)
    {
        
    }

  
    public function show(Cart $cart)
    {
        //
    }

    
    public function edit(Cart $cart)
    {
        //
    }

   
    public function update(Request $request, Cart $cart)
    {
        //
    }

   
    public function destroy(Cart $cart)
    {
        //
    }
}
