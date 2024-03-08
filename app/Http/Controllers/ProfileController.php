<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    final public function index():View
    {
        $divisions = Division::pluck('name', 'id');
        $profile = Profile::where('user_id', Auth::id())->first();

        return view('backend.modules.profile.profile', compact('divisions', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'phone' => 'required',
            'gender' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
        ]);
        $profile_data = $request->all();
        $profile_data['user_id'] = Auth::id();

        $existing_profile = Profile::where('user_id', Auth::id())->first();
        if($existing_profile){
            $existing_profile->update($profile_data);
        } else {
            Profile::create($profile_data);
        }


        // dd($profile_data);
        return redirect()->back();
    }


    /**
     * @param int $division_id
     * @return JsonResponse
     */
    final public function getDistrict(int $division_id):JsonResponse
    {
        $district = District::select('name', 'id')->where('division_id', $division_id)->get();
        // dd($district);
        return response()->json($district);
    }

    /**
     * @param int $district_id
     * @return JsonResponse
     */
    final public function getThana(int $district_id):JsonResponse
    {
        $thana = Thana::select('name', 'id')->where('district_id', $district_id)->get();
        // dd($thana);
        return response()->json($thana);
    }



    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
