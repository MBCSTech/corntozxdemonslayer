<?php

namespace App\Http\Controllers;

use App\Models\PuzzleForm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PuzzleFormController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_ic' => 'required|digits:12',
            'no_fon' => 'required|digits_between:10,12',
            'resit' => 'required|file|mimes:jpeg,png,jpg,pdf|max:3072',
        ]);


        // Determine the puzzle version based on the current date
        $today = Carbon::now();
        $puzzleVersion = '';

        switch (true) {
            case $today->between(
                Carbon::parse('2024-10-01')->setTime(0, 0, 0),
                Carbon::parse('2024-10-14')->setTime(23, 59, 59)
            ):
                $puzzleVersion = 'Puzzle01';
                break;

            case $today->between(
                Carbon::parse('2024-10-15')->setTime(0, 0, 0),
                Carbon::parse('2024-10-28')->setTime(23, 59, 59)
            ):
                $puzzleVersion = 'Puzzle02';
                break;

            case $today->between(
                Carbon::parse('2024-10-29')->setTime(0, 0, 0),
                Carbon::parse('2024-11-11')->setTime(23, 59, 59)
            ):
                $puzzleVersion = 'Puzzle03';
                break;

            case $today->greaterThanOrEqualTo(
                Carbon::parse('2024-11-12')->setTime(0, 0, 0)
            ):
                $puzzleVersion = 'Puzzle04';
                break;

            default:
                $puzzleVersion = 'Puzzle01'; // Handle unexpected dates if needed
                break;
        }


        // Create a new PuzzleForm record with the determined puzzle version
        $puzzleForm = PuzzleForm::create([
            'nama' => $request->nama,
            'no_ic' => $request->no_ic,
            'no_fon' => $request->no_fon,
            'puzzle_version' => $puzzleVersion,
        ]);

        $fileExtension = $request->file('resit')->extension();
        $filename = "uid" . "{$puzzleForm->id}_{$request->no_ic}.{$fileExtension}";

        // Store the file
        $path = $request->file('resit')->storeAs('resit', $filename, 'public');

        // Update the record with the file path
        $puzzleForm->update(['resit' => $path]);

        // Redirect to a confirmation page with a success message
        return redirect('/confirmation')->with('success', 'Your form has been submitted successfully');
    }
}
