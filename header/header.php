<style>
    *, html {
        margin: 0 auto;
    }
    .headerContainer {
        width: 100% !important;
        height: 75px;
        background-color: rgba(255, 255, 255, .9);
        position: fixed;
        z-index: 1000;
        top: 0;
        box-shadow: 0px 0px 5px rgba(0,0,0,0.6);
        -moz-box-shadow: 0px 0px 5px rgba(0,0,0,0.6);
        -webkit-box-shadow: 0px 0px 5px rgba(0,0,0,0.6);
        -o-box-shadow: 0px 0px 5px rgba(0,0,0,0.6);
    }
    .logoContainer img {
        width: 90px;
    }
    .logoContainer, nav {
        display: inline-block;
        vertical-align: top;
    }
    .navItem:visited {
        color: initial;
        text-decoration: none;
    }
    .navItem {
        display: inline-block;
        position: relative;
        text-decoration: none;
        font-size: 18px;
        font-family: helvetica;
        font-weight: 400;
        margin-right: 35px;
        color: #605E5E !important;
    }
    .navItem p {
        transition: .3s;
    }
    .navItem:hover p {
        color: #b23c39;
        cursor: pointer;
    }
    header {
        height: 100%;
        width: 960px;
    }
    nav {
        position: relative;
        top: 50%;
        transform: translatey(-50%);
        right: 0;
        float: right;
    }
    .mobileMenuBtn {
        display: none;
    }


    /*Mobile Styles*/
    @media only screen and (max-width: 768px) {
        nav {
            position: absolute;
            right: 0;
            top: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .9);
        }
        header {
            height: 100%;
            width: 100% !important;
        }
        .showMenu {
            transform: none !important;
        }
        .logoContainer, nav {
            display: inline-block;
            vertical-align: top;
            float: left;
        }

        .headerContainer {
            width: 100%;
            height: 75px;
        }
        nav {
            transform: none;
            border: 2px solid #b23b3a;
            transform: translateX(100%);
            transition: .5s;
        }
        .navItem {
            display: block;
            text-decoration: none;
            font-size: 18px;
            font-family: helvetica;
            font-weight: 400;
            margin-right: 0;
            color: #605E5E !important;
            padding: 16px 0;
            font-size: 25px;
            background: white;
            text-align: right;
        }
        .navItem p {
            transition: .3s;
            padding-right: 60px;
        }
        .mobileMenuBtn {
            position: absolute;
            right: 0;
            top: 0;
            display: block;
            padding: 23px;
        }
        .mobileMenuBtn img {
            width: 26px;
        }

    }

</style>
<script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>
<script>
    var header = {
        init: function () {
            $('.innerNavContainer').click('header.closeNav');
        },

        toggleNav: function(e) {
            $('#mainNav').toggleClass('showMenu');
        },

        closeNav: function() {
            $('#mainNav').removeClass('showMenu')
        }
    };


</script>
<div style="width: 100vw !important;" class="headerContainer">
    <header>
        <div class="logoContainer">
            <a href="../">
                <img src="../images/kod_wiz_logo_org.png">
            </a>
        </div>
        <div onclick="header.toggleNav(event);" class="mobileMenuBtn">
            <img src="../images/list.png" />
        </div>
        <nav id="mainNav">
            <div class="innerNavContainer">
                <a onclick="header.closeNav()" href="../#home" class="navItem">
                    <p>Home</p>
                </a>
                <a onclick="header.closeNav()"  href="../#technology" class="navItem">
                    <p>Product</p>
                </a>
                <a onclick="header.closeNav()"  href='../#feature' class="navItem">
                    <p>Features</p>
                </a>
                <a onclick="header.closeNav()"  href='../tutorials' class="navItem">
                    <p>Tutorials</p>
                </a>
                <a onclick="header.closeNav()"  href="../#about" class="navItem">
                    <p>About</p>
                </a>
                <a onclick="header.closeNav()"  href="../#contact" class="navItem">
                    <p>Contact</p>
                </a>
                <?php if (isset($output['authorized']) && $output['authorized']) { ?>
                <a onclick="header.closeNav()"  href="javascript:logout();" class="navItem">
                    <p>Logout</p>
                </a>
                <?php } else { ?>
                <a onclick="header.closeNav()"  href="../dashboard/" class="navItem">
                    <p>Demo</p>
                </a>
                <?php } ?>
            </div>
        </nav>
    </header>
</div>