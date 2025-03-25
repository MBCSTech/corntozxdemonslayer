<?php

namespace App\Http\Controllers;

use App\Models\PlayerForm;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlayersController extends Controller
{
    public function show(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $week = $request->input('puzzle_version');

        // Build the query
        $query = PlayerForm::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        if ($week) {
            $query->where('puzzle_version', $week);
        }

        $query->orderBy('created_at', 'desc');

        // If the request is for export, return the data as JSON
        if ($request->has('export')) {
            $users = $query->get();
            return response()->json($users->map(function ($user) {
                return [
                    'User ID' => 'uid' . $user->id,
                    'Date Posted' => $user->created_at->format('d/m/y H:i:s'),
                    'Name' => $user->nama,
                    'IC Number' => $user->no_ic,
                    'Phone Number' => $user->no_fon,
                    'Score' => $user->score,
                    'Receipt_Name' => explode("/", $user->resit ?? '')[1] ?? null,
                ];
            }));
        }

        // Otherwise, paginate and return the view
        $paginatedUsers = $query->paginate(10)->appends([
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        return view('dashboard', [
            'loading' => false,
            'users' => $paginatedUsers,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }


    public function edit($id)
    {
        $user = PlayerForm::findOrFail($id);

        return view('player.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_ic' => 'required|digits:12',
            'no_fon' => 'required|between:10,12',
        ]);

        $user = PlayerForm::findOrFail($id);

        $user->update([
            'nama' => $validated['nama'],
            'no_ic' => $validated['no_ic'],
            'no_fon' => $validated['no_fon'],
        ]);

        return redirect()->route('dashboard')->with('success', 'User details has been updated successfully');
    }
}
