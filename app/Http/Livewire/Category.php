<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;
use Livewire\Component;

class Category extends Component
{
    public $categories;

    public function mount()
    {
        $categories = ModelsCategory::get();
        $this->categories = $categories;
    }

    public function update(Request $request, $id)
    {
        $category = ModelsCategory::find($id)->first();
        if ($category) {
            $category->update($request->all());
            return 'success';
        }
        // dd($id);
    }

    // public $recipes = '0';

    // public $hmm = false;

    // public function render()
    // {
    //     $category = ModelsCategory::where('name', $this->name)->first();
    //     if ($category) {
    //         $this->recipes = $category->recipes->count();
    //         return view('livewire.category');
    //     } else {
    //         $this->recipes = 0;
    //         return view('livewire.category');
    //     }
    // }
}
