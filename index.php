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
        <h2 class="featureHead">ABAP</h2>
        <div class="mainHighlight">
            <h3><span>Report Wizard</span></h3>
            <h3><span>Application Wizard</span></h3>
            <h3><span>Conversion Wizard</span></h3>
        </div>
        <div class='lineBreak'></div>
        <h3><span>ABAP OO</span></h3>
        <h3><span>FIORI CDS</span></h3>
        <h3><span>FIORI ODATA</span></h3>
        <h3><span>SWIFT ODATA</span></h3>
        <h3><span>ANDROID ODATA</span></h3>
      </div>
      <h3 class="featureEnd">Tools for <span class="redify">developers</span> of all experience levels. The generation of predictable and repetitive parts of code is fully automated, this minimizes routine work to increase creative work. The technical specification generation is in MS Word format.</h3>
    </div>
    <div id="about" class='aboutSection'>
      <h2>MEET KodWiz</h2>
      <div class='aboutContent'>
        <div class='full-col'>
          <div class='imgContainer'>
            <img src='./images/jan_profile.png' />
          </div>
          <div class='strikeThrough'></div>
          <h3>JAN HOBLIK</h3>
          <div class='aboutTextContainer'>
            <p>Is the Chief Product Architect with a wide range of experience from Silicon Valley technology leading enterprises, he was among the first employees of Tesla Motors and helped to build up the company from a startup to the worldwide leading EV manufacturer. Currently participating on several projects as the lead SAP architect.</p>
          </div>
        </div>
      </div>
    </div>
    <!--<div class="spacingElement contact">-->
      <!--<img src="./images/kod_wiz_logo.png" />-->
    <!--</div>-->
    <div id='contact' class='contactSection'>
      <h2>CONTACT US</h2>
<!--      <h3 id='contactInstructions'>Please fill in your contact details below.</h3>-->
      <div class='formContainer'>
          <div class="email-container">
              <a href="mailto:jhoblik@yahoo.com">
                  <h2>jhoblik@yahoo.com</h2>
              </a>
          </div>
          <div class="phone-container">
              <a href="tel:7146087664">
                  <h2>714-608-7664</h2>
              </a>
          </div>
<!--        <form onSubmit='submitForm(event);'>-->
<!--          <div>-->
<!--            <input type='text' id='name' placeholder='Name'/>-->
<!--          </div>-->
<!--          <div>-->
<!--            <input type='text' id='email' placeholder='Email' />-->
<!--          </div>-->
<!--          <div>-->
<!--            <input type='text' id='phone' placeholder='Phone' />-->
<!--          </div>-->
<!--          <div>-->
<!--            <textarea type='text' id='message' placeholder='Message'></textarea>-->
<!--            <p id='feedbackMessage'></p>-->
<!--          </div>-->
<!--          <div>-->
<!--            <button class='submitFormBtn'>SEND</button>-->
<!--          </div>-->
<!--        </form>-->
      </div>
    </div>
    <script>
      showHeader();
    </script>
  </body>
</html>
