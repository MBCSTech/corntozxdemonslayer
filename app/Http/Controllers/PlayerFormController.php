<?php

namespace App\Http\Controllers;

use App\Models\PlayerForm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerFormController extends Controller
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
        $week = '';

        switch (true) {
            case $today->between(
                Carbon::parse('2024-06-01')->setTime(0, 0, 0),
                Carbon::parse('2024-06-14')->setTime(23, 59, 59)
            ):
                $week = 'Week1';
                break;

            case $today->between(
                Carbon::parse('2024-06-15')->setTime(0, 0, 0),
                Carbon::parse('2024-06-28')->setTime(23, 59, 59)
            ):
                $week = 'Week2';
                break;

            case $today->between(
                Carbon::parse('2024-06-29')->setTime(0, 0, 0),
                Carbon::parse('2024-07-12')->setTime(23, 59, 59)
            ):
                $week = 'Week3';
                break;

            case $today->between(
                Carbon::parse('2024-07-13')->setTime(0, 0, 0),
                Carbon::parse('2024-07-26')->setTime(23, 59, 59)
            ):
                $week = 'Week4';
                break;

            case $today->between(
                Carbon::parse('2024-07-27')->setTime(0, 0, 0),
                Carbon::parse('2024-08-09')->setTime(23, 59, 59)
            ):
                $week = 'Week5';
                break;

            case $today->between(
                Carbon::parse('2024-08-10')->setTime(0, 0, 0),
                Carbon::parse('2024-08-23')->setTime(23, 59, 59)
            ):
                $week = 'Week6';
                break;

            case $today->between(
                Carbon::parse('2024-08-24')->setTime(0, 0, 0),
                Carbon::parse('2024-09-06')->setTime(23, 59, 59)
            ):
                $week = 'Week7';
                break;

            case $today->between(
                Carbon::parse('2024-09-07')->setTime(0, 0, 0),
                Carbon::parse('2024-09-13')->setTime(23, 59, 59)
            ):
                $week = 'Week8';
                break;

            default:
                $week = 'Contest ended/not yet started';
                break;
        }


        // Create a new PuzzleForm record with the determined puzzle version
        $puzzleForm = PlayerForm::create([
            'nama' => $request->nama,
            'no_ic' => $request->no_ic,
            'no_fon' => $request->no_fon,
            'week' => $week,
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
