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
            gap: .5rem
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

        .samurai-pinko img {
            scale: 1.5;
            transform: translate(6px, -50px);
        }

        /* .start-button{
            margin-top: 5rem;
        } */
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
</x-site-layout>
