@extends('user_layout/master')
@section('content')
<section class="blog-details-sec">
    <div class="container">
      <div class="blog-details-content">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb blog_breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ url('/'.app()->getLocale()) ?? '' }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url(app()->getLocale().'/blogs') ?? '' }}">Blog</a>
              
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url(app()->getLocale().'/blogs-details/' . ($blog->slug ?? '')) }}">{{ $blog->title ?? '' }}</a>
            </li>
          </ol>
        </nav>
       
        <div class="detail-text">
          <div class="lorem-text">
            <p><span> {{ $blog->created_at->format('F d, Y') ?? '' }}</span>
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
        <div class="share-content">
          <div class="share-post-text">
            <h6>Share This Post</h6>

          </div>
          <div class="share-icon">
          <a href="#" class="shareOn" share-to="facebook" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url(app()->getLocale().'/blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="shareOn" share-to="pinterest" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url(app()->getLocale().'/blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-pinterest-p"></i></a>
          <a href="#" class="shareOn" share-to="instagram" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url(app()->getLocale().'/blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="shareOn" share-to="linkedin" share-img="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" share-url="{{ url(app()->getLocale().'/blogs-details/' . ($blog->slug ?? '')) }}" share-title="{{ $blog->title ?? '' }}"><i class="fa-brands fa-linkedin-in"></i></a>
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
                  <a href="{{ url(app()->getLocale().'/blogs-details/' . ($related->slug ?? '')) }}"><img src="{{ asset('blog_images') }}/{{ $related->banner_img ?? '' }}" alt=""></a> 
                </div>
                <div class="recent-text">
                  <div class="lorem-text">
                    <p><span> {{ $related->created_at->format('F d, Y') ?? '' }}</span> </p>
                  </div>
                  <div class="simply-text">
                    <a href="{{ url(app()->getLocale().'/blogs-details/' . ($related->slug ?? '')) }}"><h6>{{ $related->title ?? '' }}</h6></a> 
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
