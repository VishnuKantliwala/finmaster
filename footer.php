    <footer class="page-foot bg-cape-cod context-dark novi-background bg-cover">
      <!--  <div class="section-40 section-md-75">
          <div class="container">
            <div class="row row-fix justify-content-sm-center">
              <div class="col-sm-9 col-md-11 col-xl-12">
                <div class="row row-50">
                  <div class="col-md-6 col-lg-10 col-xl-3">
                    <div class="inset-xl-right-20" style="max-width: 510px;"><a class="brand brand-inverse" href="index.html"><img src="images/logo-light-282x68.png" alt="" width="282" height="68"/></a>
                      <p class="text-dusty-gray">Reckondit delivers environment through which high-quality firms from diverse backgrounds can work together toward their own common goals.</p>
                      <div class="link-block"><a class="text-small-16 text-medium" href="contact-us.html">Free Consultation</a></div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <h6 class="text-small-16 text-uppercase footer-title">Recent Posts</h6>
                    <div class="post-preview-wrap">
                            <article class="post post-preview post-preview-inverse offset-top-22"><a href="blog-post.html">
                                <div class="unit unit-horizontal unit-spacing-lg">
                                  <div class="unit-left">
                                    <figure class="post-image"><img src="images/post-preview-1-70x70.jpg" alt="" width="70" height="70"/>
                                    </figure>
                                  </div>
                                  <div class="unit-body">
                                    <div class="post-header">
                                      <p>Top 3 Concerns Whe Choosing a Cloud Vendor</p>
                                    </div>
                                    <div class="post-meta">
                                      <ul class="list-meta">
                                        <li>
                                          <time datetime="2018-12-23">June 23, 2018</time>
                                        </li>
                                        <li>4 Comment</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div></a></article>
                            <article class="post post-preview post-preview-inverse offset-top-22"><a href="blog-post.html">
                                <div class="unit unit-horizontal unit-spacing-lg">
                                  <div class="unit-left">
                                    <figure class="post-image"><img src="images/post-preview-2-70x70.jpg" alt="" width="70" height="70"/>
                                    </figure>
                                  </div>
                                  <div class="unit-body">
                                    <div class="post-header">
                                      <p>Audit Data Analytics: Why Auditors Should Care</p>
                                    </div>
                                    <div class="post-meta">
                                      <ul class="list-meta">
                                        <li>
                                          <time datetime="2018-12-23">June 20, 2018</time>
                                        </li>
                                        <li>4 Comment</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div></a></article>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <h6 class="text-small-16 text-uppercase footer-title">Quick links</h6>
                    <div class="row row-fix" style="max-width: 270px;">
                      <div class="col-6">
                        <ul class="list-marked-variant-2">
                          <li><a href="index.html">Home</a></li>
                          <li><a href="services.html">Services</a></li>
                          <li><a href="blog-classic.html">Blog</a></li>
                        </ul>
                      </div>
                      <div class="col-6">
                        <ul class="list-marked-variant-2">
                          <li><a href="about-us.html">About us</a></li>
                          <li><a href="contact-us.html">Contacts</a></li>
                          <li><a href="team.html">Team</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <h6 class="text-small-16 text-uppercase footer-title">Contact us</h6>
                    <address class="contact-info text-left">
                      <div class="unit unit-horizontal unit-spacing-md align-items-center">
                        <div class="unit-left"><span class="novi-icon icon icon-xs icon-dusty-gray material-icons-phone"></span></div>
                        <div class="unit-body"><a class="link-white" href="tel:#">+1 (409) 987–5874</a></div>
                      </div>
                      <div class="unit unit-horizontal unit-spacing-md align-items-center">
                        <div class="unit-left"><span class="novi-icon icon icon-xs icon-dusty-gray fa fa-envelope-o"></span></div>
                        <div class="unit-body"><a class="link-white" href="/cdn-cgi/l/email-protection#d5f6"><span class="__cf_email__" data-cfemail="a5cccbc3cae5c1c0c8cac9cccbce8bcad7c2">[email&#160;protected]</span></a></div>
                      </div>
                      <div class="unit unit-horizontal unit-spacing-md">
                        <div class="unit-left"><span class="novi-icon icon icon-xs icon-dusty-gray material-icons-place"></span></div>
                        <div class="unit-body"><a class="link-white d-inline" href="#">6036 Richmond hwy,<br>Alexandria, VA USA 22303</a></div>
                      </div>
                    </address>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <hr class="hr bg-abbey-04">
        </div>-->
        <div class="section-35">
          <div class="container text-center">
            <div class="row row-fix flex-md-row-reverse justify-content-md-between align-items-md-center row-15">
              <div class="col-md-6 text-md-right">
                <div class="group-sm group-middle">
                  <p class="font-italic text-white">Follow Us:</p>
                  <ul class="list-inline list-inline-reset">
                    <?
								$sql = $cn->selectdb("select * from tbl_socialmedia order by recordListingID");
								while($row = mysqli_fetch_assoc($sql))
								{
									extract($row);
								
								?>
                               
								<li><a class="novi-icon icon icon-round icon-abbey-filled icon-xxs-smallest <? echo $description; ?>" href="<? echo $link_url; ?>" target="_BLANK"></a></li>

                 <?
								}
								?>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 offset-top-15 offset-sm-top-0 text-md-left">
                <p class="rights text-white"><span class="copyright-year"></span><span>&nbsp;&#169;&nbsp;</span><span>FINMASTER.&nbsp;</span>POWERED BY <a href="http://www.icedinfotech.com/" target="_BLANK">ICED INFOTECH</a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
