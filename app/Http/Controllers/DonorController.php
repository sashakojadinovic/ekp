<?php

namespace App\Http\Controllers;

use App\Models\Site\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donors=Donor::all();
        return view("donors.donors", ["donors"=>$donors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("donors.donor-create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $values = $request->validate([
            'name'=>'required|string',
            'link'=>'required|url',
            'donor_partner'=>'required|boolean',
            "image"=>'required|file|image|mimes:jpg,jpeg,png'
        ]);

        try{
            \DB::beginTransaction();


            $imageName = time() .$request->file('image')->getClientOriginalName();
            $img = Image::make($request->file('image')->path());
            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/donors/'. $imageName);

            if($img){
                $values["image"]=$imageName;
                Donor::create($values);
            }
            \DB::commit();
        }
        catch(\Exception $e){
            \DB::rollBack();

            dd($e);
        }

        return back()->with("success","Dodato!");
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
        $donor=Donor::find($id);
        return view("donors.donor-edit", ["donor"=>$donor]);
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
        $donor=Donor::find($id);
        $request->validate([
            'name'=>'required|string',
            'link'=>'required|url',
            'donor_partner'=>'required|boolean',
            "image"=>'nullable|file|image|mimes:jpg,jpeg,png'
        ]);

        try{
            \DB::beginTransaction();
            $donor->name=$request->input("name");
            $donor->link=$request->input("link");
            $donor->donor_partner=$request->input("donor_partner");
            if($request->hasFile("image")){
                $imageName = time().$request->file('image')->getClientOriginalName();
                $img = Image::make($request->file('image')->path());
                $img->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/donors/'. $imageName);
                File::delete('images/donors/'.$donor->image);
                $donor->image=$imageName;
            }
            $donor->save();
            \DB::commit();
        }
        catch(\Exception $e){
            \DB::rollBack();

            dd($e);
        }

        return back()->with("success","Izmenjeno!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donor=Donor::find($id);
        $deleteImage=File::delete('images/donors/'.$donor->image);
        if($deleteImage) {
            $donor->delete();
            $donors=Donor::all();
            return json_encode(["uspeh"=>"Uspešno obrisano!", "donors"=>$donors]);
        }
        $donors=Donor::all();
        return json_encode(["uspeh"=>"Nije obrisano! Greska", "donors"=>$donors]);

    }
}
