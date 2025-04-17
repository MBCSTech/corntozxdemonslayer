<style>

    .navbars input[type="checkbox"],
    .navbars .hamburger-lines {
        display: none;
    }

    .container {
        max-width: 1200px;
        width: 58%;
        margin: auto;
    }

    .navbars {
        position: fixed;
        width: 100%;
        background: #E94A93;
        color: #FFFFFF;
        z-index: 100;
    }

    .navbars a{
        font-family: 'PoppinsBlack', sans-serif;
        
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        height: 85px;
        align-items: center;
    }

    .menu-items {
        order: 2;
        display: flex;
    }

    .logo {
        order: 1;
        width: 23%;
    }

    .menu-items li {
        list-style: none;
        margin-left: 0;
        margin-right: 0;
        font-size: 1rem;
        background-color: #E94A93;
        padding: 8px 0;
        padding-right: 5px;
        padding-left: 60px;
        border-radius: 20px;
    }

    .menu-items li:nth-child(2),
    .menu-items li:nth-child(3) {
        padding-left: 10px;
    }

    .menu-items {
        order: 2;
        display: flex;
    }

    .navbars a {
        color: #FFFFFF;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease-in-out;
        display: flex;
        align-items: center;
    }


    .navbar-icons {
        width: 10%;
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .container {
            max-width: 1200px;
            width: 90%;
            margin: auto;
        }

        .navbar-container input[type="checkbox"],
        .navbar-container .hamburger-lines {
            display: block;
        }

        .navbar-container {
            display: block;
            position: relative;
            height: 64px;
        }

        .navbar-container input[type="checkbox"] {
            position: absolute;
            display: block;
            height: 32px;
            width: 30px;
            top: 20px;
            left: 20px;
            z-index: 5;
            opacity: 0;
            cursor: pointer;
        }

        .navbar-container .hamburger-lines {
            display: block;
            height: 28px;
            width: 35px;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .navbar-container .hamburger-lines .line {
            display: block;
            height: 4px;
            width: 100%;
            border-radius: 10px;
            background: #F7B81C;
        }

        .navbar-container .hamburger-lines .line1 {
            transform-origin: 0% 0%;
            transition: transform 0.3s ease-in-out;
        }

        .navbar-container .hamburger-lines .line2 {
            transition: transform 0.2s ease-in-out;
        }

        .navbar-container .hamburger-lines .line3 {
            transform-origin: 0% 100%;
            transition: transform 0.3s ease-in-out;
        }

        .navbars .menu-items {
            padding-top: 100px;
            background: #FF6FA9;
            height: 100vh;
            max-width: 300px;
            transform: translate(-150%);
            display: flex;
            flex-direction: column;
            margin-left: -40px;
            padding-left: 40px;
            padding-right: 20px;
            transition: transform 0.5s ease-in-out;
            overflow: scroll;
        }

        .navbars .menu-items li {
            margin-bottom: 1.8rem;
            font-size: 14px;
            font-weight: 500;
            padding: 15px 0px;
            padding-left: 30px;
            border-radius: 30px;
            margin-bottom: 10px;

        }

        .logo {
            position: absolute;
            top: 10px;
            right: 15px;
            width: 25%;
            min-width: 160px;
            max-width: 300px;
        }

        .navbar-container input[type="checkbox"]:checked~.menu-items {
            transform: translateX(0);
        }

        .navbar-container input[type="checkbox"]:checked~.hamburger-lines .line1 {
            transform: rotate(45deg);
        }

        .navbar-container input[type="checkbox"]:checked~.hamburger-lines .line2 {
            transform: scaleY(0);
        }

        .navbar-container input[type="checkbox"]:checked~.hamburger-lines .line3 {
            transform: rotate(-45deg);
        }

        .navbar-icons {
            width: 10%;
            margin-right: 8px;
        }

        .menu-items li:nth-child(3) .navbar-icons {
            width: 8%;
        }
    }

    @media (max-width: 500px) {
        .navbar-container input[type="checkbox"]:checked~.logo {
            display: none;
        }
    }

    @media screen and (min-width: 769px) and (max-width: 992px) {
        .container {
            width: 92%;
        }

        .navbars .menu-items li {
            font-size: 0.8rem;
            padding-left: 20px;
        }
    }

    @media screen and (min-width: 993px) and (max-width: 1200px) {
        .container {
            width: 90%;
        }

        .navbars .menu-items li {
            font-size: 0.9rem;
            padding-left: 40px;
        }
    }

    @media screen and (min-width: 1201px) and (max-width: 1300px) {
        .container {
            width: 78%;
        }

        .navbars .menu-items li {
            font-size: 1rem;
            padding-left: 40px;
        }
    }

    @media screen and (min-width: 1301px) and (max-width: 1400px) {
        .container {
            width: 75%;
        }

        .navbars .menu-items li {
            font-size: 1rem;
            padding-left: 50px;
        }
    }
</style>

<nav class="navbars">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li><a href="#"><img class="navbar-icons" src='/assets/img/info-logo.png' />TENTANG CORNTOZ</a></li>
            <li><a href="/intro"><img class="navbar-icons" src='/assets/img/pen-logo.png' />MAIN SEKARANG</a></li>
            <li><a href="#"><img class="navbar-icons" src='/assets/img/file-logo.png' />TERMA & SYARAT</a></li>
        </ul>
        <img src="/assets/img/navbar-logo.png" class="logo" />
    </div>
</nav>
