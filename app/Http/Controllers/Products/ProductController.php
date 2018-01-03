<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Model\Products\ProductModel as Products;
use Illuminate\Http\Request;
use Session;
use Validator;

class ProductController extends Controller
{

    public function listproducts()
    {
        $products = Products::where('id_user', Session::get('id_user'))->get();
        return response()->json($products);
    }

    public function newproduct(Request $req)
    {
        $rules = [
            'title' => 'required',
        ];
        $mesages = [
            'title.required' => 'Title is required',
        ];
        $validator = Validator::make($req->all(), $rules, $mesages);
        if ($validator->fails()) {
            return response()->json(['errors', $this->GetMessageBag($validator)]);
        }
        $newProduct = new Products;
        $newProduct->id_user = Session::get('id_user');
        $newProduct->title = $req->title;
        $newProduct->description = $req->description;
        if ($newProduct->save()) {
            return response()->json(['success', 'The product has been created successfully']);
        } else {
            return response()->json(['errors', 'An error occurred when creating a new product']);
        }
    }

    public function updateproduct(Request $req)
    {
        $rules = [
            'title' => 'required',
        ];
        $mesages = [
            'title.required' => 'Title is required',
        ];
        $validator = Validator::make($req->all(), $rules, $mesages);
        if ($validator->fails()) {
            return response()->json(['errors', $this->GetMessageBag($validator)]);
        }
        $updateProducts = Products::where('id', $req->id)->update(
            ['title' => $req->title,
             'description' => $req->description,
            ]);
        if ($updateProducts > 0) {
            return response()->json(['success', 'The product has been successfully update']);
        } else {
            return response()->json(['errors', 'An error occurred while updating the product']);
        }
    }

    public function deleteproduct(Request $req)
    {
        $updateProducts = Products::where('id', $req->id)->delete();
        if ($updateProducts > 0) {
            return response()->json(['success', 'The product has been successfully delete']);
        } else {
            return response()->json(['errors', 'An error occurred while delete the product']);
        }
    }

    //function return errors messages validator-ajax
    public function GetMessageBag($validator)
    {
        $data = "";
        foreach ($validator->getMessageBag()->toArray() as $errors) {
            $data .= "<br>" . $errors[0] . "<br>";
        }
        $data .= "";
        return $data;
    }

    //Destroy Sessions
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
