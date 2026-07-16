<?php

namespace App\Http\Controllers;

use App\Models\Strava;
use Illuminate\Http\Request;

class StravaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Strava $strava)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Strava $strava)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Strava $strava)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Strava $strava)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $code = $request->input('code');

    
        //direct them here
        return redirect()->away(
            "https://www.strava.com/oauth/authorize?client_id={$clientId}" .
            "&response_type=code&redirect_uri={$redirect}" .
            "&approval_prompt=auto&scope=read,activity:read_all"
        );
    }

    public function callback(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $response = Http::asForm()->post('https://www.strava.com/oauth/token', [
            'client_id' => config('services.strava.client_id'),
            'client_secret' => config('services.strava.client_secret'),
            'code' => $request->code,
            'grant_type' => 'authorization_code',
        ]);

        $data = $response->json();
        // store access_token / refresh_token / athlete id
    }
}
