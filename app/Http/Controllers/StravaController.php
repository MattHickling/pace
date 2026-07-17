<?php

namespace App\Http\Controllers;

use App\Models\Strava;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

    public function login()
    {
        $clientId = config('services.strava.client_id');
        $redirect = config('services.strava.redirect');
        // dd(__LINE__, $clientId, $redirect);
        if (! $clientId || ! $redirect) {
            abort(500, 'Strava client_id or redirect URI is not configured.');
        }

        return redirect()->away(
            "https://www.strava.com/oauth/authorize?client_id={$clientId}" .
            "&response_type=code&redirect_uri=" . urlencode($redirect) .
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

        if ($response->failed()) {
            abort(500, 'Strava token request failed: ' . $response->body());
        }

        $data = $response->json();
        $athlete = $data['athlete'] ?? [];
        $athleteId = $athlete['id'] ?? null;

        if (! $athleteId) {
            abort(500, 'Strava athlete id missing from response.');
        }

        $user = Auth::user();

        if (! $user) {
            $email = $athlete['email'] ?? "strava+{$athleteId}@paceapp.co.uk";
            $name = trim(($athlete['firstname'] ?? '') . ' ' . ($athlete['lastname'] ?? '')) ?: "Strava user {$athleteId}";

            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make(Str::random(32))]
            );
        }

        $strava = Strava::updateOrCreate(
            ['strava_athlete_id' => $athleteId],
            [
                'user_id' => $user->id,
                'access_token' => $data['access_token'],
                'refresh_token' => $data['refresh_token'],
                'expires_at' => $data['expires_at'],
                'scope' => $data['scope'] ?? null,
            ]
        );

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Connected to Strava.');
    }
}
