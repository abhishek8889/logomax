@extends('user_dashboard_layout.master_layout')
@section('content')
<!-- <div class="">
    {{-- Breadcrumbs::render('favourites') --}}
</div> -->
@if($wishlist->isNotEmpty())
<div class="my-fav niks-my-fav">
    <h3>My Favorites</h3>
    <!-- Table  -->
    <table>
        <tr>
            <th>Product Name</th>
            <th></th>
        </tr>
            @foreach($wishlist as $list)
                @if($list->logos->status == 1)
                <tr id="list{{ $list->id ?? '' }}">
                    <td>
                        <div class="img-box">
                            <a href="{{ url(app()->getlocale().'/logo/'.$list->logos->logo_slug ?? '') }}">
                                @if($list->logos->media->directory_name != null || $list->logos->media->directory_name != "")
                                    <img src="{{ asset('LogoDirectory/'.$list->logos->media->directory_name.'/'.$list->logos->media->directory_name.'.png') }}" class="img-fluid" alt="">
                                @else
                                    <img src="{{ asset($list->logos->media->image_path) }}" alt="" />
                                @endif
                            </a>
                            <div class="p-text inr-text">{{ $list->logos->logo_name ?? '' }}</div>
                        </div>
                    </td>
                
                    <td>
                        <div class="heart-i p-cntr inr-text remove_btn" data-id ="{{ $list->id ?? '' }}" style="cursor:pointer;"><i class="fas fa-times"></i></div>
                    </td>
                </tr>
                @endif
            @endforeach
    </table>
    <!--  Table end  -->
</div>
@else
<h4>You don't have any logos in your whishlist</h4>
@endif
<script>
$('.remove_btn').on('click',function(){
    id = $(this).attr('data-id');
    $.ajax({
        method: 'post',
        url: '{{ url('user-dahsboard/removeWhislist') }}',
        data: { id:id,_token:"{{ csrf_token() }}" },
        datatype: 'json',
        success: function(response){
            if(response.success){
                $('#list'+id).hide();
                iziToast.success({
                message: response.success,
                position: 'topRight'
                });
            }else{
                iziToast.error({
                message: response.error,
                position: 'topRight'
                });
            }
        }
    })
});
</script>
@endsection
