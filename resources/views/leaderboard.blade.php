<x-site-layout>
    <style>
        .navbars {
            position: sticky;
        }

        .bg {
            display: flex;
            flex-direction: column;
            background-image: url('/assets/bg.png');
            background-size: cover;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            padding: 1rem;
        }

        .bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 162, 202, 0.5);
            z-index: 0;
        }

        .bg>* {
            position: relative;
            z-index: 1;
        }

        .masthead {
            width: 100%;
            max-width: 600px;
            text-align: center;
            margin-bottom: 1rem;
        }

        .masthead img {
            max-width: 100%;
            height: auto;
        }

        /* Score container with relative positioning */
        .score-container {
            position: relative;
            width: 80%;
            max-width: 500px;
            margin: 0 auto;
        }

        .score-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Text positioned relative to its container */
        .score-text {
            font-family: "PoppinsExtraBoldItalic", sans-serif;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(33%, -39%) rotate(-3deg);
            font-size: clamp(2.5rem, 5vw, 2.5rem);
            color: #fff;
            white-space: nowrap;
        }

        /* Week indicator */
        .week-indicator {
            font-family: "PoppinsBold", sans-serif;
            background-color: #FFA2CA;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.5rem 0;
            text-align: center;
        }

        /* Leaderboard container with relative positioning */
        .leaderboard-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: -40px auto 0;
        }

        .leaderboard-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Leaders list styles */
        .leaderboard-entries {
            position: absolute;
            top: 53%;
            left: 12%;
            right: -7%;
            display: flex;
            flex-direction: column;
            padding: 0 15%;
            gap: 0.5rem;
        }

        .leader-row {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .leaders-name,
        .leaders-score {
            font-family: "PoppinsBlackItalic", sans-serif;
            color: #231F20;
            font-size: clamp(0.9rem, 2.5vw, 1.2rem);
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 300px;
            margin: 1rem auto;
        }

        .restart-button img,
        .proceed-button img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Responsive adjustments */
        /* @media (max-width: 768px) {
            .leaderboard-entries {
                padding: 0 18%;
            }
        }

        @media (max-width: 480px) {
            .leaderboard-entries {
                padding: 0 20%;
                top: 35%;
            }
        } */
    </style>
    <div class="min-h-screen bg">
        <div class="masthead">
            <img src="/assets/masthead.png" alt="mast">
        </div>

        <!-- Score with container to keep text aligned with image -->
        <div class="score-container">
            <img src="/assets/endscoreboard.png" alt="score">
            <h4 class="score-text">{{ $score }}</h4>
        </div>

        <!-- Week indicator (optional) -->
        {{-- <div class="week-indicator">
            {{ $currentWeek }}
        </div> --}}

        <!-- Leaderboard with container to keep text aligned with image -->
        <div class="leaderboard-container">
            <img src="/assets/leaderboard.png" alt="leaderboard">

            <div class="leaderboard-entries">
                @forelse($topPlayers as $index => $player)
                    <div class="leader-row">
                        <h4 class="leaders-name">{{ $player->nama }}</h4>
                        <h4 class="leaders-score">{{ $player->score }}</h4>
                    </div>
                @empty
                    <div class="leader-row">
                        <h4 class="leaders-name">No players yet</h4>
                        <h4 class="leaders-score">-</h4>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="buttons">
            <div class="restart-button">
                <a href="/game"><img src="/assets/restart-button.png"></a>
            </div>
            <div class="proceed-button">
                <a href="/form-submission"><img src="/assets/proceed-button.png"></a>
            </div>
        </div>
    </div>
</x-site-layout>
