<?php


namespace App\Repositories;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    public function forUser(User $user)
    {
        if (Auth::check() && Auth::user()->isRole()=='admin'){
            return Product::latest()
                ->get();
        } else {
            return Product::where('user_id', $user->id)
                ->latest()
                ->get();
        }
    }

}