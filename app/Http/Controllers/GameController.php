<?php

namespace App\Http\Controllers;

use App\Models\PlayerForm;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GameController extends Controller
{
    public function index()
    {
        $score = session('last_game_score', 0);

        // Determine the current week based on date
        $today = Carbon::now();
        $currentWeek = $this->determineCurrentWeek($today);

        // Get top 3 players for current week only
        $topPlayers = PlayerForm::where('week', $currentWeek)
            ->whereNotNull('score')
            ->orderBy('score', 'desc')
            ->limit(3)
            ->get(['nama', 'score']);

        return view('leaderboard', compact('topPlayers', 'score', 'currentWeek'));
    }

    /**
     * Determine the current week based on date ranges
     */
    private function determineCurrentWeek(Carbon $date)
    {
        switch (true) {
            case $date->between(
                Carbon::parse('2024-06-01')->setTime(0, 0, 0),
                Carbon::parse('2024-06-14')->setTime(23, 59, 59)
            ):
                return 'Week1';

            case $date->between(
                Carbon::parse('2024-06-15')->setTime(0, 0, 0),
                Carbon::parse('2024-06-28')->setTime(23, 59, 59)
            ):
                return 'Week2';

            case $date->between(
                Carbon::parse('2024-06-29')->setTime(0, 0, 0),
                Carbon::parse('2024-07-12')->setTime(23, 59, 59)
            ):
                return 'Week3';

            case $date->between(
                Carbon::parse('2024-07-13')->setTime(0, 0, 0),
                Carbon::parse('2024-07-26')->setTime(23, 59, 59)
            ):
                return 'Week4';

            case $date->between(
                Carbon::parse('2024-07-27')->setTime(0, 0, 0),
                Carbon::parse('2024-08-09')->setTime(23, 59, 59)
            ):
                return 'Week5';

            case $date->between(
                Carbon::parse('2024-08-10')->setTime(0, 0, 0),
                Carbon::parse('2024-08-23')->setTime(23, 59, 59)
            ):
                return 'Week6';

            case $date->between(
                Carbon::parse('2024-08-24')->setTime(0, 0, 0),
                Carbon::parse('2024-09-06')->setTime(23, 59, 59)
            ):
                return 'Week7';

            case $date->between(
                Carbon::parse('2024-09-07')->setTime(0, 0, 0),
                Carbon::parse('2024-09-13')->setTime(23, 59, 59)
            ):
                return 'Week8';

            default:
                // Default to the most recent week that has data
                $latestWeek = PlayerForm::whereNotNull('score')
                    ->orderBy('created_at', 'desc')
                    ->first();

                return $latestWeek ? $latestWeek->week : 'Week1';
        }
    }
}
