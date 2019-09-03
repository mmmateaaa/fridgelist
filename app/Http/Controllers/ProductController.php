<?php

namespace App\Http\Controllers;

use App\Product;
use App\Type;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Repositories\ProductRepository;
use App\Http\Middleware\Admin;

class ProductController extends Controller
{
    protected $products;

    public function __construct(ProductRepository $products)
    {
        $this->middleware('auth');
        $this->products = $products;
    }

    public function index(Request $request)
    {
        $products = $this->products->forUser($request->user());

        foreach ($products as $product) {
            $expires = new Carbon($product->expires); //product expiry date
            $product->todayexpires = $expires->isCurrentDay(); //product expires today
            $product->isexpired = $expires->isPast(); //product date is expired
            $now = Carbon::now();
            $fivedaysfromnow = Carbon::now()->addDays(4);
            $product->diff = $expires->isBetween($now, $fivedaysfromnow);
        }

        $types = Type::all();
        return view('index', ['products' => $products, 'types' => $types]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'type_id' => 'required',
            'expires' => 'required'
        ]);

        $product = new Product($request->input());
        $user = User::find(Auth::user()->id);
        $product->user()->associate($user)->save();

        Session::flash('message', 'Product is added to your list.');

        return redirect('index');
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update($request->all());

        Session::flash('message', 'Changes are saved.');

        return back();
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->delete();

        Session::flash('message', 'Product is deleted from your list.');

        return back();
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if (isset($search))
        {
            $validator = Validator::make($request->all(), [
                'search' => 'required'
            ]);

            if ($validator->passes())
            {
                if (Auth::check() && Auth::user()->isRole()=='admin')
                {
                    $products = DB::table('products')
                        ->join('types', 'products.type_id', '=', 'types.id')
                        ->select('products.name','products.id', 'products.type_id', 'products.expires', 'products.quantity')
                        ->where('products.name', 'like', '%' . $search . '%')
                        ->orWhere('types.name', 'like', '%' . $search . '%')
                        ->get();
                }
                else
                {
                    $products = DB::table('products')
                        ->join('types', 'products.type_id', '=', 'types.id')
                        ->select('products.name','products.id', 'products.type_id', 'products.expires', 'products.quantity')
                        ->where('products.user_id', '=', Auth::user()->id)
                        ->where('products.name', 'like', '%' . $search . '%')
                        ->orWhere('types.name', 'like', '%' . $search . '%')
                        ->get();
                }

                if (count($products))
                {
                    $types = Type::all();
                    return view('index', ['products' => $products, 'types' => $types]);
                }
                else
                {
                    return redirect('noresult');
                }
            }
            else
            {
                return redirect('index');
            }
        }
        else
        {
            return redirect('index');
        }
    }

    public function noresult()
    {
        return view('noresult');
    }
}
