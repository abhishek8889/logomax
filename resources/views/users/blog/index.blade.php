@extends('user_layout/master')
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
          <input type="search" class="form-control" id="blog-search" placeholder="Search our blog">
        </div>
        <div class="Search-bar">
          <button id="button-addon5" class="blog-search" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
      <div class="blog-img-box">
      <div class="row">
          @if($blogs)
            @foreach($blogs as $key => $blog)
              @if($key < 2)
                @if($key === 0)
                  <div class="col-md-8">
                    <div class="blog-img">
                      <img src="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" alt="">
                      <div class="content">
                        <div class="blog-dummy-text">
                          <a href="{{ url('blogs-details/' . ($blog->slug ?? '')) }}"><h2>{{ $blog->title ?? '' }}</h2></a>
                          <div class="Read-More-btn">
                            <a href="{{ url('blogs-details/' . ($blog->slug ?? '')) }}" class="read-btn">Read More</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="col-md-4">
                    <div class="group-img-{{ $key ?? '1' }}">
                      <img src="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" alt="">
                      <div class="passage-text">
                        <p>{{ $blog->title ?? '' }}</p>
                      </div>
                    </div>
                  </div>
                @endif
              @endif
            @endforeach
          @endif
        </div>

        <!-- <div class="row">
          @if($blogs)
            @foreach ($blogs as $n => $b)
              @if($n <= 3)
                <div class="col-md-{{ $n == 0 ? '8' : '4' }}">
                   <div class="blog-img">
                      <img src="{{ asset('blog_images') }}/{{ $b->banner_img ?? '' }}" alt="">
                      <div class="content">
                        <div class="blog-dummy-text">
                         <a href="{{ url('blogs-details/' . ($b->slug ?? '')) }}"><h2>{{ $b->title ?? '' }}</h2></a> 
                          <div class="Read-More-btn {{ $n == 0 ? '' : 'd-none' }}">
                            <a href="{{ url('blogs-details/' . ($b->slug ?? '')) }}" class="read-btn">Read More</a>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                @endif
            @endforeach
          @endif
        </div> -->
      </div>
    </div>
  </section>

  <section class="recent-blog-sec p-110">
    <div class="container">
      <div class="recent-blog-text" id="recent-blog-text">
        <h2 class="blog-text">Recent Blog</h2>
      </div>
      <div class="recent-blog-box">
      @if($blogs->IsNotEmpty())
        <div class="row" id="blogs-list">
          <?php $showMore = 'd-none'; ?>
            @foreach ($blogs as $k => $blog)
                <div class="col-lg-4 col-md-6 {{ $k >= 9 ? 'blogs-data d-none' : '' }}">
                  <div class="blog-content">
                    <div class="recent-blog-img">
                      <a href="{{ url('blogs-details/' . ($blog->slug ?? '')) }}">
                        <img src="{{ asset('blog_images') }}/{{ $blog->banner_img ?? '' }}" alt="">
                      </a> 
                    </div>
                    <div class="recent-text">
                      <div class="lorem-text">
                        <p><span> {{ $blog->created_at->format('F d, Y') ?? '' }}</span></p>
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
        <div class="row d-none" id="blogs-list-append">

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

$('.blog-search').on('click',function(e){
  e.preventDefault();
document.getElementById('recent-blog-text').scrollIntoView({ behavior: 'smooth', block: 'center' });
  // console.log(innerdiv);
  blogsearchvalue = $('input#blog-search').val();
  if(blogsearchvalue == null || blogsearchvalue == ""){
    // $('.blog-img-box').removeClass('d-none');
    $('.blog-text').html('Recent Blogs');
    $('#blogs-list').removeClass('d-none');
    $('#blogs-list-append').addClass('d-none');
    return false;
  }
  $.ajax({
    method: 'post',
    url: '{{ url('blog-search') }}',
    data: { searchvalue:blogsearchvalue,_token:'{{ csrf_token() }}' },
    success: function(response){
      $('#blogs-list').addClass('d-none');
      $('#blogs-list-append').removeClass('d-none');
      $('.blog-text').html('Search Blogs');
      if(response.length > 0){
      appendhtml = [];
      $.each(response, function(key,value){

        date = moment(value.created_at).format("MMMM DD,Y");
        
        html = '<div class="col-lg-4 col-md-6"><div class="blog-content"><div class="recent-blog-img"><a href="{{ url('blogs-details/') }}/'+value.slug+'"><img src="{{ asset('blog_images') }}/'+value.banner_img+'" alt=""></a></div><div class="recent-text"><div class="lorem-text"><p><span>'+date+'</span></p></div><div class="simply-text"><a href="{{ url('blogs-details/') }}/'+value.slug+'"><h6>'+value.title+'</h6></a><p>'+value.sub_title+'</p></div></div></div></div>';
        appendhtml.push(html);
      });

      $('#blogs-list-append').html(appendhtml);
        }else{
          $('#blogs-list-append').html('<div class="col-lg-12 text-center"><h2 class="text-center">No Data Found</h2></div>');
        }
        
    }
  });

});
  </script>
@endsection