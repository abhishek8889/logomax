@extends('user_layout/master')
@section('content')
<section class="blog-details-sec">
    <div class="container">
      <div class="blog-details-content">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb blog_breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ url('/') ?? '' }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('blogs') ?? '' }}">Blog</a>
              
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('blogs-details/' . ($blog->slug ?? '')) }}">{{ $blog->title ?? '' }}</a>
            </li>
          </ol>
        </nav>
        <div class="detail-img">
          <img src="img/blog-detail1.png" alt="">
        </div>
        <div class="detail-text">
          <div class="lorem-text">
            <p>By {{ $blog->user->name ?? '' }} <span>| {{ $blog->created_at->format('F d, Y') ?? '' }}</span>
            </p>
          </div>
          <div class="text-wrapper">
            <h2>{{ $blog->title ?? '' }}</h2>
            <p>{{ $blog->sub_title ?? '' }}</p>
          </div>
        </div>
        <div class="post-img">
          <img src="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" alt="">
        </div>
        <div class="logo-detail-text">
            <?php echo $blog->description; ?>
        </div>
        <!-- <div class="logo-detail-text">
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
        </div> -->
     
        <!-- <div class="logo-detail-text">
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
        </div> -->
        <div class="share-content">
          <div class="share-post-text">
            <h6>Share This Post</h6>

          </div>
          <div class="share-icon">
          <a href="#" class="shareOn" share-to="facebook" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url('blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="shareOn" share-to="pinterest" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url('blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-pinterest-p"></i></a>
          <a href="#" class="shareOn" share-to="instagram" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url('blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="shareOn" share-to="linkedin" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url('blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-linkedin-in"></i></a>
            <!-- <a href="#" class="shareOnFaceboof"><i class="fa-brands fa-facebook-f"></i></a> -->
            <!-- <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
            <a href="#"> <i class="fa-brands fa-instagram"></i></a>
            <a href="#"> <i class="fa-brands fa-linkedin-in"></i></a> -->
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
      @if($relatedBlog->IsNotEmpty())
        <div class="row">
          @foreach ($relatedBlog as $related)
            
            <div class="col-lg-4 col-md-6">
              <div class="blog-content max">
                <div class="recent-blog-img">
                <!-- <img src="{{asset('/logomax-front-asset/img/blog1.png') }}" alt=""> -->
                  <a href="{{ url('blogs-details/' . ($related->slug ?? '')) }}"><img src="{{ asset('blog_images') }}/{{ $related->banner_img ?? '' }}" alt=""></a> 
                </div>
                <div class="recent-text">
                  <div class="lorem-text">
                    <p>By {{ $related->user->name ?? '' }} <span>| {{ $related->created_at->format('F d, Y') ?? '' }}</span> </p>
                  </div>
                  <div class="simply-text">
                    <a href="{{ url('blogs-details/' . ($related->slug ?? '')) }}"><h6>{{ $related->title ?? '' }}</h6></a> 
                    <p>{{ $related->sub_title ?? '' }}</p>
                  </div>
                </div>
              </div>
            </div>

          @endforeach
        </div>
        @else
        <span>Related Posts Not Available ! </span>
        @endif
      </div>
    </div>
  </section>
<script>
$(document).ready(function() {
    $('.shareOn').click(function(event) {
        event.preventDefault();

        const shareImg = $(this).attr('share-img');
        const shareUrl = $(this).attr('share-url');
        const shareTitle = $(this).attr('share-title');
        // const shareImg = `http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg`;
        // const shareUrl =`http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html`;
        // const shareTitle = `welcome to my site`;
        var shareOn = $(this).attr('share-to');
        var ShareURL = '';

        
        $('meta[property="og:image"]').attr('content', shareImg);
        $('meta[property="og:url"]').attr('content', shareUrl);
        $('meta[property="og:title"]').attr('content', shareTitle);


        if (shareOn == 'facebook') {
            ShareURL = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
        }
        if (shareOn == 'pinterest') {
            ShareURL = `https://www.pinterest.com/pin/create/button/?url=${encodeURIComponent(shareUrl)}&media=${encodeURIComponent(shareImg)}&description=${encodeURIComponent(shareTitle)}`;
        }
        if (shareOn == 'linkedin') { 
            ShareURL = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareUrl)}`;
        }
        if (shareOn == 'instagram') {
            ShareURL = `https://www.instagram.com/sharing/share-offsite/?url=${encodeURIComponent(shareUrl)}`;
        }

        window.open(ShareURL, '_blank', 'width=600,height=400');
    });
});

</script>
@endsection
