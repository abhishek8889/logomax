@extends('user_layout.master')
@section('content')
  <!-- ================= banner section start ====================== -->

  <section class="banner-sec" style="background-image: url({{ asset('/logomax-front-asset/img/banner-img.png') }});">
    <div class="container-fluid">
      <div class="banner-content">
        <div class="Select-text">
          <div class="all-select">
            <div class="search">
              <input type="search" class="form-control" placeholder="Search for logo...">
            </div>
          </div>
          <div class="Search-bar">
            <button id="button-addon5" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        <div class="trending-wrapper">
          <div class="trending-btn">
            <ul>
              <li class="simple"> Trending:</li>
              <li>
                <a class="design-btn" href="#">Interior design</a>
              </li>
              <li>
                <a class="design-btn" href="#">Marketing</a>
              </li>
              <li>
                <a class="design-btn" href="#">Education</a>
              </li>
              <li>
                <a class="design-btn" href="#">Dental</a>
              </li>
              <li>
                <a class="design-btn" href="#">Insurance</a>
              </li>
              <li>
                <a class="design-btn" href="#">Makeup</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="content-wrapper">
        <div class="logos-text">
          <h5>Unique logos from
            <span>$149</span>
          </h5>
        </div>
        <div class="try-btn">
          <a class="login-btn" href="#">Try Now</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= banner section end ====================== -->

  <!-- ================= templates section start ====================== -->

  <section class="templates-sec p-110">
    <div class="container">
      <div class="template-content">
        <h2>Thousands of Professional Logo Templates</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
          industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
          scrambled it to make a type specimen book.</p>
      </div>




      <div class="tab-wrapper">
        <div class="grid-wrapp">
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs1.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 01</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs2.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 02</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs3.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 03</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs3.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 03</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs4.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 04</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs5.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 05</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs6.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 06</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs7.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 07</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs4.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 04</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs5.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 05</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs6.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 06</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs7.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 07</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= templates section end ====================== -->

  <!-- ================= join logo section start ====================== -->

  <section class="join-logo-sec" style="background-image: url({{ asset('logomax-front-asset/img/signup-bg 1.png')}});">
    <div class="container">
      <div class="join-logo-text">
        <div class="download-text">
          <h6>What is <br>
            Lorem Ipsum?</h6>
          <p> <strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum
            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it.</p>
        </div>
        <div class="register-text">
          <h6>Register to download Logos
            from Logomax.</h6>
          <div class="join-btn">
            <a class="g-btn" href="#"><i class="fa-solid fa-g"></i>Register with <strong>Google</strong> </a>
          </div>
          <div class="join-btn">
            <a class="fb-btn" href="#"> <i class="fa-brands fa-facebook"></i>Register with <strong>Facebook</strong>
            </a>
          </div>
          <div class="join-btn">
            <a class="email-btn" href="#"><i class="fa-solid fa-envelope"></i>Register by email</a>
          </div>
          <p>By clicking "Create Account" or registering using Facebook or
            Google, you agree to the Membership Agreement *</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= join logo section start ====================== -->

  <!-- ================= Popular search section start ====================== -->


  <section class="popular-sec p-110">
    <div class="container">
      <div class="popular-text">
        <h2>Popular search requests:</h2>
      </div>
      <div class="popular-btn-box">
        <div class="popular-btn">
          <ul>
            <li>
              <a href="#">Agriculture</a>
            </li>
            <li>
              <a href="#">Airline</a>
            </li>
            <li>
              <a href="#">Animals</a>
            </li>
            <li>
              <a href="#">App</a>
            </li>
            <li>
              <a href="#">Bakery</a>
            </li>
            <li>
              <a href="#">Barber shop</a>
            </li>
            <li>
              <a href="#">Beauty</a>
            </li>
            <li>
              <a href="#">Solar Energy</a>
            </li>
            <li>
              <a href="#">Interior design</a>
            </li>
            <li>
              <a href="#">Logistics</a>
            </li>
            <li>
              <a href="#">Makeup</a>
            </li>
            <li>
              <a href="#">Marketing</a>
            </li>
            <li>
              <a href="#">Travel</a>
            </li>
            <li>
              <a href="#">Dental</a>
            </li>
            <li>
              <a href="#">Education</a>
            </li>
            <li>
              <a href="#">Lawn care</a>
            </li>
            <li>
              <a href="#">Trendy logo</a>
            </li>
            <li>
              <a href="#">Wedding</a>
            </li>
            <li>
              <a href="#">Insurance</a>
            </li>
            <li>
              <a href="#">Digital</a>
            </li>
            <li class="show-more">
              <a class="show-btn" href="#">Show More</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= Popular search section end ====================== -->

  <!-- ================= slider section start ====================== -->

  <section class="slider-sec">
    <div class="container">
      <div class="logomax-content">
        <h2>Why our customers love Logomax</h2>
        <p>Hundreds of customers have trusted Logomax logo maker and Brand Plan as a resource to set up, launch, and
          grow a brand they love.</p>
        <div class="logomax-img">
          <img src="img/trustpilot.png" alt="">
        </div>
      </div>
      <div class="slick-wrapper">
        <div class="slick-test">
          <div class="slider-box">
            <div class="slider-content">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised..</p>

            </div>
            <div class="choice_star">
              <h6>the choice was great</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default!!</p>

            </div>
            <div class="choice_star">
              <h6>I generally find what I am looking for</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised..</p>

            </div>
            <div class="choice_star">
              <h6>the choice was great</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default!!</p>

            </div>
            <div class="choice_star">
              <h6>I generally find what I am looking for</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= slider section end ====================== -->
  @endsection