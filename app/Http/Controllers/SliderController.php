<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('admin.sliders.index',compact('sliders'));
    }

    public function create(){
        return view('admin.sliders.create');
    }
    public function store(SliderFormRequest $request){
        $validatedData = $request ->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;
            $file->move('uploads/sliders/',$filename);
            $validatedData['image'] = "uploads/sliders/$filename";
        }
        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/sliders')->with('message','slider add success');

        }
        public function edit(Slider $slider){
            return view('admin.sliders.edit',compact('slider'));
        }

        public function update(SliderformRequest $request, Slider $slider){
            $validatedData = $request ->validated();

            if($request->hasFile('image')){

                $destination = $slider->image;
                if(File::exists($destination)){
                    File::delete($destination);
                }


                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename =time().'.'.$ext;
                $file->move('uploads/sliders/',$filename);
                $validatedData['image'] = "uploads/sliders/$filename";
            }
            $validatedData['status'] = $request->status == true ? '1':'0';

            Slider::where('id',$slider->id)->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image' => $validatedData['image'] ?? $slider->image,
                'status' => $validatedData['status'],
            ]);

            return redirect('admin/sliders')->with('message','slider update success');

        }
        public function destroy(Slider $slider){
                if($slider->count() > 0){
                $destination = $slider->image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
             $slider->delete();
            return redirect('admin/sliders')->with('message','slider deleted success');
            }
            return redirect('admin/sliders')->with('message','something is wrong');
        }
    }

