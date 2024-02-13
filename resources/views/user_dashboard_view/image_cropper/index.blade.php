@extends('user_dashboard_layout.master_layout')
@section('content')
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.css" type="text/css" />
<style>
    cropper-image {
  max-width: 100%;
  height: auto;
}
</style>
<div class="col-lg-4 ">
        <div class="image">
            <img src="" alt="" class="mt-4" >
            </div>
            <div class="form-group ">
                <label class="form-label" for="default"> Upload Logo</label>
                <div class="cropper-div" >
                    <div id="image-cropper" style="border:1px solid #ccc; margin: 5px;"><span class="upload_icon"><i class="fas fa-cloud-upload-alt"></i></span></div>
                    <button type="button" id="cropbutton" class="btn btn-sm btn-success">crop</button>
                    
                </div>
                <div class="d-none"> 
                    <div class="image-viewer"></div>
                    <button type="button" class="btn btn-success btn-sm mt-1" id="downlaod-button">Download</button>
                </div>
            </div>
           
        </div>
</div>
<script>
   var myCropper = cropper(document.getElementById('image-cropper'), {
    area: [ 300, 300 ],
    crop: [ 200, 200 ],
        });
        $(document).ready(function(){
    $('#cropbutton').on('click',function(e){
        // e.preventDefault();
        url = document.getElementById('image-cropper').crop.getCroppedImage().src;
        // console.log(url);
        $('#image-cropper').parent().hide();
        $('.image-viewer').parent().removeClass('d-none');
        $('.image-viewer').html('<img src="'+url+'" height="300px" width="300px">');

    //    console.log(url);
        var base64Image = url;
        $('#imagepath').val(url);
            var imageInput = document.getElementById("imageInput");

            // Create a new File object from the base64 image

            var filename = "image.png";
            dataURL = base64Image;
            var arr = dataURL.split(','), mime = arr[0].match(/:(.*?);/)[1],
                            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                        while (n--) {
                            u8arr[n] = bstr.charCodeAt(n);
            }
            var file = new File([u8arr], filename, { type: mime });
            // Create a FileList object and set it as the input's files
            var fileList = new DataTransfer();

            // console.log(fileList);
            // fileList.items.add(file);
            // console.log(filelist);
            // imageInput.files = fileList.files;



    })
    $('#downlaod-button').on('click',function(){
        let tempLink = document.createElement('a');
        let fileName = `image-resized.jpg`;
        tempLink.download = fileName;
        tempLink.href = url;
        tempLink.click();
        console.log(tempLink);

    });
})
</script>
@endsection