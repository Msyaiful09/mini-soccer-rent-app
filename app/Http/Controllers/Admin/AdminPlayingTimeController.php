<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\PlayTime;
use Illuminate\Http\Request;

class AdminPlayingTimeController extends Controller
{
    public function index($fieldId)
    {
        $field = Field::findOrFail($fieldId);
        $playingTimes = PlayTime::where('field_id', $fieldId)->orderBy('start_time')->get();

        return view('admin.pages.playing-time.index', compact('field', 'playingTimes'), [
            'title' => 'Kelola Jam Main - ' . $field->name
        ]);
    }

    public function store(Request $request, $fieldId)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'price' => 'required|numeric',
        ]);

        PlayTime::create([
            'field_id' => $fieldId,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'price' => $request->price,
        ]);

        return back()->with('success', 'Jam main berhasil ditambahkan');
    }

    public function update(Request $request, PlayTime $playingTime)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'price' => 'required|numeric',
        ]);

        $playingTime->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'price' => $request->price,
        ]);

        return back()->with('success', 'Jam main berhasil diperbarui');
    }

    public function destroy(PlayTime $playingTime)
    {
        $playingTime->delete();

        return back()->with('success', 'Jam main berhasil dihapus');
    }
}
