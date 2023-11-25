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

            if(isset($_GET['branches'])){
                $filterBranches = $_GET['branches'];
            }else{
                $filterBranches = json_encode([]);
            }

            if(isset($_GET['styles'])){
                $filterStyles = $_GET['styles'];
            }else{
                $filterStyles = json_encode([]);
            }

            // if(isset($_GET['branch']))

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
            if(isset($_GET['realtags'])){
                $filterRealTags = $_GET['realtags'];
            }else{
                $filterRealTags = '';
            }

          
            ?>

<section class="filter-sec">
            <div class="container-fluid">
                <input type="radio" name="tags" id="alllogos" class="tags" value="" style="display:none;" >
                <input type="radio" name="tags" id="low-priced" class="tags" value="low-price" style="display:none;">
                <input type="radio" name="tags" id="premium" class="tags" value="premium" style="display:none;" >   
                <div class="search_sec">
                        <div class="work_data">
                            <!--  -->
                            <div class="new_div_new ">
                                <div class="filter-title">
                                    <div class="filter-img">
                                        <img src="{{ asset('logomax-front-asset/img/filter.svg') }}" alt="" />
                                        <p>Filters</p>
                                    </div>
                                    <div class="filtter-button">
                                        <button>
                                            <img src="{{ asset('logomax-front-asset/img/filter-image-2.svg') }}" alt="" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <!-- Filter seclect section -->
                            <div id="filtered_attr" class="selected-filter-wrap">
                                <?php $decodefiltercategories = json_decode($filterCategories); ?>
                                @foreach($decodefiltercategories as $cat)
                                <?php 
                                    $categorymodal = App\Models\Categories::class;
                                    if($categorymodal){
                                        $categ = $categorymodal::where('slug',$cat)->first();
                                    }
                                ?>
                                @if(isset($categ))
                                    <label id="selectedcat{{ $categ->slug ?? '' }}">
                                        <div class="filtr_box ">
                                            <a slug="{{ $categ->slug ?? '' }}" >{{ $categ->name ?? '' }} </a><a class="removecat" slug="{{ $categ->slug }}" ><i class="fas fa-times"></i></a>
                                        </div>
                                    </label>
                                @endif
                                @endforeach

                                <?php $decodefilterbranch = json_decode($filterBranches); ?>
                                @foreach($decodefilterbranch as $branchfiltered)
                                <?php 
                                $categorymodal = App\Models\Branch::class;
                                if($categorymodal){
                                    $branchhhh = $categorymodal::where('slug',$branchfiltered)->first();
                                }
                                ?>
                                @if(isset($branchhhh))
                                    <label id="selectedbranch{{ $branchhhh->slug ?? '' }}">
                                        <div class="filtr_box filter-box">
                                            <a slug="{{ $branchhhh->slug ?? '' }}" >{{ $branchhhh->name ?? '' }} </a><a class="removebranch" slug="{{ $branchhhh->slug }}" ><i class="fas fa-times"></i></a>
                                        </div>
                                    </label>
                                @endif
                                @endforeach

                                <?php $decodefilterstyle = json_decode($filterStyles); ?>
                                @foreach($decodefilterstyle as $filteredstyle)
                                <?php 
                                $stylemodal = App\Models\Style::class;
                                if($stylemodal){
                                    $styleeee = $stylemodal::where('slug',$filteredstyle)->first();
                                }
                                ?>
                                @if(isset($styleeee))
                                    <label id="selectedstyle{{ $styleeee->slug ?? '' }}">
                                        <div class="filtr_box filter-box">
                                            <a slug="{{ $styleeee->slug ?? '' }}" >{{ $styleeee->name ?? '' }} </a><a class="removestyle" slug="{{ $styleeee->slug }}" ><i class="fas fa-times"></i></a>
                                        </div>
                                    </label>
                                @endif
                                @endforeach
                            </div>
                        <!-- End -->
                        <div class="search_style_wrapp category">
                            <div class="search_head">
                                <p>Filter by Category</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="search_content search-list-container " id="search-cat-list">
                                <form>
                                    <?php $categoriesSlected = json_decode($filterCategories) ?>
                                    @foreach($categories as $ind => $category)
                                    <div class="custom_check search-list-item">
                                        <label for="category{{ $category->slug ?? '' }}">{{ $category->name ?? '' }}</label>
                                        <input id="category{{ $category->slug ?? '' }}" class="category" name="categories" type="checkbox" categoryname = "{{ $category->name ?? '' }}" value="{{ $category->slug ?? '' }}" <?php if(in_array($category->slug,$categoriesSlected)){ echo 'checked'; } ?>  />
                                    </div>
                                    @endforeach
                                    <a href="javascript:void(0)" class="show-more-btn close-list" for="cat">Show more <span><i class="fa-solid fa-angle-down"></i></span></a> 
                                </form>
                            </div>
                        </div>
                        <div class="search_style_wrapp branches ">
                            <div class="search_head">
                                <p>Filter by Branch</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="search_content search-list-container" id="search-branch-list">
                                <form><?php $branchesSelected = json_decode($filterBranches); ?>
                                    @foreach($allbranches as $ind => $branch)
                                    <div class="custom_check search-list-item">
                                        <label for="branch{{ $branch->slug ?? '' }}">{{ $branch->name ?? '' }}</label>
                                        <input class="branches" id="branch{{ $branch->slug ?? '' }}" name="branch[]" branchname="{{ $branch->name ?? '' }}" type="checkbox" value="{{ $branch->slug ?? '' }}" <?php  if(in_array($branch->slug,$branchesSelected)){ echo 'checked'; } ?> />
                                    </div>
                                    @endforeach
                                    <a href="javascript:void(0)" class="show-more-btn close-list" for="branch">Show more <span><i class="fa-solid fa-angle-down"></i></span></a>
                                </form>
                            </div>
                        </div>
                        <div class="search_style_wrapp ">
                            <div class="search_head">
                                <p>Filter by Logomark</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="search_content search-list-container"  id="search-logomark-list">
                                <form><?php $styleSelected = json_decode($filterStyles); ?>
                                    @foreach($styles as $ind => $style)
                                    <div class="custom_check search-list-item">
                                        <label for="style{{ $style->slug ?? '' }}">{{ $style->name ?? '' }}</label>
                                        <input class="styles" id="style{{ $style->slug ?? '' }}" name="styles[]" type="checkbox" stylename="{{ $style->name ?? '' }}" value="{{ $style->slug ?? '' }}" <?php if(in_array($style->slug,$styleSelected)){ echo 'checked'; } ?> />
                                    </div>
                                    @endforeach
                                    <a href="javascript:void(0)" class="show-more-btn close-list" for="logomark">Show more <span><i class="fa-solid fa-angle-down"></i></span></a>
                                </form>

                            </div>
                        </div>
                        <div class="filter-btn <?php  if(!$_GET){
                            echo 'd-none';
                            } ?>">
                            <a href="{{ url('logos/search') }}"><button>Clear Filters</button></a>
                        </div>
                    </div>
                        <?php 
                        $totalFiltercount = 0;
                        if($_GET){ 
                            $categoriesCount = $stylesCount = $tagsCount = $branchCount = 0;
                            if(isset($_GET['categories'])){
                                $categoriesCount  =  count(json_decode($_GET['categories']));
                            }
                            if(isset($_GET['styles'])){
                                $stylesCount = count(json_decode($_GET['styles']));
                            }
                            if(isset($_GET['realtags'])){
                                $tagsCount = count(json_decode($_GET['realtags']));
                            }
                            if(isset($_GET['branches'])){
                                $branchCount = count(json_decode($_GET['branches']));
                            }
                            $totalFiltercount = $categoriesCount + $stylesCount + $tagsCount + $branchCount;
                        }
                        ?>
                    <div class="show_logo">
                        <!-- Filter bar -->
                        <!--  -->
                        
                        <div class="closed-filter-wrap">
                            <div class="filter-main-button" style="cursor:pointer;">
                                <button class="filter-collapse" style="cursor:pointer;">
                                    <img src="{{ asset('logomax-front-asset/img/filter.svg') }}" alt="">
                                    <span style="cursor:pointer;">
                                        Filters <span class="badge badge--blue" id="counttotalfilter">{{ $totalFiltercount }}</span>
                                    </span>
                                </button>
                            </div>
                            <div class="filter-bar">
                                <?php $selctedtag = json_decode($filterTags);
                                $values = ['All logos','Low-priced logos','Premium logos'];
                                ?>
                                <label for="alllogos">
                                    <div class="filtr_box filter-box @if($filterTags == "") selected @endif">
                                        <a id="test" value="">All logos</a>
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
                        <!-- End -->
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
                        $filterBranchesEncoded = urlencode($filterBranches);
                       ?>
                        <div class="next-button">
                        @if ($logos->hasPages())
                            <div class="page-btn">
                                @if ($logos->onFirstPage())
                                <div class="arrow-bt">
                                    <a><i class="fa-solid fa-arrow-left"></i> Prev Page </a>
                                @else
                                <div class="arrow-bt black">
                                    <a href="{{ url('/logos/?search='.$filterSearchEncoded.'&categories='.$filterCategoriesEncoded.'&styles='.$filterStyleEncoded.'&tags='.$filterTagsEncoded.'&branches='.$filterBranchesEncoded.'&page=') }}{{ $logos->currentPage()-1 }}"><i class="fa-solid fa-arrow-left"></i> Prev Page </a>
                                @endif
                                </div>
                                @if ($logos->hasMorePages())
                                <div class="arrow-bt black">
                                    <a href="{{ url('/logos/search?search='.$filterSearchEncoded.'&categories='.$filterCategoriesEncoded.'&styles='.$filterStyleEncoded.'&tags='.$filterTagsEncoded.'&branches='.$filterBranchesEncoded.'&page=') }}{{ $logos->currentPage()+1 }}">Next Page <i class="fa-solid fa-arrow-right"></i></a>
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
            tags = '<?php print_r(str_replace('"',"",$filterTags)); ?>';
            branches = <?php print_r($filterBranches); ?>; 
          
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
                let tagsstring = encodeURIComponent(tags);
                let branchstring = encodeURIComponent(JSON.stringify(branches));

                window.history.replaceState(stateObj, "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);
                search = ajaxRequest(searchvalue,categories,styles,tags,branches);
            });
            $('input.category').on('change',function(){
                val = $(this).val();
                name = $(this).attr('categoryname');
                htmlappend = '<label id="selectedcat'+val+'"><div class="filtr_box filter-box"><a slug="'+val+'" >'+name+' </a><a class="removecat" slug="'+val+'" ><i class="fas fa-times"></i></a></div></label>';
               
                totalfiltersvalues = parseInt($('#counttotalfilter').html());
                
                if($(this).prop('checked') == true){
                    categories.push(val);
                    $('#filtered_attr').append(htmlappend);
                    $('#counttotalfilter').html(totalfiltersvalues+1);
                }else{
                    $('#counttotalfilter').html(totalfiltersvalues-1);
                    $('#selectedcat'+val).remove();
                    categories = jQuery.grep(categories, function(value) {
                            return value != val;
                            }); 
                }
                let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));
                let branchstring = encodeURIComponent(JSON.stringify(branches));

                window.history.replaceState(stateObj, 
                        "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);
                ajaxReque = ajaxRequest(searchvalue,categories,styles,tags,branches);
               
            });

                ///remove category
                $("body").delegate('.removecat','click',function(e){
                        e.preventDefault();
                        slug = $(this).attr('slug');
                        totalfiltersvalues = parseInt($('#counttotalfilter').html());
                        $('#counttotalfilter').html(totalfiltersvalues-1);
                        categories = jQuery.grep(categories, function(value) {
                                            return value != slug;
                                    });
                                    let stateObj = { id: "100" }; 
                        let categoriesString = encodeURIComponent(JSON.stringify(categories));
                        let stylestring = encodeURIComponent(JSON.stringify(styles));
                        let tagsstring = encodeURIComponent(JSON.stringify(tags));
                        let branchstring = encodeURIComponent(JSON.stringify(branches));

                        window.history.replaceState(stateObj, 
                                "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);
                        ajaxReque = ajaxRequest(searchvalue,categories,styles,tags,branches);
                        $('#selectedcat'+slug).remove();
                        $('input.category[value="'+slug+'"]').prop('checked',false);
                    });

            $('input.styles').on('change',function(){
                // console.log($('input[name="styles[]"]').val());
                styleval = $(this).val();
                stylename = $(this).attr('stylename');
                stylehtml = '<label id="selectedstyle'+styleval+'"><div class="filtr_box filter-box"><a slug="'+styleval+'" >'+stylename+' </a><a class="removestyle" slug="'+styleval+'" ><i class="fas fa-times"></i></a></div></label>';
                totalfiltersvalues = parseInt($('#counttotalfilter').html());
                if($(this).prop('checked') == true){
                    styles.push(styleval);  
                    $('#filtered_attr').append(stylehtml);
                    $('#counttotalfilter').html(totalfiltersvalues+1);
                }else{
                    styles = jQuery.grep(styles, function(value) {
                            return value != styleval;
                    });
                    $('#selectedstyle'+styleval).remove();
                    $('#counttotalfilter').html(totalfiltersvalues-1);
                }
                let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));
                let branchstring = encodeURIComponent(JSON.stringify(branches));

                window.history.replaceState(stateObj, 
                        "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);
                ajaxReques = ajaxRequest(searchvalue,categories,styles,tags,branches);
            });

            ///removestyle
            $("body").delegate('.removestyle','click',function(e){
                        e.preventDefault();
                        totalfiltersvalues = parseInt($('#counttotalfilter').html());
                        $('#counttotalfilter').html(totalfiltersvalues-1);
                        slug = $(this).attr('slug');
                        styles = jQuery.grep(styles, function(value) {
                                            return value != slug;
                                    });
                                    let stateObj = { id: "100" }; 
                        let categoriesString = encodeURIComponent(JSON.stringify(categories));
                        let stylestring = encodeURIComponent(JSON.stringify(styles));
                        let tagsstring = encodeURIComponent(JSON.stringify(tags));
                        let branchstring = encodeURIComponent(JSON.stringify(branches));

                        window.history.replaceState(stateObj, 
                                "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);
                        ajaxReque = ajaxRequest(searchvalue,categories,styles,tags,branches);
                        $('#selectedstyle'+slug).remove();
                        $('input.styles[value="'+slug+'"]').prop('checked',false);
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
                let branchstring = encodeURIComponent(JSON.stringify(branches));

                window.history.replaceState(stateObj,"filter","{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);

                ajax = ajaxRequest(searchvalue,categories,styles,tags,branches);
            });
            $('input.branches').on('change',function(){
                branchvalue = $(this).val();
                branchname = $(this).attr('branchname');
                branchhtml = '<label id="selectedbranch'+branchvalue+'"><div class="filtr_box filter-box"><a slug="'+branchvalue+'" >'+branchname+' </a><a class="removebranch" slug="'+branchvalue+'" ><i class="fas fa-times"></i></a></div></label>';
                totalfiltersvalues = parseInt($('#counttotalfilter').html());
                if($(this).prop('checked') == true){
                    $('#counttotalfilter').html(totalfiltersvalues+1);
                    branches.push(branchvalue);
                    $('#filtered_attr').append(branchhtml);  
                }else{
                    $('#counttotalfilter').html(totalfiltersvalues-1);
                    branches = jQuery.grep(branches, function(value) {
                            return value != branchvalue;
                    });  
                    $('#selectedbranch'+branchvalue).remove();
                }
                let stateObj = { id: "100" }; 
                let categoriesString = encodeURIComponent(JSON.stringify(categories));
                let stylestring = encodeURIComponent(JSON.stringify(styles));
                let tagsstring = encodeURIComponent(JSON.stringify(tags));
                let branchstring = encodeURIComponent(JSON.stringify(branches));

                window.history.replaceState(stateObj,"filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);
                ajaxReques = ajaxRequest(searchvalue,categories,styles,tags,branches);
            
            });
                ////removebranch
                         $("body").delegate('.removebranch','click',function(e){
                                    e.preventDefault();
                                    slug = $(this).attr('slug');
                                    totalfiltersvalues = parseInt($('#counttotalfilter').html());
                                    $('#counttotalfilter').html(totalfiltersvalues-1)
                                    branches = jQuery.grep(branches, function(value) {
                                                        return value != slug;
                                                });
                                                let stateObj = { id: "100" }; 
                                    let categoriesString = encodeURIComponent(JSON.stringify(categories));
                                    let stylestring = encodeURIComponent(JSON.stringify(styles));
                                    let tagsstring = encodeURIComponent(JSON.stringify(tags));
                                    let branchstring = encodeURIComponent(JSON.stringify(branches));

                                    window.history.replaceState(stateObj, 
                                            "filter", "{{ url('/logos/search') }}?search="+searchvalue+"&categories="+categoriesString+"&styles="+stylestring+"&tags="+tagsstring+"&branches="+branchstring);
                                    ajaxReque = ajaxRequest(searchvalue,categories,styles,tags,branches);
                                    $('#selectedbranch'+slug).remove();
                                    $('input.branches[value="'+slug+'"]').prop('checked',false);
                                });

        });

      
    
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
                title: 'Please Log in',
                text: "You have to Log in to save this in your wishlist !",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Log In'
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href="{{ url('login') }}";
                }
            })
        @endif
    });
    function setHtml(letterCat){
        console.log(letterCat);
        // $.each(letterCat,function(ind,val){
        //     console.log(ind);
        //     console.log('====================');
        //     console.log(val);
        // });
    }

    /////////////////// Show More Button code  //////////////////////
    function ajaxRequest(searchvalue,categories,styles,tags,branches){
        let categoriesString = encodeURIComponent(JSON.stringify(categories));
        let stylestring = encodeURIComponent(JSON.stringify(styles));
        let tagsstring = encodeURIComponent(JSON.stringify(tags));
        let branchstring = encodeURIComponent(JSON.stringify(branches));

        $.ajax({
            method: 'post',
            url: '{{ url('logo-filter') }}',
            data: { categories:categories,branches:branches,styles:styles,tags:tags,searchvalue:searchvalue,_token:'{{ csrf_token() }}' },
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
                // $("#filtered_attr").load(location.href + " #filtered_attr");
            }
        });
    }    

    $(document).ready(function(){
        var catListContainer = $('#search-cat-list');
        var branchListContainer = $('#search-branch-list');
        var logomarkListContainer = $('#search-logomark-list');
        var initialItemsToShow = 7;
        var showMoreBtn = $(".show-more-btn");

        $('.search-list-item:gt(' + (initialItemsToShow - 1) + ')', catListContainer).hide();
        $('.search-list-item:gt(' + (initialItemsToShow - 1) + ')', branchListContainer).hide();
        $('.search-list-item:gt(' + (initialItemsToShow - 1) + ')', logomarkListContainer).hide();

        showMoreBtn.click(function (e) {
            e.preventDefault();
            var thisBtn = $(this);
            var showFor = $(this).attr('for');
            // Toggle the height of the container to show/hide items
            listContainer = $(`#search-${showFor}-list`);
            listContainer.toggleClass('expanded');

            // Change the button text based on the container height
            var buttonText = listContainer.hasClass('expanded') ? 'Show less <span><i class="fa-solid fa-angle-up"></i></span>' : 'Show more <span><i class="fa-solid fa-angle-down"></i></span>';
            thisBtn.html(buttonText);

            if(thisBtn.hasClass('close-list')){
                thisBtn.removeClass('close-list');
                thisBtn.addClass('open-list');
            }else{
                thisBtn.removeClass('open-list');
                thisBtn.addClass('close-list');
            }

            // Show or hide items based on the container height
            if (listContainer.hasClass('expanded')) {
                $('.search-list-item', listContainer).show();
            } else {
                $('.search-list-item:gt(' + (initialItemsToShow - 1) + ')', listContainer).hide();
            }
        });
    });
    //////////////// Show more button code end //////////////

    
   
    </script> 
@endsection


