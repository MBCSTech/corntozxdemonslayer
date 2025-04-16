<x-site-layout>
    <style>
        .navbars {
            position: sticky;
        }

        .top-section {
            background-image: url('/assets/img/background-confirm-mobile.png');
            background-size: 100% 100%;
            background-position: top center;
            background-repeat: no-repeat;
            width: 100%;
            padding-top: 0;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .epiklogo {
            width: 85%;
            margin-top: 24%;
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .slay {
            width: 90%;
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .submit-btn-container {
            width: 80%;
            margin-top: 15px;
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .submit-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 0;
            display: block;
            margin: 0 auto;
        }

        .submit-btn img {
            width: 100%;
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .info {
            font-family: "PoppinsExtraBoldItalic", sans-serif;
            color: #231F20;
            font-size: 2.5vw;
            margin-top: 10px;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            font-weight: 800;
            font-style: italic;
            display: block;
        }

        .info-dekstop {
            display: none;
        }

        .disclaimer {
            font-family: "PoppinsExtraBoldItalic", sans-serif;
            color: #231F20;
            font-size: 2.5vw;
            margin-top: 10px;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 10px;
            text-align: center;
            font-weight: 800;
            font-style: italic;
        }

        @media screen and (min-width: 660px) {
            .epiklogo {
                margin-top: 10%;
            }
        }

        @media screen and (min-width: 992px) {
            .top-section {
                background-image: url('/assets/img/background-confirm-dekstop.png');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
            }

            .epiklogo {
                width: 30%;
                margin-top: 6%;
            }

            .slay {
                width: 29%;
                position: relative;
            }

            .submit-btn-container {
                width: 38%;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            }

            .info {
                display: none;
            }

            .info-dekstop {
                font-family: "PoppinsExtraBoldItalic", sans-serif;
                color: #231F20;
                font-size: 1.1vw;
                margin-top: 10px;
                max-width: 90%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                font-weight: 800;
                font-style: italic;
                display: block;
            }

            .disclaimer {
                font-size: 1.1vw;
            }
        }

        @media screen and (min-width: 1121px) {
            .top-section {
                background-image: url('/assets/img/background-confirm-dekstop.png');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
            }

            .epiklogo {
                width: 32%;
                margin-top: 6%;
            }

            .slay {
                width: 30%;
                position: relative;
            }

            .submit-btn-container {
                width: 48%;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            }

            .info {
                display: none;
            }

            .info-dekstop {
                font-family: "PoppinsExtraBoldItalic", sans-serif;
                color: #231F20;
                font-size: 1.1vw;
                margin-top: 10px;
                max-width: 90%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                font-weight: 800;
                font-style: italic;
                display: block;
            }

            .disclaimer {
                font-size: 1.1vw;
                padding-bottom: 10px;
            }
        }
    </style>

    <div class="top-section">
        <img src="/assets/img/epiklogo.png" alt="Epik Slayer Logo" class="epiklogo">

        <img src="/assets/img/slay.png" alt="Sedia Untuk Terbang Ke Jepun?" class="slay">

        <div class="submit-btn-container">
            <a href="/intro" class="submit-btn">
                <img src="/assets/img/mainbutton.png">
            </a>
            <a href="/" class="submit-btn">
                <img src="/assets/img/laman-utama-btn.png">
            </a>
        </div>

        <h4 class="info">Lagi banyak penyertaan yang anda hantar bersama resit, <br> lagi tinggi peluang untuk menang!
        </h4>
        <h4 class="info-dekstop">Lagi banyak penyertaan yang anda hantar bersama resit, lagi tinggi peluang untuk
            menang!</h4>
        <h5 class="disclaimer"> *Peringatan: Dengan resit berbeza</h5>
    </div>
</x-site-layout>
