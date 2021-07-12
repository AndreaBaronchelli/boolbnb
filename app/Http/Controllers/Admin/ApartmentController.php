<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Service;
use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $sponsors = Sponsor::all();

        return view('admin.apartments.create', compact('services', 'sponsors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:apartments|max:100',
            'rooms' => 'required|numeric|min:1',
            'beds' => 'nullable|numeric|min:1',
            'bathrooms' => 'nullable|numeric|min:1',
            'square_meters' => 'required|numeric|min:1',
            'city' => 'required',
            'country' => 'required',
            'image'=>'nullable|image'
        ]);

        $data = $request->all();

        $new_apartment = new Apartment();

        // add cover image
        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('apartments-images', $data['image']);
            //overwrite cover file with path
            $data['image'] = $img_path;
        }

        $new_apartment['slug'] = Str::slug($data['title']);

        $new_apartment['address'] = "{$data['street_name']} {$data['house_number']} {$data['city']} {$data['country']}";

        $new_apartment->fill($data);

        $new_apartment->save();

        if (array_key_exists('types', $data)) {
            $new_apartment->types()->attach($data['types']);
        }

        return redirect()->route('admin.posts.show', $new_apartment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
