<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" sizes="300x300" href="./images/kod_wiz_logo_org.png">
    <title>KodWiz</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src='./main.js'></script>
    <link rel='stylesheet' href='./style.css' />
  </head>
  <body>
    <?php require('./header/header.php'); ?>
    <div onclick='window.open("../login", target="_self");' class='demoContainer hover'>
      <p>Launch KodWiz</p>
    </div>
    <div class='landingPage'>
      <video autoplay playsinline muted loop>
        <source src="./images/bay_video.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
<!--      <header>-->
<!--        <div class='logoContainer'>-->
<!--          <img src='./images/kod_wiz_logo.png' />-->
<!--        </div>-->
<!--        <nav>-->
<!--          <div class='innerNavContainer'>-->
<!--            <div onclick='smoothScroll("home")' class='navItem'>-->
<!--              <p>Home</p>-->
<!--            </div>-->
<!--            <div onclick='smoothScroll("technology")' class='navItem'>-->
<!--              <p>Product</p>-->
<!--            </div>-->
<!--            <div onclick='smoothScroll("feature")' class='navItem'>-->
<!--              <p>Features</p>-->
<!--            </div>-->
<!--            <div onclick='window.open("../tutorials", target="_self")' class='navItem'>-->
<!--              <p>Tutorials</p>-->
<!--            </div>-->
<!--            <div onclick='smoothScroll("about")' class='navItem'>-->
<!--              <p>About</p>-->
<!--            </div>-->
<!--            <div onclick='smoothScroll("contact")' class='navItem'>-->
<!--              <p>Contact</p>-->
<!--            </div>-->
<!--            <div onclick='window.open("../login", target="_self");' class='navItem'>-->
<!--              <p>Demo</p>-->
<!--            </div>-->
<!--          </div>-->
<!--        </nav>-->
<!--      </header>-->
      <div id="newOffer" onclick="smoothScroll('contact')" class="newlyOfferingContainer">
        <p>Now offering offsite ABAP SAP development!</p>
      </div>
      <div id='home' class='landingPageContent'>
        <div class='centeringDiv'>
          <h1>FIRST TRULY INTELLIGENT ABAP WIZARD</h1>
        </div>
      </div>
    <div onclick='smoothScroll("technology");' class='arrowIcon'>
        <!-- icon credit https://fontawesome.com/icons/chevron-down?style=solid&from=io -->
        <img src='./images/chevron-down.png' />
    </div>
    </div>
    <div id='technology' class='technologySection'>
      <h2>OUR TECHNOLOGY</h2>
      <div class='attributeContainer'>
        <div class='singleAttribute'>
          <div class='attrTitle'>
            <p><span>01 / </span>INTELLIGENT</p>
          </div>
          <div class='attrContent'>
            <p>KodWiz generates predictable and repetitive parts of code. It also automatically creates technical documentation of the generated program in MS Word format.</p>
          </div>
        </div>
        <div class='singleAttribute'>
          <div class='attrTitle'>
            <p><span>02 / </span>FAST</p>
          </div>
          <div class='attrContent'>
            <p>Boosts productivity by at least 50% compared to writing code from scratch. With KodWiz, developers can deliver 2 new objects every week, instead of 2 to 4 objects per month.</p>
          </div>
        </div>
        <div class='singleAttribute'>
          <div class='attrTitle'>
            <p><span>03 / </span>POWERFUL</p>
          </div>
          <div class='attrContent'>
            <p>Kodwiz generates intermediate code that can be quickly edited due to clean architecture. Developers with all levels of experience will increase productivity and avoid tedious tasks. </p>
          </div>
        </div>
      </div>
      <!--<div class='pleaseContain hidden-small'>-->
        <!--<div style="width: 860px; position: relative; height: 760px; left: 50%; transform: translateX(-50%);" class="s_BIwzIGroupSkin" id="comp-iocoqb1m">-->
          <!--<div id="comp-iocoqb1minlineContent" class="s_BIwzIGroupSkininlineContent">-->
            <!--<div style="left: 0px; position: absolute; top: 0px; width: 860px; height: 819px;" data-exact-height="819" data-content-padding-horizontal="0" data-content-padding-vertical="0" title="" class="wp2" id="comp-iobc5w87">-->
                <!--<div data-style="" class="wp2img" id="comp-iobc5w87img" style="position: relative; width: 860px; height: 819px;"><img id="comp-iobc5w87imgimage" alt="" data-type="image" style="width: 860px; height: 819px; object-fit: cover;" src="./images/computer.png"></div>-->
            <!--</div>-->
            <!--<style type="text/css" data-styleid="wp2">.wp2_zoomedin {-->
              <!--cursor:url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_out.png), url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_out.cur), auto;overflow:hidden;display:block;}-->
              <!--.wp2_zoomedout {cursor:url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_in.png), url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_in.cur), auto;}-->
              <!--.wp2link {display:block;overflow:hidden;}-->
              <!--.wp2img {overflow:hidden;}-->
              <!--.wp2imgimage {position:static;box-shadow:#000 0 0 0;user-select:none;}-->
            <!--</style>-->
            <!--<div style="left: 59px; position: absolute; top: 76px; width: 744px; height: 414px;" data-exact-height="404" data-content-padding-horizontal="0" data-content-padding-vertical="0" title="" class="wp2" id="comp-iobcj2me">-->
              <!--<div style="width: 744px; height: 100%;" id="comp-iobcj2melink" class="wp2link">-->
                <!--<div data-style="" class="wp2img" id="comp-iobcj2meimg" style="position: relative; width: 744px; height: 100%;">-->
                <!--&lt;!&ndash; <img id="comp-iobcj2meimgimage" alt="Untitled.jpeg" data-type="image" style="width: 744px; height: 404px; object-fit: cover;" src="./images/product_demo.png"> &ndash;&gt;-->
                <!--&lt;!&ndash; <iframe src="https://www.youtube.com/embed/WVOYPEyEfsY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> &ndash;&gt;-->
                <!--<iframe src="https://www.youtube.com/embed/FuyUdb3PyMc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
              <!--</div>-->
            <!--</div>-->
          <!--</div>-->
          <!--<style type="text/css" data-styleid="wp2">.wp2_zoomedin {-->
            <!--cursor:url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_out.png), url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_out.cur), auto;overflow:hidden;display:block;}-->
            <!--.wp2_zoomedout {cursor:url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_in.png), url(https://static.parastorage.com/services/skins/2.1229.80/images/wysiwyg/core/themes/base/cursor_zoom_in.cur), auto;}-->
            <!--.wp2link {display:block;overflow:hidden;}-->
            <!--.wp2img {overflow:hidden;}-->
            <!--.wp2imgimage {position:static;box-shadow:#000 0 0 0;user-select:none;}-->
         <!--</style>-->
          <!--</div>-->
        <!--</div>-->
      <!--</div>-->
      <div class="landingVideoContainer">
        <div class="left-col">
          <div>
            <h3>What is Kodwiz?</h3>
            <iframe src="https://www.youtube.com/embed/FuyUdb3PyMc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
        <div class="right-col">
            <div>
              <h3>How does it work?</h3>
              <iframe src="https://www.youtube.com/embed/rkI1YDVQOVU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
      </div>
      <div class='tutorialBtn'>
        <button onclick='window.open("../tutorials")'>TUTORIALS</button>
      </div>
    </div>
    <div class="spacingElement">
      <img src="./images/kod_wiz_logo.png" />
    </div>
    <div id='feature' class='featureSection'>
      <h2>KodWiz Features</h2>
      <div class="featureContainer">
        <h3><span>Report Wizard</span></h3>
        <h3><span>Conversion Wizard</span></h3>
        <h3><span>ABAP applications</span></h3>
        <h3><span>HTML report and app</span></h3>
        <h3><span>Swift iOS report and app</span></h3>
        <h3><span>ABAP interface</span></h3>
        <h3><span>Android report and app</span></h3>
      </div>
      <h3 class="featureEnd">Tools for <span class="redify">developers</span> of any experience level. The generation of predictable and repetitive parts of code is fully automated, this minimizes routine work to increase creative work. The technical specification generation is in MS Word format.</h3>
    </div>
    <div id="about" class='aboutSection'>
      <h2>MEET KodWiz</h2>
      <div class='aboutContent'>
        <div class='left-col'>
          <div class='imgContainer'>
            <img src='./images/jan_profile.png' />
          </div>
          <div class='strikeThrough'></div>
          <h3>JAN HOBLIK</h3>
          <div class='aboutTextContainer'>
            <p>Is the Chief Product Architect with a wide range of experience from Silicon Valley technology leading enterprises, he was among the first employees of Tesla Motors and helped to build up the company from a startup to the worldwide leading EV manufacturer. Currently participating on several projects as the lead SAP architect.</p>
          </div>
        </div>
        <div class='right-col'>
          <div class='imgContainer'>
            <img src='./images/otto_profile.png' />
          </div>
          <div class='strikeThrough'></div>
          <h3>OTTO FABRI</h3>
          <div class='aboutTextContainer'>
            <p>is responsible for business development in KodWiz bringing in experience from companies like Faraday Future and Tesla motors where he was part of the core team responsible for development of the Model S and Model X projects.</p>
          </div>
        </div>
      </div>
    </div>
    <!--<div class="spacingElement contact">-->
      <!--<img src="./images/kod_wiz_logo.png" />-->
    <!--</div>-->
    <div id='contact' class='contactSection'>
      <h2>CONTACT US</h2>
      <h3 id='contactInstructions'>Please fill in your contact details below.</h3>
      <div class='formContainer'>
        <form onSubmit='submitForm(event);'>
          <div>
            <input type='text' id='name' placeholder='Name'/>
          </div>
          <div>
            <input type='text' id='email' placeholder='Email' />
          </div>
          <div>
            <input type='text' id='phone' placeholder='Phone' />
          </div>
          <div>
            <textarea type='text' id='message' placeholder='Message'></textarea>
            <p id='feedbackMessage'></p>
          </div>
          <div>
            <button class='submitFormBtn'>SEND</button>
          </div>
        </form>
      </div>
    </div>
    <script>
      showHeader();
    </script>
  </body>
</html>
