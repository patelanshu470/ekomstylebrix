<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCatController extends Controller
{

    public function subCatIndex()
    {
        $datas = SubCategory::orderBy('id', 'DESC')->get();
        return view('backend.subCategory.sub_cat_index', compact('datas'));
    }
    public function subCatAdd()
    {
        $category = Category::where('status','=',1)->get();
        return view('backend.subCategory.sub_cat_add',compact('category'));
    }
    public function subCatStore(Request $request)
    {

        $dublicate_check = SubCategory::where([['name', 'like', $request->name],['cat_id','=',$request->cat_id]])->get()->first();
        if ($dublicate_check) {
            return back()->with('error', "Dublicate entry is not allowed.");
        }
        $data = new SubCategory();
        $data->name = $request->name;
        $data->cat_id = $request->cat_id;
        $data->status = $request->status;
        $data->save();
        return back()->with('success', "Sub-Category created successfully");
    }
    public function subCatEdit($id)
    {
        $data = SubCategory::find($id);
        $category = Category::where('status','=',1)->get();
        return view('backend.subCategory.sub_cat_edit', compact('data','category'));
    }

    public function subCatUpdate(Request $request, $id)
    {
        $dublicate_check = SubCategory::where([['name', 'like', $request->name],['cat_id','=',$request->cat_id],['id', '<>', $id]])->get()->first();
        if ($dublicate_check) {
            return back()->with('error', "Dublicate entry is not allowed.");
        }
        $data = SubCategory::find($id);
        $data->name = $request->name;
        $data->cat_id = $request->cat_id;
        $data->status = $request->status;
        $data->save();
        return redirect()->route('subCategory')->with('success', "Sub-Category updated successfully");
    }

    public function subCatDelete($id)
    {
        $category = SubCategory::findOrFail($id);
        $category->delete();
        return back()->with('success', "Sub-Category is delete successfully.");
    }
    public function subCatStatus(Request $request)
    {
        $data = SubCategory::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 'Sub-Category status has been updated successfully!'
        ]);
    }
}
