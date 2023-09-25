@extends('user_layout.master')
@section('content')
<section class="blog-details-sec">
    <div class="container">
      <div class="blog-details-content">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb blog_breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Blog</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Lorem Ipsum is simply dummy text Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Blog</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Lorem Ipsum is simply dummy text </a>
            </li>
          </ol>
        </nav>
        <div class="detail-img">
          <img src="img/blog-detail1.png" alt="">
        </div>
        <div class="detail-text">
          <div class="lorem-text">
            <p>By Loren Max <span>| April 20, 2023</span>
            </p>
          </div>
          <div class="text-wrapper">
            <h2>Lorem Ipsum is simply dummy text</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
              scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
              of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
              like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
              letters, as opposed to using 'Content here, content here', making it look like readable English. Many
              desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a
              search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved
              over the years, sometimes by accident, sometimes on purpose</p>
          </div>
        </div>
        <div class="logo-detail-text">
          <div class="lorem-text">
            <h6>Where does it come from?</h6>
          </div>
          <div class="text-wrapper">
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
              Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at
              Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a
              Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the
              undoubtable source.</p>
            <p> Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of
              Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular
              during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line
              in section 1.10.32</p>
          </div>
        </div>
        <div class="logo-detail-text">
          <div class="lorem-text">
            <h6>Where can I get some?</h6>
          </div>
          <div class="text-wrapper">
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. </p>
            <p> All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making
              this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
              a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated
              Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
            </p>
          </div>
        </div>
        <div class="post-img">
          <img src="img/blog-detail.png" alt="">
        </div>
        <div class="logo-detail-text">
          <div class="lorem-text">
            <h6>The standard Lorem Ipsum passage, used since the 1500s</h6>
          </div>
          <div class="text-wrapper">
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
              ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
              fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum</p>
          </div>
        </div>
        <div class="logo-detail-text">
          <div class="lorem-text">
            <h6>What is Lorem Ipsum?</h6>
          </div>
          <div class="text-wrapper">
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
              scrambled it to make a type specimen book.</p>
            <p> It has survived not only five centuries, but also the leap into electronic typesetting, remaining
              essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
              Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
              versions of Lorem Ipsum</p>
          </div>
        </div>
        <div class="share-content">
          <div class="share-post-text">
            <h6>Share This Post</h6>

          </div>
          <div class="share-icon">
            <a href="#"> <i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
            <a href="#"> <i class="fa-brands fa-instagram"></i></a>
            <a href="#"> <i class="fa-brands fa-linkedin-in"></i></a>




          </div>
        </div>
      </div>
  </section>
  <section class="recent-blog-sec p-110">
    <div class="container">
      <div class="recent-blog-text">
        <h2>Related Posts</h2>
      </div>
      <div class="recent-blog-box">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="blog-content max">
              <div class="recent-blog-img">
                <img src="img/blog1.png" alt="">
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
            <div class="blog-content max">
              <div class="recent-blog-img">
                <img src="img/blog2.png" alt="">
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
            <div class="blog-content max">
              <div class="recent-blog-img">
                <img src="img/blog3.png" alt="">
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
      </div>
    </div>
  </section>
@endsection