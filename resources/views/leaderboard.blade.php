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
            overflow: hidden;
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
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            height: 9rem;
            width: 75%;
            max-width: 500px;
            text-align: center;
            background: url('/assets/endscoreboard.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .score-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Text positioned relative to its container */
        .score-text {
            font-family: "PoppinsExtraBoldItalic", sans-serif;
            font-size: clamp(2rem, 5vw, 2.5rem);
            color: #fff;
            transform: translate(38px, 6%);
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
            transform: translate(-1%, 0);
            max-width: 600px;
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
            top: 55%;
            left: 12%;
            right: -7%;
            display: flex;
            flex-direction: column;
            padding: 0 15%;
            gap: 0.2rem;
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
            max-width: 500px;
            margin: 1rem auto;
        }

        .restart-button img,
        .proceed-button img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Responsive adjustments */

        @media (min-width: 350px) {
            .leaderboard-entries {
                top: 56%;
                gap: 0.5rem;
            }
        }

        @media (min-width: 375px) {
            .leaderboard-entries {
                gap: 0.6rem;
            }
        }


        @media (min-width: 420px) {
            .leaderboard-entries {
                gap: 0.8rem;
            }
        }

        @media (min-width: 475px) {
            .leaderboard-entries {
                gap: 1rem;
            }
        }

        @media (min-width: 495px) {
            .leaderboard-entries {
                gap: 1.2rem;
            }
        }

        @media (min-width: 540px) {
            .leaderboard-entries {
                gap: 1.5rem;
            }
        }

        @media (min-width: 628px) {
            .leaderboard-entries {
                gap: 1.8rem;
            }
        }

        @media (min-width: 768px) {
            .score-container {
                height: 16rem;
            }

            .score-text {
                transform: translate(63px, 14%);
            }

            .leaderboard-container {
                max-width: 70%;
            }

            .leaderboard-entries {
                top: 55%;
                gap: 1.25rem;
            }

        }

        @media (min-width: 865px) {
            .leaderboard-entries {
                gap: 1.5rem;
            }
        }

        @media (min-width: 900px) {
            .leaderboard-entries {
                gap: 2rem;
            }
        }

        @media (min-width: 1024px) {

            .buttons {
                flex-direction: row;
                max-width: 50%;
            }

            .leaderboard-container {
                max-width: 50%;
            }

            .leaderboard-entries {
                top: 57%;
                gap: 1rem;
            }

            .bg {
                background-image: url('/assets/bg-desktop.png');
                background-size: cover;
                background-position: center;
            }
        }

        @media (min-width: 1220px) {
            .leaderboard-entries {
                gap: 1.5rem;
            }

            .score-text {
                transform: translate(66px, 14%)
            }
        }

        @media (min-width: 1350px) {
            .leaderboard-entries {
                gap: 2rem;
            }
        }

        @media (min-width: 1440px) {
            .leaderboard-entries {
                gap: 2.5rem;
            }
        }

        @media (min-width: 1780px) {
            .leaderboard-entries {
                gap: 3.5rem;
            }
        }

        /* @media (max-width: 480px) {
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
            {{-- <img src="/assets/endscoreboard.png" alt="score"> --}}
            <h4 class="score-text">{{ $score }}</h4>
        </div>


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
                <a href="/intro"><img src="/assets/restart-button.png"></a>
            </div>
            <div class="proceed-button">
                <a href="/form-submission"><img src="/assets/proceed-button.png"></a>
            </div>
        </div>
    </div>
</x-site-layout>
