<?php

namespace Rslhdyt\LaraSettings\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Rslhdyt\LaraSettings\Models\Setting;

class SettingController extends Controller
{
    /**
     * Show settings form
     */
    public function edit()
    {
        return view('larasettings::' . config('settings.view'))
            ->withSettings(Setting::all());
    }
    
    /**
     * Update settings based on key value
     */
    public function update(Request $request)
    {
        $form = $request->except('_method', '_token');
        $form = collect($form);

        $form->each(function ($value, $key) {
            $setting = Setting::where('key', str_replace('_', '.', $key))->first();
            $setting->value = $value;
            $setting->save();
        });

        Cache::forget('larasettings');

        return redirect()->back()
            ->with('message-success', 'Setting updated!');
    }
}
