<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {

            $setting = Setting::create([
                'company_name'      => 'Smart Access Control',
                'timezone'          => 'Asia/Riyadh',
                'door_unlock_time' => 5,
                'voice_enabled'     => true,
                'hardware_enabled'  => false,
            ]);

        }

        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
{
    $request->validate([

        'company_name'      => 'required|string|max:255',

        'company_logo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'timezone'          => 'required|string',

        'door_unlock_time'  => 'required|integer|min:1|max:30',

    ]);

    $setting = Setting::first();

    if (!$setting) {

        $setting = new Setting();

    }

    $setting->company_name = $request->company_name;

    $setting->timezone = $request->timezone;

    $setting->door_unlock_time = $request->door_unlock_time;

    $setting->voice_enabled = $request->has('voice_enabled');

    $setting->hardware_enabled = $request->has('hardware_enabled');

    if ($request->hasFile('company_logo')) {

        $logo = $request->file('company_logo')
                        ->store('company', 'public');

        $setting->company_logo = $logo;

    }

    $setting->save();

    return redirect()
            ->route('settings.index')
            ->with('success', 'Settings updated successfully.');
}
}