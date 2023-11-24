@extends('user_layout.master')
@section('content')
<style>
    .mission_text h2{
        float: left;
        display:contents;
    }
</style>
    <?php $aboutdata = App\Models\AboutUsContent::Class::all(); ?>
    @if($aboutdata)
    <section class="about_sec">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">About us</a></li>
                </ol>
            </nav>

            <div class="mission_data">
                <div class="mission_data_head">
                    @foreach ($aboutdata as $data)
                    @if ($data->key == 'upper-text-title')
                    <?php echo $data->value; ?>
                    @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mission_text left ">
                            @foreach($aboutdata as $data)
                            @if($data->key == 'upper-text-left')
                            <?php echo $data->value; ?>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mission_text right">
                            @foreach($aboutdata as $data)
                            @if($data->key == 'upper-text-right')
                            <?php echo $data->value; ?>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video_sec p-110">
        <div class="container">
            <div class="video_wrapper">
                <div class="video-box video_show">
                    @foreach ($aboutdata as $data)
                        @if ($data->key == 'video-link')
                            <iframe src="{{ $data->value }}" frameborder="0" allowfullscreen="" style="display: none;"
                                loading="lazy"></iframe>
                        @endif

                        @if ($data->key == 'video-image')
                            <div class="video-thumb" style="background-image: url({{ asset('/siteMeta/' . $data->value) }});">
                                <div class="video-icon video_click">
                                    <a href="#" class="video-icon">
                                        <i class="fa-solid fa-play"></i>
                                        <span class="animate-ping"></span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            
              
                    <div class="row contact-wrappers">
                        @foreach ($aboutdata as $data)
                        @if($data->key == 'video-text-title')
                        <div class="col-md-4">
                            <div class="long-head">
                              <?php echo $data->value ?>
                            </div>
                        </div>
                        @endif
                        @if ($data->key == 'video-text')
                        <div class="col-md-8">
                            <div class="long-text">
                              
                                <?php echo $data->value ?>

                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
           
           

        </div>
    </section>
    <?php 
    $logo = App\Models\Logo::where('status',1)->get();
    $availableLogo = count($logo);
    ?>
    <section class="counter">
        <div class="container">
            <div class="counter_wrapp">
                <div class="counter_dflex">
                    <div class="counter_box">
                        <h2 data-max="{{ $availableLogo }}">+</h2>
                        <span>Logos available</span>
                    </div>
                    <div class="counter_box">
                        <h2 data-max="2000">+</h2>
                        <span>Designers</span>
                    </div>
                    <div class="counter_box">
                        <h2 data-max="20">+</h2>
                        <span>Countries</span>
                    </div>
                    <!-- <div class="counter_box">
                        <h2>24/7</h2>
                        <span>26 Languages Support</span>
                    </div> -->
                    <div class="counter_box">
                        <h2 data-max="100000">+</h2>
                        <span>Logos sold</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@foreach ($aboutdata as $data )

@if($data->key == 'join-us-image')
    <section class="join-logo-sec" style="background-image: url('{{ asset('/siteMeta/'.$data->value) }}');">
@endif
@endforeach
        <div class="container">
            @foreach ($aboutdata as $data)
                @if ($data->key == 'join-us')
                    <div class="join-logo-text about_work">
                        <div class="went_text">
                            <?php echo $data->value; ?>

                        </div>
                        <div class="about_btn">
                            <a href="">Join Us</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <section class="contact_wrapper p-110">
        <div class="container">
            <div class="contact-head">
                @foreach ($aboutdata as $data)
                    @if ($data->key == 'contact-us')
                        <?php echo $data->value; ?>
                    @endif
                @endforeach
                <div class="share-icon">
                    @foreach ($aboutdata as $data)
                        @if ($data->key == 'facebook-link')
                            <a href="{{ $data->value }}"> <i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if ($data->key == 'pinterest-link')
                            <a href="{{ $data->value }}"><i class="fa-brands fa-pinterest-p"></i></a>
                        @endif
                        @if ($data->key == 'instagram-link')
                            <a href="{{ $data->value }}"> <i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if ($data->key == 'linked-in-link')
                            <a href="{{ $data->value }}"> <i class="fa-brands fa-linkedin-in"></i></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
