<style>
    *, html {
        margin: 0 auto;
    }
    .headerContainer {
        width: 100%;
        height: 75px;
        background-color: white;
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
</style>

<div class="headerContainer">
    <header>
        <div class="logoContainer">
            <a href="../">
                <img src="../images/kod_wiz_logo_org.png">
            </a>
        </div>
        <nav>
            <div class="innerNavContainer">
                <a href="../#home" class="navItem">
                    <p>Home</p>
                </a>
                <a href="../#technology" class="navItem">
                    <p>Product</p>
                </a>
                <a href='../#feature' class="navItem">
                    <p>Features</p>
                </a>
                <a href='../tutorials' class="navItem">
                    <p>Tutorials</p>
                </a>
                <a href="../#about" class="navItem">
                    <p>About</p>
                </a>
                <a href="../#contact" class="navItem">
                    <p>Contact</p>
                </a>
                <?php if (isset($output['authorized']) && $output['authorized']) { ?>
                <a href="javascript:logout();" class="navItem">
                    <p>Logout</p>
                </a>
                <?php } else { ?>
                <a href="../dashboard/" class="navItem">
                    <p>Demo</p>
                </a>
                <?php } ?>
            </div>
        </nav>
    </header>
</div>