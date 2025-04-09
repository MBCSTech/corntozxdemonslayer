<x-site-layout>
    <style>
        .page-container {
            width: 100%;
            margin: 0 auto;
            position: relative;
            overflow-x: hidden;
        }

        .top-section {
            background-image: url('/assets/img/background1.png');
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
            background-image: url("/assets/img/background2.png");
            background-size: 100% 100%;
            background-position: top center;
            background-repeat: no-repeat;
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

        .footer {
            background-image: url("/assets/img/footer.png");
            background-size: contain;
            background-position: bottom center;
            background-repeat: no-repeat;
            width: 100%;
            position: relative;
            min-height: 94px;
            margin-top: -10px;
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

        .form-container {
            font-family: 'Poppins', sans-serif;
            border-radius: 20px;
            padding: 10px 20px;
            width: 90%;
            max-width: 430px;
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

        .snack-1 {
            position: absolute;
            right: -12%;
            top: -15px;
            transform: translateY(-50%);
            width: 27%;
            z-index: 2;
        }

        .snack-2 {
            position: absolute;
            left: -110%;
            top: 20px;
            transform: translateX(-50%);
            width: 80%;
            z-index: 2;
        }

        ::placeholder {
            color: black !important;
            opacity: 1;
        }

        ::-webkit-input-placeholder {
            color: black !important;
        }

        ::-moz-placeholder {
            color: black !important;
            opacity: 1;
        }

        :-ms-input-placeholder {
            color: black !important;
        }

        :-moz-placeholder {
            color: black !important;
            opacity: 1;
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
            font-size: 1.75rem;
            position: absolute;
            top: 73%;
            left: 56%;
            z-index: 3;
            color: #231F20;
        }

        #icNumberLabel {
            font-size: 9px
        }

    </style>

    <div class="page-container">
        <div class="top-section">
            <div class="score">
                <img src="/assets/img/score.png" alt="Score box" class="score-box">
                <h4 class="score-text">{{ $score }}</h4>
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
                            <input type="text" class="form-input" id="fullName" name="nama" placeholder="XXX XXX" value="{{ old('nama') }}">
                            <x-validation-error field="nama" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label><span>Nombor Telefon</span> (Phone Number)</label>
                        <input type="tel" class="form-input" id="phoneNumber" name="no_fon" placeholder="XXXXXXXXXX" value="{{ old('no_fon') }}">
                        <x-validation-error field="no_fon" />
                    </div>

                    <div class="form-group">
                        <label id="icNumberLabel"><span>Nombor Kad Pengenalan (IC)</span>
                            (Identification Card Number)</label>
                        <input type="text" id="icNumber" class="form-input" name="no_ic" placeholder="XXXXXXXXXX" value="{{ old('no_ic') }}">
                        <x-validation-error field="no_ic" />
                    </div>

                    <div class="receipt-section">
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

            fileUpload.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    fileName.textContent = file.name;
                    
                    // Format file size nicely
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