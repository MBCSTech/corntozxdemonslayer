<x-site-layout>
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background-color: #FF6FAC;
            width: 100%;
        }

        .landing-cont {
            background-image: url('/assets/img/pink-dot-bg-mobile.png');
            background-size: cover;
            background-position: bottom center;
            background-repeat: no-repeat;
            padding-top: 60px;
        }

        .landing-cont img {
            width: 100%;
        }

        .packaging-ttl {
            margin-top: -90px;
            margin-bottom: -80px;
        }

        .packaging-ttl-desktop,
        .characters-kv-desktop,
        .chips-group-desktop {
            display: none;
        }

        .instruction-section {
            background-image: url('/assets/img/instruction-box.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            height: 60vh;
        }

        .instruction-ttl {
            width: 80% !important;
            padding: 80px 0px 10px 0px;
            display: block;
            margin: auto;
        }

        .instruction-steps {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0px 40px 20px 40px;
        }

        .instruction-steps img {
            width: calc((100% / 2) - 20px);
            margin: 0 0 0 20px;
            box-sizing: border-box;
        }

        .instruction-steps img:nth-child(1),
        .instruction-steps img:nth-child(3) {
            margin: 0px;
        }

        .prize-cont {
            position: relative;
        }

        .prize-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0px 40px 20px 40px;
            margin-top: -50px;
        }

        .prize-section img {
            width: calc((100% / 2));
            box-sizing: border-box;
        }

        /* .prize-section img:nth-child(1),
 .prize-section img:nth-child(3) {
     margin: 0px;
 } */

        .chips-group {
            position: absolute;
            bottom: 0px;
        }

        .button-wrapper {
            padding-bottom: 80px;
            margin-top: -60px;
            width: 32%;
            margin-left: auto;
            margin-right: auto;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .pulse {
            animation: pulse 1.5s ease-in-out infinite;
        }

        @media only screen and (max-width: 380px) {
            .instruction-section {
                height: 64vh;
            }
        }

        @media only screen and (max-width: 365px) {
            .instruction-section {
                height: 56vh;
            }
        }

        @media only screen and (min-width: 660px) {

            .instruction-steps {
                padding: 20px 80px 20px 80px;
            }

            .instruction-section {
                height: 82vh;
            }
        }

        @media only screen and (min-width: 880px) {

            .landing-cont {
                background-image: url('/assets/img/dot-background-desktop.png');
                padding-top: 60px;
            }

            .packaging-ttl,
            .characters-kv,
            .chips-group {
                display: none;
            }

            .packaging-ttl-desktop,
            .characters-kv-desktop,
            .chips-group-desktop {
                display: block;
            }

            .packaging-ttl-desktop {
                margin-top: -24%;
                margin-bottom: -11%;
            }

            .instruction-section {
                background-image: url('/assets/img/instruction-box-desktop.png');
                height: 47vh;
                background-size: cover;
            }

            .instruction-ttl {
                width: 32% !important;
                padding: 12% 0px 10px 0px;
            }

            .instruction-steps {
                padding: 20px 12% 20px 12%;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 30px;
                align-items: end;
                /* width: 78%;
         margin: 0 auto; */
            }

            .instruction-steps img {
                width: 100%;
                margin: 0px;
                box-sizing: border-box;
            }

            .chips-group-desktop {
                position: absolute;
                bottom: 0px;
            }

            .prize-section {
                padding: 0px 120px 20px 120px;
                /* width: 78%; */
                margin: -10% auto 0 auto;
            }

            .prize-section img {
                width: calc((100% / 4));
                box-sizing: border-box;
            }

            .button-wrapper {
                padding-bottom: 80px;
                margin-top: -50px;
                width: 32%;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media only screen and (min-width: 992px) {
            .instruction-section {
                background-image: url('/assets/img/instruction-box-desktop.png');
                height: 56vh;
            }
        }

        @media only screen and (min-width: 1200px) {
            .instruction-section {
                background-image: url('/assets/img/instruction-box-desktop.png');
                height: 68vh;
            }
        }

        @media only screen and (min-width: 1400px) {
            .instruction-section {
                background-image: url('/assets/img/instruction-box-desktop.png');
                height: 92vh;
            }
        }
    </style>

    <div class="landing-cont">
        <div>
            <img class="characters-kv" src="assets/img/characters-kv.png" />
            <img class="characters-kv-desktop" src="assets/img/characters-kv-desktop.png" />
            <img class="packaging-ttl" src="assets/img/packaging-ttl.png" />
            <img class="packaging-ttl-desktop" src="assets/img/packaging-ttl-desktop.png" />
            <div class="instruction-section">
                <img class="instruction-ttl" src="assets/img/instruction-ttl.png" />
                <div class="instruction-steps">
                    <img src="assets/img/step-1.png" />
                    <img src="assets/img/step-2.png" />
                    <img src="assets/img/step-3.png" />
                    <img src="assets/img/step-4.png" />
                </div>
            </div>
            <div class="prize-cont">
                <div class="prize-section">
                    <img src="assets/img/prize-1-desktop.png" />
                    <img src="assets/img/prize-2-desktop.png" />
                    <img src="assets/img/prize-3-desktop.png" />
                    <img src="assets/img/prize-4-desktop.png" />
                </div>
                <img class="chips-group" src="assets/img/chips-group.png" />
                <img class="chips-group-desktop" src="assets/img/chips-group-desktop.png" />
            </div>
            <div class="button-wrapper">
                <a href="/intro"><img class="main-button pulse" src="assets/img/main-button.png"></a>
            </div>
        </div>
    </div>
</x-site-layout>
