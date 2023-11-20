@extends('user_layout/master')
@section('content')
<style>
    .new_div {
        width: 20%;
        max-width: inherit;
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* border-bottom: 1px solid #E3E9ED; */
        margin-right: 30px;
        padding-left: 0px;
        cursor: pointer;
    }

    .new_div.filter_full {
        /* width: 15%; */
        border: none;
    }

    .filtter-button {
        float: right;
    }
    .filter-title {
        width: 100%;
    }
</style>
            <?php 
            if(isset($_GET['categories'])){

                $filterCategories = $_GET['categories'];

            }else{
                $filterCategories = json_encode([]);
            }
            

            if(isset($_GET['styles'])){
                $filterStyles = $_GET['styles'];
            }else{
                $filterStyles = json_encode([]);
            }

            if(isset($_GET['tags'])){
                

                $filterTags = $_GET['tags'];

            }else{
                $filterTags = "";
            }
            if(isset($_GET['search'])){
                $filterSearch = $_GET['search'];
            }else{
                $filterSearch = '';
            }
          
            ?>

<section class="filter-sec">
            <div class="container-fluid">
                <div class="filter-content">
                    <div class="new_div ">
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
                    <!--  -->
                    <div class="filter-main-button">
                        <button class="filter-collapse">
                            <img src="{{ asset('logomax-front-asset/img/filtter-img.png') }}" alt="">
                            <span>
                                Filters <span class="badge badge--blue">1</span>
                            </span>
                        </button>
                    </div>
                    </div>
                    <!--  -->
                    <div class="">
                        <div class="">
                            <div class="">
                                <div class="">
                                    <?php $selctedtag = json_decode($filterTags);
                                    $values = ['All logos','Low-priced logos','Premium logos'];
                                    ?>
                                       <label for="alllogos">
                                            <div class="filtr_box filter-box @if($filterTags == "") selected @endif">
                                                <a id="test" value="">All Logos</a>
                                            </div>
                                        </label>
                                        <label for="low-priced">
                                            <div class="filtr_box filter-boxlow-price @if($filterTags == '"low-price"') selected @endif">
                                                <a id="lowpriced" value="low-priced">Low-priced logos</a>
                                            </div>
                                        </label>
                                        
                                        <label for="premium">
                                            <div class="filtr_box filter-boxpremium @if($filterTags == '"premium"') selected @endif">
                                                <a id="test" value="premium">Premium logos</a>
                                            </div>
                                        </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                         <input type="radio" name="tags" id="alllogos" class="tags" value="" style="display:none;" >
                        <input type="radio" name="tags" id="low-priced" class="tags" value="low-price" style="display:none;">
                        <input type="radio" name="tags" id="premium" class="tags" value="premium" style="display:none;" >
                    
                <div class="search_sec">
                    <div class="work_data">
                        <div class="search_style_wrapp">
                            <div class="search_head">
                                <p>Search by Icons</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="search_content">
                                <form><?php $styleSelected = json_decode($filterStyles); ?>
                                    @foreach($styles as $style)
                                    <div class="custom_check">
                                        <label for="style{{ $style->slug ?? '' }}">{{ $style->name ?? '' }}</label>
                                        <input class="styles" id="style{{ $style->slug ?? '' }}" name="styles[]" type="checkbox" value="{{ $style->slug ?? '' }}" <?php if(in_array($style->slug,$styleSelected)){ echo 'checked'; } ?> />
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
                                    <?php $categoriesSlected = json_decode($filterCategories) ?>
                                    @foreach($categories as $category)
                                    <div class="custom_check">
                                        <label for="category{{ $category->slug ?? '' }}">{{ $category->name ?? '' }}</label>
                                        <input id="category{{ $category->slug ?? '' }}" class="category" name="categories" type="checkbox" value="{{ $category->slug ?? '' }}" <?php if(in_array($category->slug,$categoriesSlected)){ echo 'checked'; } ?>  />
                                    </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <!-- <div class="search_style_wrapp category">
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
                        </div> -->
                        <div class="filter-btn <?php  if(!$_GET){
               echo 'd-none';
            } ?>">
                            <a href="{{ url('logos/search') }}"><button>Clear Filters</button></a>
                        </div>
                    </div>

                    <div class="show_logo">
                        <div class="logo_head"> 
                            <h2 class="text-left"> <span class="logo_search_text"> @if($filterSearch == '')Find Unique & Exclusive @else  {{ $filterSearch ?? '' }}  @endif</span> Logos</h2>
                            <span class="ml-3"> <span class="logos_count">{{ count($logos) ?? 0 }}</span> resultados</span>
                        </div>
                        <div class="row" id="logo_html_row">
                            @foreach($logos as $logo)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="logo_img">
                                   <a href="{{ url('logo/'.$logo->logo_slug) }}"> <img src="{{ asset('logos/') }}/{{ $logo->media['image_name'] ?? '' }}" alt="" /></a>
                                   <?php 
                                    if(Auth::check()){
                                        $wishlistItem = App\Models\Wishlist::class::where('user_id','=',auth()->user()->id)->get(); 
                                    }
                                  ?>
                                    <div class="heart_icon add_to_wishlist" id="logo_wish_{{ $logo->id }}" logo_id="{{ $logo->id }}">
                                        <?php 
                                        $logoIdsInWishlist = array();
                                            if(isset($wishlistItem) && count($wishlistItem) > 0){
                                                $logoIdsInWishlist = $wishlistItem->pluck('logo_id')->all();
                                                if(in_array($logo->id,$logoIdsInWishlist)){ ?>
                                                    <i class="fa-solid fa-heart"></i>
                                                <?php }else{ ?>
                                                    <i class="fa-regular fa-heart"></i>
                                                <?php } ?>
                                            <?php }else{?>
                                                <i class="fa-regular fa-heart"></i>
                                            <?php }  ?>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                       <?php
                       $filterSearchEncoded = urlencode($filterSearch);
                       $filterCategoriesEncoded = urlencode($filterCategories);
                       $filterTagsEncoded = urlencode($filterTags);
                       $filterStyleEncoded = urlencode($filterStyles);
                      
                       ?>
                        <div class="next-button">
                        @if ($logos->hasPages())
                            <div class="page-btn">
                           
                                
                                @if ($logos->onFirstPage())
                                <div class="arrow-bt">
                                    <a><i class="fa-solid fa-arrow-left"></i> Prev Page </a>
                                @else
                                <div class="arrow-bt black">
                                    <a href="{{ url('/logos/?search='.$filterSearchEncoded.'&categories='.$filterCategoriesEncoded.'&styles='.$filterStyleEncoded.'&tags='.$filterTagsEncoded.'&page=') }}{{ $logos->currentPage()-1 }}"><i class="fa-solid fa-arrow-left"></i> Prev Page </a>
                                @endif
                                </div>
                                
                                @if ($logos->hasMorePages())
                                <div class="arrow-bt black">
                                    <a href="{{ url('/logos/search?search='.$filterSearchEncoded.'&categories='.$filterCategoriesEncoded.'&styles='.$filterStyleEncoded.'&tags='.$filterTagsEncoded.'&page=') }}{{ $logos->currentPage()+1 }}">Next Page <i class="fa-solid fa-arrow-right"></i></a>
                                @else
                                <div class="arrow-bt">
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
                            @endif
                        </div>
                      
                    </div>
                </div>
            </div>
        </section>
          
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
      
        $(document).ready(function(){
            categories = <?php print_r($filterCategories); ?>;
            styles = <?php print_r($filterStyles); ?>;
            tags = '<?php print_r($filterTags); ?>';
            searchvalue = $('input[name="search_field"]').val();
            $('input[name="search_field"]').on('keyup',function(){
                searchvalue = $(this).val();
                // console.log(value);
                $('span.logo_search_text').html(searchvalue);
                if(searchvalue == ""){
                    $('span.logo_search_text').html('Find Unique & Exclusive');
                }
                let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));
                window.history.replaceState(stateObj, 
                        "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring);
                        search = ajaxRequest(searchvalue,categories,styles,tags);
            });
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
                        "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring);
                ajaxReque = ajaxRequest(searchvalue,categories,styles,tags);
               
            
            });
            $('input.styles').on('change',function(){
                // console.log($('input[name="styles[]"]').val());
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
                        "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring);
                ajaxReques = ajaxRequest(searchvalue,categories,styles,tags);
            });
            $('input.tags').on('change',function(){
                tagvalue = $(this).val();
                // console.log(tagvalue);
                $('.filtr_box').removeClass('selected');
                 if($(this).prop('checked') == true){
                    // tags = [];
                    tags = tagvalue;  
                    $('.filter-box'+tagvalue).addClass('selected');
                 }else{
                    tags = jQuery.grep(tags, function(value) {
                            return value != tagvalue;
                    });
                    $('.filter-box'+tagvalue).removeClass('selected');

                 }
                 let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));

                    window.history.replaceState(stateObj, 
                        "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring);

                ajax = ajaxRequest(searchvalue,categories,styles,tags);

            
            });
        });

    function ajaxRequest(searchvalue,categories,styles,tags){
        let categoriesString = encodeURIComponent(JSON.stringify(categories));
        let stylestring = encodeURIComponent(JSON.stringify(styles));
        let tagsstring = encodeURIComponent(JSON.stringify(tags));

        $.ajax({
            method: 'post',
            url: '{{ url('logo-filter') }}',
            data: { categories:categories,styles:styles,tags:tags,searchvalue:searchvalue,_token:'{{ csrf_token() }}' },
            success: function(response){
                $('span.logos_count').html(response['data'].length);
                // console.table(response[0]['media']);
                $('.filter-btn').removeClass('d-none');
                append_html = [];
                $.each(response['data'], function(key,value){
                    let logoIdsInWishlist = [];
                    @if(isset($logoIdsInWishlist))
                    logoIdsInWishlist = <?php echo json_encode($logoIdsInWishlist); ?>;
                    @endif
                    
                    let heartIconClass = '';
                    heartIconClass = 'fa-regular';
                    $.each(logoIdsInWishlist,function(ind,val){
                        if(value.id == val){
                            heartIconClass = 'fa-solid';
                        }
                    });
                    if(value.in_whishlist !== undefined && value.in_whishlist !== null){
                        heartIconClass = 'fa-solid';
                    }else{
                        heartIconClass = 'fa-regular';
                    }
                    html = '<div class="col-xl-3 col-lg-4 col-md-6"><div class="logo_img"><a href="{{ url('logo/') }}/'+value.logo_slug+'"> <img src="{{ asset('logos/') }}/'+value['media'].image_name+'" alt="" /></a><div class="heart_icon add_to_wishlist" id="logo_wish_'+value.id+'" logo_id="'+value.id+'"><i class="'+ heartIconClass +' fa-heart"></i></div></div></div>';
                    // console.log(html);
                    append_html.push(html);
                })
                $('#logo_html_row').html(append_html);
                if(response['last_page'] > 1){
                    paginationhtml = '<div class="page-btn"><div class="arrow-bt"><a><i class="fa-solid fa-arrow-left"></i> Prev Page </a></div><div class="arrow-bt black"><a href="{{ url('logos/search') }}?search='+searchvalue+'&categories='+categoriesString+'&styles='+stylestring+'&tags='+tagsstring+'&page='+(response['current_page']+1)+'">Next Page <i class="fa-solid fa-arrow-right"></i></a></div></div><div class="page_next"><nav aria-label="Page navigation example"><ul class="pagination"><li class="page-item"><a class="page-link" href="#">Page</a></li><li class="page-item"><a class="page-link one" href="#">'+response['current_page']+'</a></li><li class="page-item"><a class="page-link" href="#">of '+response['last_page']+'</a></li></ul></nav></div>';
                    $('.next-button').html(paginationhtml);
                }else{
                    $('.next-button').html('');
                }
            }
        });
    }      
    
    $(document).on('click','.add_to_wishlist',function(e){
        e.preventDefault();
        @if(Auth::check())
            let logo_id = $(this).attr('logo_id');
            let user_id = "{{ auth()->user()->id }}";
            let url = "{{ url('add-to-wishlist') }}";
            let objId = 'logo_wish_'+logo_id;
            addToWishlist(logo_id,user_id,url,$(this));
        @else
            Swal.fire({
                title: 'Please Login',
                text: "You have to Login to save this in your wishlist !",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login'
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#exampleloginModal').modal('show');
                }
            })
        @endif
    });
   
    </script> 
@endsection