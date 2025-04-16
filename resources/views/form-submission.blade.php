<x-site-layout>
    <style>
        .page-container {
            width: 100%;
            margin: 0 auto;
            position: relative;
            overflow-x: hidden;
        }

        .top-section {
            background-image: url('/assets/img/background1-mobile.png');
            background-size: 100%;
            background-position: top center;
            background-repeat: no-repeat;
            width: 100%;
            padding-top: 0;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 600px;
            padding-bottom: 120px;
        }

        .bottom-section {
            background-image: url("/assets/img/background2-mobile.png");
            background-size: 100% 100%;
            background-position: top center;
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 500px;
            z-index: 1;
            margin-top: -32%;
            padding-bottom: 20px;
            padding-top: 20px;
        }

        .score-box {
            width: 85%;
            max-width: 600px;
            margin-top: 30%;
            position: relative;
            z-index: 2;
            margin-left: auto;
            margin-right: auto;
        }

        .winner {
            width: 85%;
            max-width: 600px;
            margin-top: 0%;
            position: relative;
            z-index: 2;
        }

        .japan {
            width: 80%;
            max-width: 500px;
            margin-top: 17%;
            position: relative;
            z-index: 2;
        }

        .daftarsekarang {
            font-family: 'PoppinsExtraBold', sans-serif;
            font-weight: 800;
            font-size: 13px;
            color: black;
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0 5px;
            width: 90%;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        ::placeholder {
            color: lightgray !important;
            opacity: 1;
        }

        .form-container {
            font-family: 'Poppins', sans-serif;
            border-radius: 20px;
            padding: 10px 20px;
            width: 90%;
            max-width: 550px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
            position: relative;
        }

        .form-input {
            font-weight: 400;
            width: 100%;
            padding: 25px;
            border-radius: 50px;
            border: none;
            background-color: white;
            font-size: 11px;
            outline: none;
            transition: box-shadow 0.3s ease;
        }

        .form-input:focus {
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
        }

        .form-group label {
            font-weight: 400;
            position: absolute;
            left: 25px;
            top: 12px;
            color: #B4B4B4;
            font-size: 11px;
            pointer-events: none;
            font-weight: normal;
        }

        .form-group input {
            padding-top: 30px;
            padding-bottom: 10px;
            color: #000000;
        }

        /*Corn Snack Part*/
        .receipt-section .input-container {
            position: relative;
        }

        .input-container .snack-1 {
            display: block;
            position: absolute;
            right: -45px;
            bottom: 10px;
            width: 90px;
            height: auto;
            z-index: 10;
        }

        .receipt-section .snack-2 {
            display: block;
            position: absolute;
            left: -45px;
            top: 60px;
            width: 100px;
            height: auto;
            z-index: 10;
        }

        .input-container .snack1-desktop {
            display: none;
        }

        .receipt-section .snack2-desktop {
            display: none;
        }

        .receipt-section {
            background-color: white;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            width: 100%;
            gap: 3px;
            position: relative;
            padding: 20px 0;
        }

        .receipt-icon {
            width: 70px;
            height: 80px;
            margin-right: 15px;
            padding-left: 10px;
        }

        .receipt-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .receipt-content {
            display: flex;
            flex-direction: column;
            gap: 1px;
            position: relative;
        }

        .receipt-title {
            font-weight: 400;
            color: #B4B4B4;
            font-size: 14px;
            margin-bottom: 3px;
            line-height: 1.4;
            text-align: left;
        }

        .custom-upload-btn {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            background-color: transparent;
            border: none;
            transition: background-color 0.3s;
        }

        .custom-upload-icon {
            width: 100%;
            height: 100%;
            max-width: 110px;
        }

        .submit-btn-container {
            width: 100%;
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        .submit-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 0;
        }

        .submit-btn img {
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        .error-popup {
            display: none;
            position: absolute;
            top: 100%;
            left: 20px;
            right: 20px;
            background-color: white;
            border-radius: 15px;
            padding: 8px 12px;
            margin-top: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
            text-align: left;
            color: #ff0000;
            font-weight: 400;
            font-size: 12px;
        }

        .error-popup::before {
            content: "";
            position: absolute;
            top: -6px;
            left: 20px;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid white;
        }

        #fileErrorPopup {
            top: 100%;
            left: 0;
            right: 0;
            margin-top: 5px;
        }

        .file-info {
            margin-top: 8px;
            font-weight: 400;
            color: #333333;
            font-size: 12px;
            text-align: left;
            background-color: #f0f0f0;
            padding: 8px 16px;
            border-radius: 15px;
            display: none;
            word-break: break-all;
        }

        .file-name {
            font-weight: 700;
            margin-right: 5px;
        }

        .file-size {
            color: #666666;
            font-size: 0.8rem;
        }

        label>span,
        .receipt-title>span {
            font-family: "PoppinsExtraBold", sans-serif;
        }

        .score {
            position: relative;
        }

        .score-text {
            font-family: 'PoppinsBlackItalic', sans-serif;
            font-size: 1.35rem;
            position: absolute;
            top: 74%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            color: #231F20;
        }

        #icNumberLabel {
            font-size: 9px
        }


        @media screen and (max-width: 320px) {
            .input-container .snack-1 {
                width: 70px;
                right: -36px;
                bottom: 30%;
            }

            .receipt-section .snack-2 {
                width: 80px;

            }
        }

        @media screen and (min-width: 481px) and (max-width: 659px) {
            .daftarsekarang {
                font-size: calc(14px + (1) * ((100vw - 481px) / (660 - 481)));
            }

            .receipt-section .input-container {
                position: relative;
            }

            .input-container .snack-1 {
                display: none;

            }

            .receipt-section .snack-2 {
                display: none;
            }

            .input-container .snack1-desktop {
                display: block;
                position: absolute;
                right: -75px;
                bottom: -15px;
                width: 120px;
                height: auto;
                z-index: 10;
            }

            .receipt-section .snack2-desktop {
                display: block;
                position: absolute;
                left: -75px;
                top: 20px;
                width: 140px;
                height: auto;
                z-index: 10;
            }

            .score-text {
                font-size: calc(1.2rem + 0.7vw);
                top: 75%
            }
        }


        @media screen and (min-width: 660px) and (max-width: 879px) {
            .bottom-section {
                margin-top: -20%;
                padding-bottom: 40px;
            }

            .daftarsekarang {
                font-size: calc(15px + (1) * ((100vw - 660px) / (880 - 660)));
            }

            .form-container {
                width: 90%;
            }

            .receipt-section .input-container {
                position: relative;
            }

            .input-container .snack-1 {
                display: none;

            }

            .receipt-section .snack-2 {
                display: none;
            }

            .input-container .snack1-desktop {
                display: block;
                position: absolute;
                right: -75px;
                bottom: -15px;
                width: 120px;
                height: auto;
                z-index: 10;
            }

            .receipt-section .snack2-desktop {
                display: block;
                position: absolute;
                left: -75px;
                top: 20px;
                width: 140px;
                height: auto;
                z-index: 10;
            }

            .score-text {
                font-size: calc(1.3rem + 0.5vw);
                top: 75%
            }
        }

        @media screen and (min-width: 880px) and (max-width: 991px) {
            .top-section {
                padding-bottom: 400px;
            }

            .score-box {
                width: 90%;
            }

            .winner {
                width: 90%;
            }

            .bottom-section {
                margin-top: -40%;
                padding-bottom: 100px;
            }

            .daftarsekarang {
                font-size: calc(16px + (1) * ((100vw - 880px) / (992 - 880)));
            }


            .receipt-section .input-container {
                position: relative;
            }

            .input-container .snack-1 {
                display: none;

            }

            .receipt-section .snack-2 {
                display: none;
            }

            .input-container .snack1-desktop {
                display: block;
                position: absolute;
                right: -75px;
                bottom: -15px;
                width: 120px;
                height: auto;
                z-index: 10;
            }

            .receipt-section .snack2-desktop {
                display: block;
                position: absolute;
                left: -75px;
                top: 20px;
                width: 140px;
                height: auto;
                z-index: 10;
            }

            .score-text {
                font-size: calc(1.5rem + 0.5vw);
                top: 75%
            }
        }

        /* Desktop */
        @media screen and (min-width: 992px) {
            .page-container {
                position: relative;
                overflow: hidden;
                width: 100%;
                max-width: 100%;
                display: flex;
                flex-direction: column;
            }

            .top-section {
                background-image: url('assets/img/background1-desktop.jpg');
                background-position: top center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
                width: 100%;
                /*min-height: 100vh;*/
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                padding-left: 8%;
                z-index: 1;
            }

            .score {
                margin-top: 40px;
                width: 40%;
                align-self: flex-start;
            }

            .winner {
                width: 35%;
                align-self: flex-start;
            }

            .bottom-section {
                background-image: url('assets/img/background2-desktop.png');
                background-position: bottom right;
                background-repeat: no-repeat;
                background-size: contain;
                position: absolute;
                width: 60%;
                /*min-height: 100vh;*/
                right: 0;
                bottom: 0;
                z-index: 2;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                padding-top: 0;
                padding-right: 14%;
            }

            .japan {
                margin-top: 210px;
                width: 50%;
                z-index: 3;
                align-self: flex-end;
            }

            .daftarsekarang {
                font-family: 'PoppinsExtraBoldItalic';
                font-size: calc(8.5px + (13 - 10.5) * ((100vw - 1121px) / (1400 - 1121)));
                margin-top: 5px;
                display: inline-block;
                white-space: nowrap;
                width: auto;
                z-index: 3;
                text-align: center;
                margin-right: 1%;

            }

            .form-container {
                max-width: 55%;
                position: relative;
                z-index: 3;
                align-self: flex-end;
                margin-right: -3%;
                padding-bottom: 5px;
            }

            .form-input {
                font-size: 11px;
            }

            .form-group label {
                font-size: 11px;
                top: 14px;
            }

            .receipt-section .input-container {
                position: relative;
            }

            .input-container .snack-1 {
                display: none;

            }

            .receipt-section .snack-2 {
                display: none;
            }

            .input-container .snack1-desktop {
                display: block;
                position: absolute;
                right: -60px;
                bottom: -5px;
                width: 90px;
                height: auto;
                z-index: 10;
            }

            .receipt-section .snack2-desktop {
                display: block;
                position: absolute;
                left: -60px;
                top: 30px;
                width: 100px;
                height: auto;
                z-index: 10;
            }
        }

        @media screen and (min-width: 1121px) {
            .page-container {
                position: relative;
                overflow: hidden;
                width: 100%;
                max-width: 100%;
                display: flex;
                flex-direction: column;
            }

            .top-section {
                background-image: url('assets/img/background1-desktop.jpg');
                background-position: top center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
                /*min-height: 100vh;*/
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                padding-left: 11%;
                z-index: 1;
            }

            .score {
                margin-top: 40px;
                width: 40%;
                align-self: flex-start;
            }

            .winner {
                width: 35%;
                align-self: flex-start;
            }

            .bottom-section {
                background-image: url('assets/img/background2-desktop.png');
                background-position: bottom right;
                background-repeat: no-repeat;
                background-size: contain;
                position: absolute;
                width: 60%;
                /*min-height: 100vh;*/
                right: 0;
                bottom: 0;
                z-index: 2;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                padding-top: 0;
                padding-right: 11%;
            }

            .japan {
                margin-top: 210px;
                width: 55%;
                z-index: 3;
                align-self: flex-end;
            }

            .daftarsekarang {
                font-family: 'PoppinsExtraBoldItalic';
                font-size: calc(10px + (13 - 10.5) * ((100vw - 1121px) / (1400 - 1121)));
                margin-top: 5px;
                display: inline-block;
                white-space: nowrap;
                width: auto;
                z-index: 3;
                text-align: center;
                margin-right: 1%;

            }

            .form-container {
                max-width: 60%;
                position: relative;
                z-index: 3;
                align-self: flex-end;
                margin-right: -3%;
                padding-bottom: 10px;
            }

            .form-input {
                font-size: 12px;
            }

            .form-group label {
                font-size: 12px;
                top: 14px;
            }

            .receipt-section .input-container {
                position: relative;
            }

            .input-container .snack-1 {
                display: none;

            }

            .receipt-section .snack-2 {
                display: none;
            }

            .input-container .snack1-desktop {
                display: block;
                position: absolute;
                right: -60px;
                bottom: -5px;
                width: 90px;
                height: auto;
                z-index: 10;
            }

            .receipt-section .snack2-desktop {
                display: block;
                position: absolute;
                left: -60px;
                top: 30px;
                width: 100px;
                height: auto;
                z-index: 10;
            }
        }

        @media screen and (min-width: 1400px) {
            .page-container {
                position: relative;
                overflow: hidden;
                width: 100%;
                max-width: 100%;
                display: flex;
                flex-direction: column;
            }

            .top-section {
                background-image: url('assets/img/background1-desktop.jpg');
                background-position: top center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
                min-height: 100vh;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                padding-left: 11%;
                z-index: 1;
            }

            .score {
                margin-top: 40px;
                width: 40%;
                align-self: flex-start;
            }

            .winner {
                width: 35%;
                align-self: flex-start;
            }

            .bottom-section {
                background-image: url('assets/img/background2-desktop.png');
                background-position: bottom right;
                background-repeat: no-repeat;
                background-size: contain;
                position: absolute;
                min-height: 100vh;
                right: 0;
                bottom: 0;
                z-index: 2;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                padding-top: 0;
                padding-right: 8%;
            }

            .japan {
                margin-top: 120px;
                width: 67%;
                z-index: 3;
                align-self: flex-end;
            }

            .daftarsekarang {
                font-family: 'PoppinsExtraBoldItalic';
                font-size: 16px;
                margin-top: 5px;
                display: inline-block;
                white-space: nowrap;
                width: auto;
                z-index: 3;
                text-align: center;
                margin-right: 2%;

            }

            .form-container {
                max-width: 80%;
                width: 500px;
                position: relative;
                z-index: 3;
                align-self: flex-end;
                margin-right: 0%;
                padding-bottom: 15px;
            }

            .form-input {
                font-size: 14px;
            }

            .form-group label {
                font-size: 13px;
                top: 14px;
            }

            .receipt-section .input-container {
                position: relative;
            }

            .input-container .snack-1 {
                display: none;

            }

            .receipt-section .snack-2 {
                display: none;
            }

            .input-container .snack1-desktop {
                display: block;
                position: absolute;
                right: -85px;
                bottom: -10px;
                width: 130px;
                height: auto;
                z-index: 10;
            }

            .receipt-section .snack2-desktop {
                display: block;
                position: absolute;
                left: -100px;
                top: 20px;
                width: 150px;
                height: auto;
                z-index: 10;
            }

            .score-text {
                font-size: calc(1rem + 0.5vw);
                top: 75%;
            }
        }
    </style>

    <div class="page-container">
        <div class="top-section">
            <div class="score">
                <img src="/assets/img/score.png" alt="Score box" class="score-box">
                <h4 class="score-text">Skor anda: {{ $score }}</h4>
            </div>
            <img src="/assets/img/winner.png" alt="Winner" class="winner">
        </div>

        <div class="bottom-section">
            <img src="/assets/img/japan.png" alt="Japan Prize" class="japan">

            <div class="daftarsekarang">Daftar Sekarang dan Mulakan Pengembaraan Anda!</div>

            <div class="form-container">
                <form id="myForm" method="POST" action="{{ route('player.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label><span>Nama Penuh</span> (Full Name)</label>
                        <div class="input-container">
                            <input type="text" class="form-input" id="fullName" name="nama"
                                placeholder="Aisyah binti Ahmad" value="{{ old('nama') }}">
                            <x-validation-error field="nama" />
                            <img src="/assets/img/snack1.1.png" class="snack-1">
                            <img src="/assets/img/snack1-desktop.png" class="snack1-desktop">
                        </div>
                    </div>

                    <div class="form-group">
                        <label><span>Nombor Telefon</span> (Phone Number)</label>
                        <input type="tel" class="form-input" id="phoneNumber" name="no_fon" maxlength="11"
                            placeholder="012-3456789" value="{{ old('no_fon') }}">
                        <x-validation-error field="no_fon" />
                    </div>

                    <div class="form-group">
                        <label id="icNumberLabel"><span>Nombor Kad Pengenalan (IC)</span>
                            (Identification Card Number)</label>
                        <input type="text" id="icNumber" class="form-input" name="no_ic" maxlength="12"
                            placeholder="123456789123" value="{{ old('no_ic') }}">
                        <x-validation-error field="no_ic" />
                    </div>

                    <div class="receipt-section">
                        <img src="/assets/img/snack1.2.png" class="snack-2">
                        <img src="/assets/img/snack2-desktop.png" class="snack2-desktop">
                        <div class="receipt-icon">
                            <img src="/assets/img/receipticon.png" alt="Receipt Icon">
                        </div>
                        <div class="receipt-content">
                            <p class="receipt-title"><span>Resit Pembelian</span>
                                <br>Muat Naik Resit anda
                            </p>

                            <div class="input-container">
                                <input type="file" id="fileUpload" name="receipt" class="upload-btn"
                                    accept=".jpg, .jpeg, .png, .pdf"
                                    title="Please attach your receipt. Sila lampirkan resit anda."
                                    style="display: none;">
                            </div>

                            <label for="fileUpload" class="custom-upload-btn">
                                <img src="/assets/img/uploadicon.png" alt="Upload" class="custom-upload-icon">
                            </label>

                            <div class="file-info" id="fileInfo">
                                <span class="file-name" id="fileName"></span> <br>
                                <span class="file-size" id="fileSize"></span>
                            </div>
                            <x-validation-error field="receipt" />
                        </div>
                    </div>

                    <div class="submit-btn-container">
                        <button type="submit" class="submit-btn">
                            <img src="/assets/img/submitbutton.png" alt="HANTAR & JOM TERBANG!">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileUpload = document.getElementById('fileUpload');
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            const maxStartChars = 12; // Characters to show from the beginning
            const maxEndChars = 6; // Characters to show from the end (before extension)
            const ellipsis = "..."; // The ellipsis style

            fileUpload.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    let displayName = file.name;
                    const lastDotIndex = displayName.lastIndexOf('.');
                    const extension = lastDotIndex !== -1 ? displayName.substring(lastDotIndex) : '';
                    const nameWithoutExt = displayName.substring(0, lastDotIndex !== -1 ? lastDotIndex :
                        displayName.length);

                    if (nameWithoutExt.length > maxStartChars + maxEndChars + ellipsis.length) {
                        const startPart = nameWithoutExt.substring(0, maxStartChars);
                        const endPart = maxEndChars > 0 ? nameWithoutExt.substring(nameWithoutExt.length -
                            maxEndChars) : '';

                        if (maxEndChars > 0) {
                            displayName = startPart + ellipsis + endPart + extension;
                        } else {
                            displayName = startPart + ellipsis + extension;
                        }
                    }

                    fileName.textContent = displayName;

                    let size = file.size;
                    const units = ['B', 'KB', 'MB', 'GB'];
                    let unitIndex = 0;

                    while (size > 1024 && unitIndex < units.length - 1) {
                        size /= 1024;
                        unitIndex++;
                    }

                    fileSize.textContent = Math.round(size * 100) / 100 + ' ' + units[unitIndex];
                    fileInfo.style.display = 'block';
                } else {
                    fileInfo.style.display = 'none';
                }
            });
        });
    </script>
</x-site-layout>
