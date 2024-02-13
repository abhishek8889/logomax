@extends('user_layout/master')
@section('content')

<section class="blog-sec terms-sec">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url(app()->getLocale()) }}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">{{ $title ?? '' }} </a></li>
      </ol>
    </nav>
    <div class="terms-condition">
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <div class="terms-condition-list">
            <div class="conditions tab-menu">
              <ul class="list-unstyled" id="accordion">
                <?php $first = true;  ?>
                
                @foreach($termsandconditions as $headings)
                
                <li id="heading{{ $headings->id ?? '' }}"><a href="@if($headings->title == 'Terms & Conditions') {{ url(app()->getLocale().'/legal/terms-and-conditions') }} @elseif($headings->title == 'Privacy policy') {{ url(app()->getLocale().'/legal/privacy-policy') }} @elseif($headings->title == 'Cookie policy') {{ url(app()->getLocale().'/legal/cookie-policy') }} @endif"
                  >{{ $headings->title ?? '' }}</a>
                  <div id="collapse{{ $headings->id ?? '' }}" class="collapse @if($title == $headings->title) show @endif" aria-labelledby="heading{{ $headings->id ?? '' }}" data-parent="#accordion">
                  <?php $first = false; ?>  
                  <ol class="sub-list">
                    @if($headings->childs->isNotEmpty())
                    @foreach($headings->childs as $childs)
                      <li class="ref_links" target="term_{{ $childs->id ?? '' }}" ><a href="#term_{{ $childs->id ?? '' }}">{{ $childs->title ?? '' }}</a></li>
                      @endforeach
                    @endif
                    </ol>
                  </div>
                </li>
                @endforeach
               
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-8 col-sm-12 tab-main-box" >
          <?php $first = true; ?>
          @foreach($termsandconditions as $terms)
              
          <div class="terms-condition-content tab @if($title == $terms->title) tab-active @endif" data-id="tab{{ $terms->id ?? '' }}" >
            <?php $first = false; ?> 
            <h2>{{ $terms->title ?? '' }}</h2>
            <p>{{ $terms->description ?? '' }}</p>
            <?php $count = 1; ?>
            @if($terms->childs->isNotEmpty())
                    @foreach($terms->childs as $childs)
            <div class="terms-text" id="term_{{ $childs->id ?? '' }}" style="scroll-margin-top: 180px;">
              <h6>{{ $count++ }}. {{ $childs->title ?? '' }}</h6>
              <p><?php echo $childs->description;  ?></p>
            </div>
                @endforeach
            @endif

          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  
  $('.tab-a').click(function () {
    $(".tab").removeClass('tab-active');
    $(".tab[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
    $(".tab-a").removeClass('active-a');
    $(this).parent().find(".tab-a").addClass('active-a');
  });

    $(".ref_links").click(function(e) {
      e.preventDefault();
      let targetVal = $(this).attr('target');
      //console.log(targetVal);
        // $('html, body').animate({
        //   scrollTop: $(`#${targetVal}`).offset().top
        // });

        let targetOffset = $(`#${targetVal}`).offset().top - 100;
        window.location.hash = targetVal;

       
        // $('html, header').animate({
        //     scrollTop: targetOffset
        // });

    });
</script>
@endsection