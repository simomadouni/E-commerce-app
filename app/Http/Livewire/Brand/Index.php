<?php

namespace App\Http\Livewire\Brand;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$slug,$status,$brand_id,$category_id;

    public function rules()
    {
        return[
            'name'=>'required|string',
            'slug'=>'required|string',
            'category_id'=>'required|integer',
            'status'=>'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
        $this->category_id = NULL;

    }

    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status ==true ? '1':'0',
            'category_id'=>$this->category_id
        ]);
        session()->flash('message','Brand Add Success');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function openModal()
    {
        $this->resetInput();
    }
    public function editBrand(int $brand_id )
    {
        $this->brand_id = $brand_id;
        $brand = Brand::find($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::find($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status ==true ? '1':'0',
            'category_id'=>$this->category_id
        ]);
        session()->flash('message','Brand Edit Success');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::find($this->brand_id)->delete();
        session()->flash('message','Brand Deleted Success');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $categories = Category::Where('status','0')->get();
        $brands = Brand::orderBy('id','DESC')->paginate('10');
        return view('livewire.brand.index', ['brands'=> $brands,'categories'=>$categories ])
                    ->extends('layouts.admin')
                    ->section('content');
    }
}
