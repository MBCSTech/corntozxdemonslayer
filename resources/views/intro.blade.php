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
            gap: .5rem;
            overflow: hidden;
        }

        .masthead {
            padding: 10px 25px;
            z-index: 2;
        }

        .samurai-pinko,
        .start-button,
        .instructions {
            padding: 10px 25px;
        }

        .instructions {
            padding-bottom: 0px
        }

        .samurai-pinko img {
            scale: 1.5;
            transform: translate(6px, -50px);
        }

        /* .start-button{
            margin-top: 5rem;
        } */

        .masthead img,
        .start-button img,
        .instructions img,
        .samurai-pinko img {
            width: 100%;
            max-width: 768px;
        }

        @media only screen and (min-width: 600px) {
            .masthead {
                margin-top: 2rem
            }

            .samurai-pinko img {
                scale: 1.3;
            }

            .masthead img,
            .start-button img,
            .instructions img,
            .samurai-pinko img {
                width: 75%;
                margin: auto;
            }

            .samurai-pinko,
            .start-button,
            .instructions {
                padding: 0px 0px;
            }
        }

        .bg-desktop {
            display: none
        }

        @media only screen and (min-width: 1024px) {
            .bg {
                display: none;
            }

            .bg-desktop {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
                background-image: url('/assets/intro-bg-desktop.png');
                background-size: cover;
                background-position: center -25px;
                align-items: center;
                gap: .5rem
            }

            .masthead img,
            .samurai-pinko img {
                width: 60%;
                max-width: 1024px;
            }

            .samurai-pinko img {
                scale: 0.9
            }

            .instructions img{
                max-width: 65%;
            }


            .start-button img {
                width: 50%;
                max-width: 768px;
            }

        }

        @media only screen and (min-width: 1440px) {
            .bg-desktop{
                background-position: center -50px;
            }
        }

        @media only screen and (min-width: 1830px) {
            .bg-desktop{
                background-position: center -80px;
            }
        }

        @media only screen and (min-width: 1920px) {
            .bg-desktop{
                background-position: center -110px;
            }
        }
    </style>
    <div class="bg">
        <div class="masthead">
            <img src="/assets/masthead.png" alt="mast">
        </div>
        <div class="samurai-pinko">
            <img src="/assets/samurai-pinko.png" alt="pinko">
        </div>
        <div class="start-button pulse">
            <a href="/game"><img src="/assets/start-button.png" alt="start"></a>
        </div>
        <div class="instructions">
            <img src="/assets/instructions.png" alt="instructions">
        </div>
    </div>

    <div class="bg-desktop">
        <div class="masthead">
            <img src="/assets/masthead.png" alt="mast">
        </div>
        <div class="samurai-pinko">
            <img src="/assets/intro-samurai-pinko-desktop.png" alt="pinko">
        </div>
        <div class="start-button pulse">
            <a href="/game"><img src="/assets/start-button.png" alt="start"></a>
        </div>
        <div class="instructions">
            <img src="/assets/instructions-desktop.png" alt="instructions">
        </div>
    </div>

</x-site-layout>
