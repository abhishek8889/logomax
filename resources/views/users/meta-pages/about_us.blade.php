@extends('user_layout.master')
@section('content')
<section class="about_sec">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">About US</a></li>
                    </ol>
                </nav>
                <?php $data = App\Models\AboutUsContent::class::all()->pluck('value', 'key'); ?>
                <div class="mission_data">
                    <?php //echo $data->value; ?>
                    <div class="mission_data_head">
                        <h2>Our mission</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mission_text right">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                    release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mission_text left">
                                <p>
                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                                    distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default
                                    model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy
                                </p>
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
                        <iframe src="https://www.youtube.com/embed/M2kSJbLbIgQ" frameborder="0" allowfullscreen="" style="display: none;" loading="lazy"></iframe>
                        <div class="video-thumb" style="background-image: url({{ asset('logomax-front-asset/img/video-img.png') }});">
                            <div class="video-icon video_click">
                                <a href="#" class="video-icon">
                                    <i class="fa-solid fa-play"></i>
                                    <span class="animate-ping"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row contact-wrappers">
                    <div class="col-md-4">
                        <div class="long-head">
                            <h2>Who we are</h2>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="long-text">
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
                                letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a
                                search for 'lorem ipsum' will uncover many web sites still in their infancy
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="counter">
            <div class="container">
                <div class="counter_wrapp">
                    <div class="counter_dflex">
                        <div class="counter_box">
                            <h2 data-max="263">M+</h2>
                            <span>Files</span>
                        </div>
                        <div class="counter_box">
                            <h2 data-max="100">K+</h2>
                            <span>Contributors</span>
                        </div>
                        <div class="counter_box">
                            <h2 data-max="36">M</h2>
                            <span>Clients Worldwide</span>
                        </div>
                        <div class="counter_box">
                            <h2>24/7</h2>
                            <span>26 Languages Support</span>
                        </div>
                        <div class="counter_box">
                            <h2 data-max="450">+</h2>
                            <span>Professionals</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="join-logo-sec" style="background-image: url('{{ asset('logomax-front-asset/img/signup-bg 1.png') }}');">
            <div class="container">
                <div class="join-logo-text about_work">
                    <div class="went_text">
                        <h2>Want to work with us?</h2>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                            it.
                        </p>
                    </div>
                    <div class="about_btn">
                        <a href="">Join Us</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact_wrapper p-110">
            <div class="container">
                <div class="contact-head">
                    <h2>Contact Us</h2>
                    <p>
                        Send us your questions, comments, or suggestions and we will address them as quickly as possible. You can also check out our Help Center. Have another question? Contact us and we will get back to you as quickly as
                        possible
                    </p>
                    <div class="share-icon">
                        <a href="#"> <i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                        <a href="#"> <i class="fa-brands fa-instagram"></i></a>
                        <a href="#"> <i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </section>
@endsection