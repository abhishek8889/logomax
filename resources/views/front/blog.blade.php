@extends('front_layout/master')
@section('content')


<section class="blog-sec ">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Blog</a></li>
        </ol>
      </nav>
      <div class="Select-text">
        <div class="search">
          <input type="search" class="form-control" placeholder="Search our blog...">
        </div>
        <div class="Search-bar">
          <button id="button-addon5" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
      <div class="blog-img-box">
        <div class="row">
          <div class="col-md-8">
            <div class="blog-img">
              <img src="{{ asset('front/img/blog-img.png') }}" alt="">
              <div class="content">
                <div class="blog-dummy-text">
                  <h2>Lorem Ipsum is simply dummy text</h2>
                  <div class="Read-More-btn">
                    <a href="#" class="read-btn">Read More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="group-img-1">
              <img src="{{ asset('front/img/blog-img1.png') }}" alt="">
              <div class="passage-text">
                <p>The standard Lorem Ipsum passage, used since.</p>
              </div>
            </div>

            <div class="group-img-2">
              <img src="{{ asset('front/img/blog-img2.png') }}" alt="">
              <div class="star-text">
                <p>The standard Lorem Ipsum passage, used since.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="recent-blog-sec p-110">
    <div class="container">
      <div class="recent-blog-text">
        <h2>Recent Blog</h2>
      </div>
      <div class="recent-blog-box">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog1.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog2.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog3.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog4.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog5.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog6.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog7.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog8.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-content">
              <div class="recent-blog-img">
                <img src="{{ asset('front/img/blog9.png')}}" alt="">
              </div>
              <div class="recent-text">
                <div class="lorem-text">
                  <p>By Loren Max <span>| April 20, 2023</span> </p>
                </div>
                <div class="simply-text">
                  <h6>The standard Lorem Ipsum <br> passage, used since.</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="blog-btn">
          <a href="#" class="blog-cta">Load More</a>
        </div>
      </div>
    </div>
  </section>
@endsection