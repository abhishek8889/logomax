@extends('user_layout/master')
@section('content')

<section class="filter-sec">
            <div class="container-fluid">
                <div class="filter-content">
                    <div class="filter-title">
                        <div class="filter-img">
                            <img src="{{ asset('logomax-front-asset/img/filtter-img.png') }}" alt="" />
                            <p>Filters</p>
                        </div>
                        <div class="filtter-button">
                            <button>
                                <img src="{{ asset('logomax-front-asset/img/Vector (14).png') }}" alt="" />
                            </button>
                        </div>
                    </div>
                    <div class="fil-slider">
                        <div class="slider-content">
                            <div class="slider-box">
                                <div class="fillter-slider">
                                    @foreach($tags as $tag)
                                       <label for="{{ $tag->slug ?? '' }}">
                                            <div class="filtr_box" >
                                                <a id="test" value="{{ $tag->id ?? '' }}"><i class="fa-sharp fa-light fa-magnifying-glass"></i>{{ $tag->name ?? '' }}</a>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($tags as $tag)
                    <input type="checkbox" name="tags" id="{{ $tag->slug ?? '' }}" class="tags" value="{{ $tag->slug ?? '' }}" style="display:none;">
                    @endforeach
                <div class="search_sec">
                    <div class="work_data">
                        <div class="search_style_wrapp">
                            <div class="search_head">
                                <p>Search by Style</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="search_content">
                                <form>
                                    @foreach($styles as $style)
                                    <div class="custom_check">
                                        <label for="style{{ $style->slug ?? '' }}">{{ $style->name ?? '' }}</label>
                                        <input class="styles" id="style{{ $style->slug ?? '' }}" name="styles" type="checkbox" value="{{ $style->slug ?? '' }}" />
                                    </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>

                        <div class="search_style_wrapp category">
                            <div class="search_head">
                                <p>Search by Category</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="search_content">
                                <form>
                                    @foreach($categories as $category)
                                    <div class="custom_check">
                                        <label for="category{{ $category->slug ?? '' }}">{{ $category->name ?? '' }}</label>
                                        <input id="category{{ $category->slug ?? '' }}" class="category" name="categories" type="checkbox" value="{{ $category->slug ?? '' }}" />
                                    </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <div class="search_style_wrapp category">
                            <div class="search_head">
                                <p>Search by Colors</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="search_content">
                                <ul>
                                    <li style="background: #f5f5dc;"></li>
                                    <li style="background: #000;"></li>
                                    <li style="background: #00f;"></li>
                                    <li style="background: #a52a2a;"></li>
                                    <li style="background: #611e26;"></li>
                                    <li style="background: #c19a6b;"></li>
                                    <li style="background: #811331;"></li>
                                    <li style="background: #6f4e37;"></li>
                                    <li style="background: #008000;"></li>
                                    <li style="background: #808080;"></li>
                                    <li style="background: #f0e68c;"></li>
                                    <li style="background: #000080;"></li>
                                    <li style="background: #ffa500;"></li>
                                    <li style="background: #f00;"></li>
                                    <li style="background: #87ceeb;"></li>
                                    <li style="background: #ffbe00;"></li>
                                    <li style="background: #d50072;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-btn">
                            <button>Clear Filters</button>
                        </div>
                    </div>

                    <div class="show_logo">
                        <div class="logo_head">
                            <h2>Showing All for logo</h2>
                        </div>
                        <div class="row">
                            @foreach($logos as $logo)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="logo_img">
                                   <a href="{{ url('logos-detail/'.$logo->logo_slug) }}"> <img src="{{ asset('logos/') }}/{{ $logo->media['image_name'] ?? '' }}" alt="" /></a>
                                    <div class="heart_icon">
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                       
                        @if ($logos->hasPages())
                        <div class="next-button">
                            <div class="page-btn">
                           
                                <div class="arrow-bt">
                                @if ($logos->onFirstPage())
                                    <a><i class="fa-solid fa-arrow-left"></i> Prev Page </a>
                                @else
                                    <a href="{{ $logos->previousPageUrl() }}"><i class="fa-solid fa-arrow-left"></i> Prev Page </a>
                                @endif
                                </div>
                                <div class="arrow-bt black">
                                @if ($logos->hasMorePages())
                                    <a href="{{ $logos->nextPageUrl() }}">Next Page <i class="fa-solid fa-arrow-right"></i></a>
                                @else
                                    <a>Next Page <i class="fa-solid fa-arrow-right"></i></a>
                                @endif
                                </div>
                            </div>
                            <div class="page_next">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Page</a></li>
                                        <li class="page-item"><a class="page-link one" href="#">{{ $logos->currentPage() ?? '' }}</a></li>
                                        <li class="page-item"><a class="page-link" href="#">of {{ $logos->lastPage() ?? '' }}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function(){
                $('#button-addon5').click(function(){
                    val = $('input[type="search"]').val();
                    url = '{{ url('logos-search?search=') }}'+val;
                    location.href = url;
                });
            })

      
        $(document).ready(function(){
            categories = [];
            styles = [];
            tags = [];
            $('input.category').on('change',function(){
                val = $(this).val();
                if($(this).prop('checked') == true){
                    categories.push(val);
                }else{
                    categories = jQuery.grep(categories, function(value) {
                            return value != val;
                            }); 
                }
                let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));
            window.history.replaceState(stateObj, 
                        "filter", "/logos-search?categories="+categoriesString+"&tags="+stylestring+"&styles="+tagsstring);
            });
            $('input.styles').on('change',function(){
                styleval = $(this).val();
                if($(this).prop('checked') == true){
                    styles.push(styleval);  
                }else{
                    styles = jQuery.grep(styles, function(value) {
                            return value != styleval;
                    });  
                }
                let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));
            window.history.replaceState(stateObj, 
                        "filter", "/logos-search?categories="+categoriesString+"&tags="+stylestring+"&styles="+tagsstring);
           
            });
            $('input.tags').on('change',function(){
                tagvalue = $(this).val();
                 if($(this).prop('checked') == true){
                    tags.push(tagvalue);  
                 }else{
                    tags = jQuery.grep(tags, function(value) {
                            return value != tagvalue;
                    }); 
                 }
                 let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));
            window.history.replaceState(stateObj, 
                        "filter", "/logos-search?categories="+categoriesString+"&tags="+stylestring+"&styles="+tagsstring);
            });
        });
      
//  $(document).ready(function(){
//             let stateObj = { id: "100" }; 
//             window.history.replaceState(stateObj, 
//                         "Page 3", "/page3.html"); 
//  });
      
    </script> 
@endsection