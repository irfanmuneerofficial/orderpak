<!DOCTYPE html>
<html lang="en">
  <head>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    /*font-size: 100px;
    font: inherit;*/
    vertical-align: baseline;
}
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    line-height: 1;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
/* Clearfix END */
body{
    font-family: 'Roboto', sans-serif;
}
    /*EMAIL-VENDOR*/
.vendor-con
{
  max-width: 600px;
  margin: auto;
}

/*EMAIL-RESET*/
/*.email-reset
{
  margin-top: 30px;
}
.email-reset img
{
  margin: auto;
  display: block;
  width: 350px;
}*/
.email-reset h4
{
  text-align: center;
  font-weight: 600;
  margin-top: 20px;
}
.reset-text
{
  margin-top: 40px;
}
.reset-text h4
{
  color: #1b455f;
  font-weight: 600;
  font-size: 24px;
  margin-bottom: 10px;
}
.reset-text p
{
  color: #000406;
opacity: 1;
line-height: 22px;
}
.reset-text h3
{
  text-align: center;
  font-weight: 600;
  margin-top: 40px;
}
.reset-text button ,.reset-text button:focus
{
  margin: auto;
  display: block;
  margin-top: 30px;
  width: 160px;
  color: #fff !important;
height: 46px;
border-radius: 30px;
background: #1b455f;
border:none;
outline: none;
box-shadow: none;
font-size: 16px;
letter-spacing: 1px;
}
.reset-text button:hover
{
  margin: auto;
  display: block;
  margin-top: 30px;
  width: 160px;
  transition: 0.4s;
  color: #fff;
height: 46px;
border:none;
border-radius: 30px;
cursor: pointer;
background: #1b455fa3 !important;
}
.footer-box
{
  background-color: #f5f5f5;
  padding: 10px;
  margin-top: 20px;
  height: 170px;
}
.email-footer h3
{
  margin-left: 35px;
  font-weight: 600;
  margin-bottom: 6px;
}
.email-footer p
{
  margin-left: 35px;
}
.social-icons-2
{
  line-height:1px;
}
.follow-section 
{
  float: right;
  width: 40%;
  margin-top: 36px;
}
.follow-section h6
{
  margin-bottom: 10px;
  font-size: 14px;
}
.follow-section h3 {
    color: #024990;
    font-size: 22px;
    font-weight: 600;
    margin-left: 0px;
}
.social-icons-2 a img
{
  margin-right: 10px;
  cursor: pointer;
}
.follow-section p
{
  margin-bottom: 10px;
  font-size: 14px;
  margin-top: 10px;
  margin-left: 0px;
}
.footer-detail
{
  width: 50%;
  float: left;
}
/*EMAIL-USER*/
.email-user-back
{
  background: url(https://orderpak.com/email_img/email-back.png);
  height: 200px;
  background-repeat: no-repeat;
}
.email-user-back img
{   
margin-top: 50px;
margin-left: 25px;
width: 220px;
}
.user-img
{
  width: 40%;
  float: left;
}
.user-head
{
  width: 60%;
  float: right;
  margin-top: 70px;
}
.user-head h2
{
  color: #EBFFFF;
  text-align: center;
  letter-spacing: 2px;
  margin-bottom: 10px;
}
.user-head p
{
  color: #EBFFFF;
  text-align: center;
  font-size: 12px;
  letter-spacing: 0.6px;
}
@media (max-width: 599px) {
   .user-img {
    width: 100%;
   }
  .email-user-back img {
    width: 220px;
    margin: auto;
    padding-top: 20px;
    display: block;
    padding-bottom: 15px;
   }
   .user-head {
    width: 100%;
    margin: auto;
    display: block;
   }
   .reset-text
   {
    padding: 10px;
   }
   .footer-detail img
   {
    margin: auto;
    display: block;
    margin-bottom: 14px;
    margin-top: -10px;
   }
   .email-footer h3
   {
    margin-left: 0px;
   }
   .email-footer p {
    margin-left: 0px; 
   }
   .follow-section {
    float: left;
    width: 100%;
    margin-top: 26px;
   }
   .footer-detail {
    width: 100%;
    float: left;
   }
   .footer-box
   {
    height: 280px;
   }
}

@media (max-width: 476px) {
  .user-img {
    width: 100%;
   }
  .email-user-back img {
    width: 220px;
    margin: auto;
    padding-top: 20px;
    display: block;
    padding-bottom: 15px;
   }
   .user-head {
    width: 100%;
    margin: auto;
    display: block;
   }
   .reset-text
   {
    padding: 10px;
   }
   .footer-detail img
   {
    margin: auto;
    display: block;
    margin-bottom: 14px;
    margin-top: -10px;
   }
   .email-footer h3
   {
    margin-left: 0px;
   }
   .email-footer p {
    margin-left: 0px; 
   }
   .follow-section {
    float: left;
    width: 100%;
    margin-top: 26px;
   }
   .footer-detail {
    width: 100%;
    float: left;
   }
   .footer-box
   {
    height: 280px;
   }
}
  </style>
  </head>
  <body>

    <header>
      <div class="vendor-con">
        <div class="email-user-back">
         <div class="user-img">
          <img src="https://orderpak.com/email_img/email-logo.png" alt="">
         </div>
        <div class="user-head">
          <h2>Account Suspended</h2>
          <p>THE LARGEST MARKETPLACE IN PAKISTAN</p>
        </div>
        </div>
      </div>
    </header>

    <section>
      <div class="vendor-con">
        <div class="reset-text">
          <h4>Dear Wholesaler/Dealer,</h4>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
          <br>
          <p>Thanks,</p>
          <p>OrderPak</p>
        </div>
      </div>
    </section>
     &nbsp; 
    <footer>
     <div class="vendor-con">
       <div class="footer-box">
         <div class="clearfix">
           <div class="email-footer">
             <div class="footer-detail">
             <img src="https://orderpak.com/email_img/Untitled-3-01.png" alt="">
             <h3>Need more help? 24/7</h3>
             <p>Call: 021 372 900 73</p>
             <p>Email: info@orderpak.com</p>
             </div>
             <div class="follow-section">
              <h3>Follow Us</h3>
              <p>Office # 105, 1st Floor Asia Pacific Trade Center, Block 19 Gulistan e Johar, Karachi.</p>
              <div class="social-icons-2 mt-1">
                <a href="https://www.facebook.com/orderpak"><img src="https://orderpak.com/email_img/facebook.jpeg" alt=""></a>
                <a href="https://twitter.com/Orderpak1"><img src="https://orderpak.com/email_img/twitter.jpeg" alt=""></a>
                <a href="https://www.instagram.com/orderpak/"><img src="https://orderpak.com/email_img/instagram.jpeg" alt=""></a>
                <a href="https://www.linkedin.com/company/orderpak/"><img src="https://orderpak.com/email_img/linkedin.jpeg" alt=""></a>
                <a href="https://www.youtube.com/channel/UCyDqPl4IFrU74eboSa3h7rw"><img src="https://orderpak.com/email_img/whatsapp.jpeg" alt=""></a>
              </div>
            </div>
           </div>
         </div>
       </div>
     </div> 
    </footer>
  </body>
</html>