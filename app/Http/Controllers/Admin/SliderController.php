<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{

    use APITrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        Slider::create($request->all());
        return $this->returnSuccess('S000', 'Slider Create Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            return view('admin.slider.edit', compact('slider'));
        }
        return redirect()->route('admin.slider.index')->with('error', 'Error get slider.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slider = Slider::find($request->id);
        $status = 1;
        if ($slider) {
            $updated_slider_data = $request->except('status');
            $path = 'images/sliders/' . $slider->image;
            // delete old photo if updated
            if ($request->has('image') && File::exists($path))
                File::delete($path);
            // check if status is disabled 
            if ($request->status == null)
                $status = 0;
            $updated_slider_data['status'] = $status;
            $slider->update($updated_slider_data);
            return $this->returnSuccess('S000', 'Slider updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slider = Slider::find($request->id);
        if ($slider) {
            $slider->delete();
            return $this->returnSuccess('S001', 'Delete slider successfully.');
        }
        return $this->returnError('S000', 'Slider not delete');
    }
}
