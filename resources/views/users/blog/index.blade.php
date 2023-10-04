@extends('user_layout.master')
@section('content')
  <section class="blog-sec ">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
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
              <img src="{{asset('/logomax-front-asset/img/blog-img.png') }}" alt="">
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
              <img src="{{asset('/logomax-front-asset/img/blog-img1.png') }}" alt="">
              <div class="passage-text">
                <p>The standard Lorem Ipsum passage, used since.</p>
              </div>
            </div>

            <div class="group-img-2">
              <img src="{{asset('/logomax-front-asset/img/blog-img2.png') }}" alt="">
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
      @if($blogs->IsNotEmpty())
        <div class="row">
          <?php $showMore = 'd-none'; ?>
            @foreach ($blogs as $k => $blog)
                <div class="col-lg-4 col-md-6 {{ $k >= 9 ? 'blogs-data d-none' : '' }}">
                  <div class="blog-content">
                    <div class="recent-blog-img">
                    <a href="{{ url('blogs-details/' . ($blog->slug ?? '')) }}"><img src="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" alt=""></a> 
                    </div>
                    <div class="recent-text">
                      <div class="lorem-text">
                        <p>By {{ $blog->user->name ?? '' }} <span>| {{ $blog->created_at->format('F d, Y') ?? '' }}</span></p>
                      </div>
                      <div class="simply-text">
                      <a href="{{ url('blogs-details/' . ($blog->slug ?? '')) }}"><h6>{{ $blog->title ?? '' }}</h6></a>  
                        <p>{{ $blog->sub_title ?? '' }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                
            @endforeach
        </div>
          <div class="blog-btn {{ count($blogs) >= 9 ? '' : 'd-none' }}">
            <a href="#" class="blog-cta" data-for="showmore">Load More</a>
          </div>
        @else
              <span>No blog found !</span>
          @endif
      </div>
    </div>
  </section>

  <script>
$(document).ready(function() {
  $('.blog-cta').on('click', function(e) {
    e.preventDefault();
    var dataFor = $(this).attr('data-for');
    $('.blogs-data').toggleClass('d-none');
    $(this).html(dataFor === 'showmore' ? 'Load Less' : 'Load More').attr('data-for', dataFor === 'showmore' ? 'showless' : 'showmore');
  });
});

  </script>
@endsection