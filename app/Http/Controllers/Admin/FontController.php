<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\Font;
use App\Http\Requests\Admin\FontRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FontController extends Controller
{

    public function index(Request $request)
    {
        $re=$request->input('font_family');
        $font=Font::orderBy('font_family','asc')->where('font_family','like','%'.$re.'%')->paginate(15);
        return view('admin.font.index',compact('font','re'));
    }

    public function create()
    {
        return view('admin.font.create');
    }
    public function store(FontRequest $request)
    {
        $input=$request->except('_token');
        $create=Font::create(['font'=>$input['font'],'font_family'=>$input['font_family']]);
        if($create)
        {
            return redirect('admin/font');
        }else{
        return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    public function edit($id)
    {
        $show=Font::find($id);
        return view('admin.font.edit',compact('show'));
    }
    public function update(FontRequest $request,$id)
    {

        $input=$request->except('_token','_method');
        $re=Font::where('id',$id)->update($input);
        if($re)
        {
            return redirect('admin/font');
        }else{
            return back()->with('errors','填充失败，请稍后重试');
        }
    }
    public function destroy(Request $request)
    {
      $input=$request->except('_method','_token');
      $re=Font::where('id',$input)->delete();
       if($re){
           $status = '0';
           $msg = "删除成功！";
       }else{
           $status='1';
           $msg="删除失败，请稍后再试";
       }
       return response()->json(['status'=>$status,'msg'=>$msg]);
    }
}
