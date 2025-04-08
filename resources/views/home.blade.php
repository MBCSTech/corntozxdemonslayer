<x-site-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FF6FAC;
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

        .instruction-section {
            background-image: url('/assets/img/instruction-box.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            height: 52vh;
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

        .main-button {
            width: 75% !important;
            display: block;
            margin: auto;
            margin-top: -60px;
            padding-bottom: 60px;
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
    </style>

    <div class="landing-cont">
        <div>
            <img src="assets/img/characters-kv.png" />
            <img class="packaging-ttl" src="assets/img/packaging-ttl.png" />
            <div class="instruction-section">
                <img class="instruction-ttl" src="assets/img/instruction-ttl.png" />
                <div class="instruction-steps">
                    <img src="assets/img/inst-step-1.png" />
                    <img src="assets/img/inst-step-2.png" />
                    <img src="assets/img/inst-step-3.png" />
                    <img src="assets/img/inst-step-4.png" />
                </div>
            </div>
            <div class="prize-cont">
                <div class="prize-section">
                    <img src="assets/img/prize-1.png" />
                    <img src="assets/img/prize-2.png" />
                    <img src="assets/img/prize-3.png" />
                    <img src="assets/img/prize-4.png" />
                </div>
                <img class="chips-group" src="assets/img/chips-group.png" />
            </div>
            <a href="/game"><img class="main-button" src="assets/img/main-button.png" /></a>
        </div>
    </div>
</x-site-layout>
