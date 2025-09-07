<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ForLease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Admin\Amentities;

class ForLeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forleases = ForLease::all();
        return view('admin.forlease.index', compact('forleases'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $amentity_for_sale = Amentities::all();
        return view('admin.forlease.create', compact('amentity_for_sale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required',
            'property_desc' => 'required',
            'thumbnail_image' => 'required',
            'thumbnail_image.*' => 'image|mimes:jpeg,jpg,png|max:2048', // Validate the thumbnail image format and size
            'image' => 'required|array|min:5', // Require the image input to be an array with a minimum of 5 elements
            'image.*' => 'image|mimes:jpeg,jpg,png|max:2048', // Validate each image format and size
            'rent' => 'required',
            // Add validation rules for other fields
        ]);


        $thumbnailImage = $request->file('thumbnail_image');


        $forlease = new ForLease();
        $forlease->title = $request->input('title');
        $forlease->secondary_type = $request->input('secondary_type');
        $forlease->property_type = 'Forlease';
        $forlease->floor_suit = $request->input('floor_suit');
        $forlease->space_available = $request->input('space_available');
        $forlease->rent = $request->input('rent');
        // $forsale->thumbnail_image = $thumbnailImage->input('thumbnail_image');
        // $forsale->image = $request->input('image');
        $forlease->lease_type = $request->input('lease_type');
        $forlease->address = $request->input('address');
        $forlease->latitude = $request->input('latitude');
        $forlease->longitude = $request->input('longitude');
        $forlease->building_status = $request->input('building_status');
        $forlease->gla = $request->input('gla');
        $forlease->floors = $request->input('floors');
        $forlease->year_build = $request->input('year_build');
        $forlease->tenancy = $request->input('tenancy');
        $forlease->building_height = $request->input('building_height');
        $forlease->sprindles = $request->input('sprindles');
        $forlease->parking = $request->input('parking');
        $forlease->land_area = $request->input('land_area');
        $forlease->zoaning = $request->input('zoaning');
        $forlease->zoaning_desc = $request->input('zoaning_desc');
        $forlease->property_desc = $request->input('property_desc');
        $forlease->year = $request->input('year');
        $forlease->texes = $request->input('texes');
        $forlease->other_exp = $request->input('other_exp');
        $forlease->total = $request->input('total');

        if($request->amentities!=null){
        $amentities = $request->input('amentities');
        $implodedAmentities = implode(',', $amentities);
        $forlease->amentities = $implodedAmentities;
        }
            // thumbnail
        if($request->image != null){

            // $image = $request->image;
            $thumbnailImage = $request->file('thumbnail_image');
            $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();

            //Store
            $thumbnailImage->storeAs('forlease/thumbnail', $imageName, 'public');
         }else {
             $imageName = $forlease->image;
         }

         $forlease->thumbnail_image = $imageName;

        //  multi Image

         if ($request->hasFile('image')) {
            $multiImages = $request->file('image');
            $imageNames = [];
        
            foreach ($multiImages as $multiImage) {
                $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $multiImage->getClientOriginalExtension();
                $multiImage->storeAs('forlease/multiimage', $imageName, 'public');
                $imageNames[] = $imageName;
            }
        
            $multiImageName = implode(',', $imageNames);
        } else {
            $multiImageName = $forlease->image;
        }

        $forlease->image = $multiImageName;
    
        $forlease->save();

        if ($forlease->save()) {
            return response()->json(['message' => 'Data saved successfully'], 200);
        } else {
            return response()->json(['message' => 'Error saving data'], 500);
        }

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
        $forleases = ForLease::where('id', $id)->get();
        $index = 'index';
        // dd($forsales->all());
        return view('admin.forlease.edit', compact('forleases', 'index'));
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
        //  return response()->json($request->all());

        $forlease = ForLease::findOrFail($id);
        $forlease->title = $request->input('title');
        $forlease->secondary_type = $request->input('secondary_type');
        $forlease->floor_suit = $request->input('floor_suit');
        $forlease->space_available = $request->input('space_available');
        $forlease->rent = $request->input('rent');
        // $forsale->thumbnail_image = $thumbnailImage->input('thumbnail_image');
        // $forsale->image = $request->input('image');
        $forlease->lease_type = $request->input('lease_type');
        $forlease->address = $request->input('address');
        $forlease->latitude = $request->input('latitude');
        $forlease->longitude = $request->input('longitude');
        $forlease->building_status = $request->input('building_status');
        $forlease->gla = $request->input('gla');
        $forlease->floors = $request->input('floors');
        $forlease->year_build = $request->input('year_build');
        $forlease->tenancy = $request->input('tenancy');
        $forlease->building_height = $request->input('building_height');
        $forlease->sprindles = $request->input('sprindles');
        $forlease->parking = $request->input('parking');
        $forlease->land_area = $request->input('land_area');
        $forlease->zoaning = $request->input('zoaning');
        $forlease->zoaning_desc = $request->input('zoaning_desc');
        $forlease->property_desc = $request->input('property_desc');
        $forlease->year = $request->input('year');
        $forlease->texes = $request->input('texes');
        $forlease->other_exp = $request->input('other_exp');
        $forlease->total = $request->input('total');

        $amentities = $request->input('amentities');
        $implodedAmentities = implode(',', $amentities);
        $forlease->amentities = $implodedAmentities;

        // thumbnail
        if ($request->hasFile('thumbnail_image')) {
            $thumbnailImage = $request->file('thumbnail_image');
            $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();
            $thumbnailImage->storeAs('forlease/thumbnail', $imageName, 'public');
            // Delete previous thumbnail_image
            Storage::disk('public')->delete('forlease/thumbnail/' . $forlease->thumbnail_image);
            $forlease->thumbnail_image = $imageName;
        }


       // Update multi images
        if ($request->hasFile('image')) {
            $multiImages = $request->file('image');
            $imageNames = [];

            foreach ($multiImages as $multiImage) {
                $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $multiImage->getClientOriginalExtension();
                $multiImage->storeAs('forlease/multiimage', $imageName, 'public');
                $imageNames[] = $imageName;
            }

            // Append new image names to the existing ones
            $existingImages = explode(',', $forlease->image);
            $imageNames = array_merge($existingImages, $imageNames);

            // Reset the array keys to start from 0
            $imageNames = array_values($imageNames);

            $forlease->image = implode(',', $imageNames);
        }

        $forlease->update();
            if ($forlease->update()) {

                $response = [
                    'message' => 'Data updated successfully',
                    'thumbnail_image' => $forlease->thumbnail_image, // Add this line to include the thumbnail_image in the response
                    'imageUrl' => $forlease->image , // Add this line to include the thumbnail_image in the response
                ];
                return response()->json($response, 200);
            } else {
                return response()->json(['message' => 'Error update data'], 500);
            }
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

    public function deleteImage($id, $index)
    {
        // dd($id);
        // return response()->json([
        //     'index' => $index,
        //     'id' => $id
        // ]);


        // Fetch the record from the database
        $record = ForLease::findOrFail($id);
        
        // Extract the images field value
        $image = explode(',', $record->image);
        
        // Remove the image at the specified index
        if (isset($image[$index])) {
            
            // Delete the image file from storage
            $imagePath = 'forlease/multiimage/' . $image[$index];
            Storage::disk('public')->delete($imagePath);

            unset($image[$index]);
             // Reset the array keys to start from 0
            $image = array_values($image);
        }
        
        // Join the remaining images back into a string
        $updatedImages = implode(',', $image);
        
        // Update the record in the database
        $record->image = $updatedImages;
        $record->update();
        if ($record->wasChanged()) {

            $response = [
                'message' => 'Image deleted successfully',
                'updatedeleteimage' => $record->image,
            ];
            return response()->json($response, 200);
        } else {
            return response()->json(['message' => 'Error Image not found'], 500);
        }
    }
}
