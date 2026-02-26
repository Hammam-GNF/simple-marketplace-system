<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class ShopProductController extends Controller
{
    public function index()
    {
        return view('admin.shop-products.index', [
            'shopProducts' => ShopProduct::with(['shop', 'product'])->paginate(10),
            'shops' => Shop::all(),
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'description' => 'nullable|string',
        ]);

        foreach ($data['product_id'] as $productId) {
            ShopProduct::create([
                'shop_id' => $data['shop_id'],
                'product_id' => $productId,
                'description' => $data['description'] ?? null,
            ]);
        }

        return redirect()->route('admin.shop-products.index')
            ->with('success', 'Product added to shop successfully.');
    }

    public function update(Request $request, ShopProduct $shopProduct)
    {
        $data = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'product_id' => 'required|exists:products,id',
            'description' => 'nullable|string',
        ]);

        $shopProduct->update($data);

        return redirect()->route('admin.shop-products.index')
            ->with('success', 'Shop product updated successfully.');
    }

    public function destroy(ShopProduct $shopProduct)
    {
        $shopProduct->delete();

        return redirect()->route('admin.shop-products.index')
            ->with('success', 'Product removed from shop successfully.');
    }
}
