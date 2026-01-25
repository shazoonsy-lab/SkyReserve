<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first() ?? Setting::create([]);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'admin_bg' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
            'seat_prices' => 'nullable|array',
            'seat_prices.*' => 'numeric|min:0',
            'notification_email' => 'nullable|email',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('images', 'public');
        }

        if ($request->hasFile('admin_bg')) {
            $data['admin_bg'] = $request->file('admin_bg')->store('images', 'public');
        }

        $setting->update($data);

        // 3. إعادة التوجيه للوحة التحكم مع رسالة نجاح
    return redirect()->route('admin.dashboard')
                     ->with('success', 'تم حفظ إعدادات الموقع بنجاح');
    }
}
