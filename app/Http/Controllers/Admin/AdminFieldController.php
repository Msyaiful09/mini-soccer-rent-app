<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminFieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        return view('admin.pages.field.index', [
            'title' => 'Kelola Lapangan',
            'fields' => $fields
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:fields,name',
            'address' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/fields'), $imageName);
        }

        Field::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'address' => $validated['address'],
            'description' => $validated['description'],
            'image' => $imageName
        ]);

        return redirect()->route('admin.fields.index')->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $field = Field::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:fields,name,' . $field->id,
            'address' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048'
        ]);

        $imageName = $field->image;
        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('uploads/fields/' . $imageName))) {
                unlink(public_path('uploads/fields/' . $imageName));
            }
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/fields'), $imageName);
        }

        $field->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'address' => $validated['address'],
            'description' => $validated['description'],
            'image' => $imageName
        ]);

        return redirect()->route('admin.fields.index')->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $field = Field::findOrFail($id);

        if ($field->image && file_exists(public_path('uploads/fields/' . $field->image))) {
            unlink(public_path('uploads/fields/' . $field->image));
        }

        $field->delete();

        return redirect()->route('admin.fields.index')->with('success', 'Lapangan berhasil dihapus.');
    }
}
