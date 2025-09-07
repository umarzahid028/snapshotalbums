<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Amentities;
use App\Models\Admin\ForSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ForSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forsales = Forsale::all();
        
        return view('admin.forsale.index', compact('forsales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amentity_for_sale = Amentities::all();
        return view('admin.forsale.create', compact('amentity_for_sale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
    'address' => 'required',
    'property_desc' => 'required',
    'thumbnail_image' => 'required',
    'thumbnail_image.*' => 'image|mimes:jpeg,jpg,png|max:2048', // Validate the thumbnail image format and size
    'image' => 'required|array|min:5', // Require the image input to be an array with a minimum of 5 elements
    'image.*' => 'image|mimes:jpeg,jpg,png|max:2048', // Validate each image format and size
    'lot_sale_price' => 'required',
            // Add validation rules for other fields
        ]);


        // return response()->json($request->all());
        // dd($request->all());
        $thumbnailImage = $request->file('thumbnail_image');


        $forsale = new ForSale();
        $forsale->title = $request->input('title');
        $forsale->secondary_type = $request->input('secondary_type');
        $forsale->property_type = 'Forsale';
        $forsale->property_desc = $request->input('property_desc');
        $forsale->address = $request->input('address');
        $forsale->latitude = $request->input('latitude');
        $forsale->longitude = $request->input('longitude');
        // $forsale->thumbnail_image = $thumbnailImage->input('thumbnail_image');
        // $forsale->image = $request->input('image');
        $forsale->lot_sale_price = $request->input('lot_sale_price');
        $forsale->lot_sale_size = $request->input('lot_sale_size');
        $forsale->lot_desc = $request->input('lot_desc');
        $forsale->zoning = $request->input('zoning');
        $forsale->zoning_desc = $request->input('zoning_desc');
        $forsale->taxes_year = $request->input('taxes_year');
        $forsale->taxes_tax = $request->input('taxes_tax');

        // amentities store 
        if($request->amentities!=null){
            $amentities = $request->input('amentities');
            $implodedAmentities = implode(',', $amentities);
            $forsale->amentities = $implodedAmentities;
            }

            // thumbnail
        if($request->image != null){

            // $image = $request->image;
            $thumbnailImage = $request->file('thumbnail_image');
            $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();

            //Store
            $thumbnailImage->storeAs('forsale/thumbnail', $imageName, 'public');
         }else {
             $imageName = $forsale->image;
         }

         $forsale->thumbnail_image = $imageName;

        //  multi Image

         if ($request->hasFile('image')) {
            $multiImages = $request->file('image');
            $imageNames = [];
        
            foreach ($multiImages as $multiImage) {
                $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $multiImage->getClientOriginalExtension();
                $multiImage->storeAs('forsale/multiimage', $imageName, 'public');
                $imageNames[] = $imageName;
            }
        
            $multiImageName = implode(',', $imageNames);
        } else {
            $multiImageName = $forsale->image;
        }

        $forsale->image = $multiImageName;
        $forsale->save();

        if ($forsale->save()) {
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forsales = Forsale::where('id', $id)->get();
        $index = 'index';
        // dd($forsales->all());
        return view('admin.forsale.edit', compact('forsales', 'index'));
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
        // dd($request->all());
        // return response()->json( $request);
        // return response()->json($id);

        $forsale = ForSale::findOrFail($id);
        $forsale->title = $request->input('title');
        $forsale->secondary_type = $request->input('secondary_type');
        $forsale->property_desc = $request->input('property_desc');
        $forsale->address = $request->input('address');
        $forsale->latitude = $request->input('latitude');
        $forsale->longitude = $request->input('longitude');
        // $forsale->thumbnail_image = $thumbnailImage->input('thumbnail_image');
        // $forsale->image = $request->input('image');
        $forsale->lot_sale_price = $request->input('lot_sale_price');
        $forsale->lot_sale_size = $request->input('lot_sale_size');
        $forsale->lot_desc = $request->input('lot_desc');
        $forsale->zoning = $request->input('zoning');
        $forsale->zoning_desc = $request->input('zoning_desc');
        $forsale->taxes_year = $request->input('taxes_year');
        $forsale->taxes_tax = $request->input('taxes_tax');

        $amentities = $request->input('amentities');
        $implodedAmentities = implode(',', $amentities);
        $forsale->amentities = $implodedAmentities;

        
            // thumbnail
            if ($request->hasFile('thumbnail_image')) {
                $thumbnailImage = $request->file('thumbnail_image');
                $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $thumbnailImage->getClientOriginalExtension();
                $thumbnailImage->storeAs('forsale/thumbnail', $imageName, 'public');
                // Delete previous thumbnail_image
                Storage::disk('public')->delete('forsale/thumbnail/' . $forsale->thumbnail_image);
                $forsale->thumbnail_image = $imageName;
            }


           // Update multi images
            if ($request->hasFile('image')) {
                $multiImages = $request->file('image');
                $imageNames = [];

                foreach ($multiImages as $multiImage) {
                    $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $multiImage->getClientOriginalExtension();
                    $multiImage->storeAs('forsale/multiimage', $imageName, 'public');
                    $imageNames[] = $imageName;
                }

                // Append new image names to the existing ones
                $existingImages = explode(',', $forsale->image);
                $imageNames = array_merge($existingImages, $imageNames);

                // Reset the array keys to start from 0
                $imageNames = array_values($imageNames);

                $forsale->image = implode(',', $imageNames);
            }

            $forsale->update();
            if ($forsale->update()) {

                $response = [
                    'message' => 'Data updated successfully',
                    'thumbnail_image' => $forsale->thumbnail_image, // Add this line to include the thumbnail_image in the response
                    'imageUrl' => $forsale->image , // Add this line to include the thumbnail_image in the response
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
        // dd($id);
        $forsale = ForSale::find($id);
        if ($forsale) {
            $forsale->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
        // return response()->json($index);
    }


    public function deleteImage($id, $index)
    {
        // dd($id);
        // return response()->json([
        //     'index' => $index,
        //     'id' => $id
        // ]);


        // Fetch the record from the database
        $record = ForSale::findOrFail($id);
        
        // Extract the images field value
        $image = explode(',', $record->image);
        
        // Remove the image at the specified index
        if (isset($image[$index])) {
            
            // Delete the image file from storage
            $imagePath = 'forsale/multiimage/' . $image[$index];
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
