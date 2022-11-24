<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\ProductsExport;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = Product::all();
        return view('supervisor.products.index', compact('data'));
    }

    public function create()
    {
        return view('supervisor.products.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required'
        ]);
        $input = $request->all();
        $product = Product::create($input);
        return redirect()->route('supervisor.products.index')
            ->with('success', 'تم اضافة صنف بنجاح');
    }

    public function show($id)
    {
        $product = Product::findorfail($id);
        return view('supervisor.products.show', compact('product'));
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('supervisor.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required'
        ]);
        $input = $request->all();
        $product = Product::findOrFail($id);
        $product->update($input);
        return redirect()->route('supervisor.products.index')
            ->with('success', 'تم تعديل بيانات الصنف بنجاح');
    }

    public function destroy(Request $request)
    {
        Product::findOrFail($request->product_id)->delete();
        return redirect()->route('supervisor.products.index')
            ->with('success', 'تم حذف الصنف بنجاح');
    }

    public function remove_selected(Request $request)
    {
        $products_id = $request->products;
        foreach ($products_id as $product_id) {
            $product = Product::FindOrFail($product_id);
            $product->delete();
        }
        return redirect()->route('supervisor.products.index')
            ->with('success', 'تم الحذف بنجاح');
    }

    public function print_selected()
    {
        $products = Product::all();
        return view('supervisor.products.print', compact('products'));
    }

    public function export_products_excel()
    {
        return Excel::download(new ProductsExport(), 'كل الأصناف.xlsx');
    }
}
