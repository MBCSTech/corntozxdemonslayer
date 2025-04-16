<?php

namespace App\Http\Controllers;

use App\Models\PlayerForm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerFormController extends Controller
{
    public function index()
    {
        $score = session('last_game_score', 0);
        return view('form-submission', ['score' => $score]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/', // Only allow letters and spaces
            ],
            'no_ic' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (preg_match('/[a-zA-Z]/', $value)) {
                        $fail('Sila gunakan nombor sahaja.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (strpos($value, '-') !== false) {
                        $fail('Sila gunakan format nombor IC yang sah tanpa tanda (-).');
                    }
                },
                'digits:12',
            ],
            'no_fon' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (preg_match('/[a-zA-Z]/', $value)) {
                        $fail('Sila gunakan nombor sahaja.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (strpos($value, '-') !== false) {
                        $fail('Sila gunakan nombor telefon yang sah tanpa tanda (-).');
                    }
                },
                'regex:/^[0-9\-]+$/',
                'min:10',
                'max:15',
            ],
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:3072',
        ], [
            'nama.required' => 'Sila isi ruangan ini.',
            'nama.regex' => 'Sila gunakan huruf sahaja.',
            'no_ic.required' => 'Sila isi ruangan ini.',
            'no_ic.digits' => 'Sila panjangkan teks ini kepada 12 aksara atau lebih.',
            'no_fon.required' => 'Sila isi ruangan ini.',
            'no_fon.regex' => 'Sila gunakan format nombor telefon yang sah, cth: 012.',
            'no_fon.min' => 'Nombor telefon terlalu pendek.',
            'no_fon.max' => 'Nombor telefon terlalu panjang.',
            'receipt.required' => 'Sila lampirkan resit anda.',
            'receipt.file' => 'Fail tidak sah.',
            'receipt.mimes' => 'Sila ikut format yang diminta.',
            'receipt.max' => 'Resit melibihi saiz yang ditetapkan.',
        ]);


        // Save the score from session
        $score = session('last_game_score', 0);

        // Determine the puzzle version based on the current date
        $today = Carbon::now();
        $week = '';

        switch (true) {
            case $today->between(
                Carbon::parse('2024-06-01')->setTime(0, 0, 0),
                Carbon::parse('2024-06-08')->setTime(23, 59, 59)
            ):
                $week = 'Week1';
                break;

            case $today->between(
                Carbon::parse('2024-06-09')->setTime(0, 0, 0),
                Carbon::parse('2024-06-15')->setTime(23, 59, 59)
            ):
                $week = 'Week2';
                break;

            case $today->between(
                Carbon::parse('2024-06-16')->setTime(0, 0, 0),
                Carbon::parse('2024-06-22')->setTime(23, 59, 59)
            ):
                $week = 'Week3';
                break;

            case $today->between(
                Carbon::parse('2024-06-23')->setTime(0, 0, 0),
                Carbon::parse('2024-06-29')->setTime(23, 59, 59)
            ):
                $week = 'Week4';
                break;

            case $today->between(
                Carbon::parse('2024-06-30')->setTime(0, 0, 0),
                Carbon::parse('2024-07-06')->setTime(23, 59, 59)
            ):
                $week = 'Week5';
                break;

            case $today->between(
                Carbon::parse('2024-07-07')->setTime(0, 0, 0),
                Carbon::parse('2024-07-13')->setTime(23, 59, 59)
            ):
                $week = 'Week6';
                break;

            case $today->between(
                Carbon::parse('2024-07-14')->setTime(0, 0, 0),
                Carbon::parse('2024-07-20')->setTime(23, 59, 59)
            ):
                $week = 'Week7';
                break;

            case $today->between(
                Carbon::parse('2024-07-21')->setTime(0, 0, 0),
                Carbon::parse('2024-07-31')->setTime(23, 59, 59)
            ):
                $week = 'Week8';
                break;

            default:
                $week = 'Contest ended/not yet started';
                break;
        }

        // Create a new PlayerForm record with the determined puzzle version
        $playerForm = PlayerForm::create([
            'nama' => $request->nama,
            'no_ic' => $request->no_ic,
            'no_fon' => $request->no_fon,
            'week' => $week,
            'score' => $score, // Store the score
        ]);

        $fileExtension = $request->file('receipt')->extension();
        $filename = "uid" . "{$playerForm->id}_{$request->no_ic}.{$fileExtension}";

        // Store the file
        $path = $request->file('receipt')->storeAs('resit', $filename, 'public');

        // Update the record with the file path
        $playerForm->update(['receipt' => $path]);

        // Redirect to a confirmation page with a success message
        return redirect('/confirm')->with('success', 'Your form has been submitted successfully');
    }
}
