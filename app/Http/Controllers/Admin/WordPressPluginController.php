<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WordPressPluginController extends Controller
{
    /**
     * Display a listing of the WordPress plugins.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plugins = Product::latest()->paginate(15);
        return view('admin.plugins.index', compact('plugins'));
    }

    /**
     * Show the form for creating a new WordPress plugin.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.plugins.create');
    }

    /**
     * Store a newly created WordPress plugin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'version' => 'required|string|max:20',
            'tested_up_to' => 'required|string|max:20',
            'requires_php' => 'required|string|max:20',
            'requires_wordpress' => 'required|string|max:20',
            'price_monthly' => 'required|numeric|min:0',
            'price_yearly' => 'required|numeric|min:0',
            'default_activation_limit' => 'required|integer|min:1|max:100',
            'plugin_file' => 'required|file|mimes:zip|max:10240', // Max 10MB
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'changelog' => 'nullable|string',
            'documentation_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'support_url' => 'nullable|url',
        ]);

        // Handle file uploads
        if ($request->hasFile('plugin_file')) {
            $file = $request->file('plugin_file');
            $fileName = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('plugins', $fileName, 'public');
            $validated['file_path'] = $filePath;
        }

        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('plugins/banners', 'public');
            $validated['banner_image'] = $bannerPath;
        }

        if ($request->hasFile('icon_image')) {
            $iconPath = $request->file('icon_image')->store('plugins/icons', 'public');
            $validated['icon_image'] = $iconPath;
        }

        // Set default values
        $validated['is_active'] = $request->has('is_active');
        $validated['slug'] = Str::slug($request->name);
        $validated['default_activation_limit'] = $validated['default_activation_limit'] ?? 1;

        // Create the plugin
        $plugin = Product::create($validated);

        return redirect()->route('admin.plugins.index')
            ->with('success', 'WordPress plugin created successfully.');
    }

    /**
     * Display the specified WordPress plugin.
     *
     * @param  \App\Models\Product  $plugin
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $plugin = Product::findOrFail($id);
        return view('admin.plugins.show', compact('plugin'));
    }

    /**
     * Show the form for editing the specified WordPress plugin.
     *
     * @param  \App\Models\Product  $plugin
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $plugin = Product::findOrFail($id);
        return view('admin.plugins.edit', compact('plugin'));
    }

    /**
     * Update the specified WordPress plugin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $plugin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $plugin = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($plugin->id)],
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'version' => 'required|string|max:20',
            'tested_up_to' => 'required|string|max:20',
            'requires_php' => 'required|string|max:20',
            'requires_wordpress' => 'required|string|max:20',
            'price_monthly' => 'required|numeric|min:0',
            'price_yearly' => 'required|numeric|min:0',
            'default_activation_limit' => 'required|integer|min:1|max:100',
            'plugin_file' => 'nullable|file|mimes:zip|max:10240', // Max 10MB
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'changelog' => 'nullable|string',
            'documentation_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'support_url' => 'nullable|url',
        ]);

        // Handle file uploads
        if ($request->hasFile('plugin_file')) {
            // Delete old file if exists
            if ($plugin->file_path) {
                Storage::disk('public')->delete($plugin->file_path);
            }
            
            $file = $request->file('plugin_file');
            $fileName = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('plugins', $fileName, 'public');
            $validated['file_path'] = $filePath;
        }

        if ($request->hasFile('banner_image')) {
            // Delete old banner if exists
            if ($plugin->banner_image) {
                Storage::disk('public')->delete($plugin->banner_image);
            }
            $bannerPath = $request->file('banner_image')->store('plugins/banners', 'public');
            $validated['banner_image'] = $bannerPath;
        }

        if ($request->hasFile('icon_image')) {
            // Delete old icon if exists
            if ($plugin->icon_image) {
                Storage::disk('public')->delete($plugin->icon_image);
            }
            $iconPath = $request->file('icon_image')->store('plugins/icons', 'public');
            $validated['icon_image'] = $iconPath;
        }

        // Update the plugin
        $validated['is_active'] = $request->has('is_active');
        $plugin->update($validated);

        return redirect()->route('admin.plugins.index')
            ->with('success', 'WordPress plugin updated successfully.');
    }

    /**
     * Remove the specified WordPress plugin from storage.
     *
     * @param  \App\Models\Product  $plugin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $plugin = Product::findOrFail($id);
        
        // Delete associated files
        if ($plugin->file_path) {
            Storage::disk('public')->delete($plugin->file_path);
        }
        if ($plugin->banner_image) {
            Storage::disk('public')->delete($plugin->banner_image);
        }
        if ($plugin->icon_image) {
            Storage::disk('public')->delete($plugin->icon_image);
        }
        
        $plugin->delete();
        
        return redirect()->route('admin.plugins.index')
            ->with('success', 'WordPress plugin deleted successfully.');
    }
}
