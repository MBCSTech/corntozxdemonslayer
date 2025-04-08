<x-site-layout>
    <style>
        .top-section {
            background-image: url('/assets/img/background.png');
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
    
        .banner {
            width: 85%;
            margin-top: 0;
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
            /* Added block display */
            margin-left: auto;
            /* Auto margins for horizontal centering */
            margin-right: auto;
        }
    
        .submit-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 0;
            display: block;
            /* Added block display */
            margin: 0 auto;
            /* Auto margins for horizontal centering */
        }
    
        .submit-btn img {
            width: 100%;
            max-width: 100%;
            height: auto;
            display: block;
            /* Added block display */
            margin: 0 auto;
            /* Auto margins for horizontal centering */
        }
    
        .info {
            font-family: "PoppinsExtraBold", sans-serif;
            color: #231F20;
            font-size: 2.5vw;
            margin-top: 10px;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            font-weight: 800;
            font-style: italic;
        }
    
        .disclaimer {
            font-family: "PoppinsExtraBold", sans-serif;
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
    
        @media screen and (min-width: 660px) {}
    
        @media screen and (min-width: 992px) {}
    
        @media screen and (min-width: 1120px) {}
    
        @media screen and (min-width: 1400px) {}
    </style>

    <div class="top-section">
        <img src="/assets/img/epiklogo.png" alt="Epik Slayer Logo" class="epiklogo">

        <img src="/assets/img/slay.png" alt="Sedia Untuk Terbang Ke Jepun?" class="slay">

        <div class="submit-btn-container">
            <a href="/game" class="submit-btn">
                <img src="/assets/img/mainbutton.png" alt="HANTAR & JOM TERBANG!">
            </a>
        </div>

        <h4 class="info">Lagi banyak penyertaan yang anda hantar bersama resit, <br> lagi tinggi peluang untuk menang!</h4>
        <h5 class="disclaimer"> *Peringatan: Dengan resit berbeza</h5>
    </div>
</x-site-layout>