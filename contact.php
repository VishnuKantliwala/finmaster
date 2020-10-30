<?
$page_id = 39;
include_once("header.php");
$sql = $cn->selectdb("select * from tbl_page p where  p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);
?>
      <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image" style="background-image: url(page/big_img/<? echo $image; ?>);">
        <div class="container">
          <div class="page-title">
            <h2><? echo $page_name ?></h2>
          </div>
        </div>
      </section>


      <section class="section-60 section-md-top-90 section-md-bottom-100 novi-background bg-cover">
        <div class="container">
          <div class="row row-fix justify-content-sm-center justify-content-lg-start row-50">
            <div class="col-lg-7 col-xl-6">
              <h3>Get in <span class="text-thin">Touch</span></h3>
              <form class="rd-mailform form-modern" data-form-output="form-output-global" data-form-type="contact" id="contactForm" action="contact_mail.php" method="post" name="contactForm">
                <div class="row row-fix row-30">
                  <div class="col-md-6">
                    <div class="form-wrap">
                      <input class="form-input" id="contact-name" type="text" name="name" data-constraints="@Required">
                      <label class="form-label" for="contact-name">Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-wrap">
                      <input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
                      <label class="form-label" for="contact-email">Email</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-wrap">
                      <input class="form-input" id="contact-phone" type="text" name="phone" data-constraints="@Required">
                      <label class="form-label" for="contact-phone">Contact No.</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-wrap">
                      <input class="form-input" id="contact-subject" type="text" name="subject" data-constraints="@Required">
                      <label class="form-label" for="contact-subject">Subject</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-wrap">
                      <input class="form-input" value="" id="verif_box" name="verif_box" type="text"
                          data-constraints="@Required"/>
                       <label class="form-label" for="verif_box">Code</label>
                       </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-wrap">
                      <center> <img style="width:100px;height:50px"
                              src="verificationimage.php?<?php echo rand(0,9999);?>"
                              alt="verification image, type it in the box" width="50px" height="50px"
                              align="absbottom" />
                      </center>
                      </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-wrap">
                      <div class="textarea-lined-wrap">
                        <textarea class="form-input" id="contact-message" name="message" data-constraints="@Required"></textarea>
                        <label class="form-label" for="contact-message">Message</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" id="resultForm"></div>
                  <div class="col-sm-8">
                    <button class="btn btn-primary btn-block" id="submitContact" type="submit">Send</button>
                  </div>
                  <div class="col-sm-4">
                    <button class="btn btn-silver-outline btn-block" type="reset">Reset</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-xl-1 d-none d-xl-inline-block"></div>
            <div class="col-lg-5 col-xl-4">
              <div class="row row-40">
			  <?
						$sql = $cn->selectdb("select * from tbl_contact where con_id = 1");
						$row = mysqli_fetch_assoc($sql);
						extract($row);
						$contact = explode(",",$contact_no);
						$mail = explode(",",$email);
						?>
                <div class="col-md-10 col-lg-12">
                  <h3>How to <span class="text-thin">Find Us</span></h3>
                  
                </div>
                <div class="col-md-6 col-lg-12">
                  <h4>Office Address</h4>
                  <address class="contact-info">
                    <p class="text-uppercase"><? echo $contact_desc; ?></p>
                    <dl class="list-terms-inline">
                      <dt>Contact No:</dt>
                      <? for($i=0;$i<count($contact);$i++){ ?>
                            <br>
                            <dd> <i class="fa fa-phone text-color"></i>
                         <a class="link-secondary" href="tel:<?echo $contact[$i]; ?>">
                                <?echo $contact[$i]; ?></a></dd>
                        <? } ?>       
                      
                    </dl>
                    <dl class="list-terms-inline">
                      <dt>E-mail</dt>
                      <? for($i=0;$i<count($mail);$i++){ ?>
                            <br>
                      <dd><a class="link-primary" href="mailto:<? echo $mail[$i]; ?>"><? echo $mail[$i]; ?></a></dd>
                      <? } ?>       
                    </dl>
                  </address>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="google-map-container">
			
        <? echo $maptag; ?>
      </section>
<!---------------------------------------- OUR MANUAL JS ----------------------------------------->

<!--FOR Forms-->
<script src="js/forms.js"></script>



<!---------------------------------------- OUR MANUAL JS ------------------------------------------>
   <? include_once("footer.php"); ?>