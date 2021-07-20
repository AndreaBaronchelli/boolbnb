<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Apartment;
use App\Service;
use App\Sponsor;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all()->where('user_id', Auth::id());

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
            'user_id' => 'exists:users,id|nullable',
            'rooms' => 'required|numeric|min:1',
            'beds' => 'nullable|numeric|min:1',
            'bathrooms' => 'nullable|numeric|min:1',
            'square_meters' => 'required|numeric|min:1',
            'address' => 'required',
            'image'=>'nullable|image|max:2000',
            'visibility'=>'required|boolean',
            'services' => 'nullable|exists:services,id',
            'price' => 'required|numeric|min:1'
        ]);

        $data = $request->all();

        $new_apartment = new Apartment();

        $new_apartment['user_id'] = Auth::id();

        // add cover image
        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('apartments-images', $data['image']);
            $data['image'] = $img_path;
        }

        $new_apartment['slug'] = Str::slug($data['title']);

        // $new_apartment['address'] = "{$data['street_name']}, {$data['house_number']}, {$data['city']}, {$data['country']}";

        $response = Http::get("https://api.tomtom.com/search/2/geocode/{$data['address']}.json?key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML");

        $new_apartment['latitude'] = $response->json()['results'][0]['position']['lat'];
        
        $new_apartment['longitude'] = $response->json()['results'][0]['position']['lon'];

        $new_apartment->fill($data);

        $new_apartment->save();

        if (array_key_exists('services', $data)) {
            $new_apartment->services()->attach($data['services']);
        }

        return redirect()->route('admin.apartments.show', $new_apartment->id);
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
        $apartment = Apartment::find($id);

        $this->authorize('view', $apartment);

        if (!$apartment) {
            abort(404);
        }
        
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $apartment = Apartment::find($id);

        $this->authorize('update', $apartment);

        if (!$apartment) {
            abort(404);
        }

        $services = Service::all();

        return view('admin.apartments.edit', compact('apartment', 'services'));
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
        $request->validate([
            'title' => ['required', Rule::unique('apartments')->ignore($id), 'max:100'],
            'user_id' => 'exists:users,id|nullable',
            'rooms' => 'required|numeric|min:1',
            'beds' => 'nullable|numeric|min:1',
            'bathrooms' => 'nullable|numeric|min:1',
            'square_meters' => 'required|numeric|min:1',
            'address' => 'required',
            'image'=>'nullable|image|max:2000',
            'visibility'=>'required|boolean',
            'services' => 'nullable|exists:services,id',
            'price' => 'required|numeric|min:1'
        ]);

        $data = $request->all();

        $apartment = Apartment::find($id);

        $data['slug'] = Str::slug($data['title'], '-');

        $response = Http::get("https://api.tomtom.com/search/2/geocode/{$data['address']}.json?key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML");

        $apartment['latitude'] = $response->json()['results'][0]['position']['lat'];
        
        $apartment['longitude'] = $response->json()['results'][0]['position']['lon'];

        // add cover image
        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('apartments-images', $data['image']);
            $data['image'] = $img_path;
        }

        $apartment->update($data);

        // pivot table relation update
        if(array_key_exists('services', $data)) {
            $apartment->services()->sync($data['services']);
        } else {
            $apartment->services()->detach();
        }



        return redirect()->route('admin.apartments.show', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->detach();

        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('deleted', $apartment->title);
    }

    
    
}
