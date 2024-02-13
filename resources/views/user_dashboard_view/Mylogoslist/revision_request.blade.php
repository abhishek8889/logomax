@extends('user_dashboard_layout.master_layout') @section('content')
<style>
    .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .loader img {
        max-width: 120px;
    }

    .loader-box {
        display: none;
        width: 100%;
        height: 100%;
        background: #000;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100000;
        opacity: 72%;
    }

    .approval-btn {
        display: flex;
        margin-top: 25px;
        gap: 10px;
        /* justify-content: center; */
    }

    /* .load-btn {
        text-align: center;
    } */
    .load-btn a {
        display: inline-block;
    }

    .download-btn-head i.fas.fa-file-download {
        color: black;
    }
</style>

<div class="loader-box">
    <div class="loader">
        <img src="{{ asset('logomax-front-asset/img/loading-loading-forever.gif') }}" alt="" />
    </div>
</div>

<div class="checkout-form">
    <h3>Free Logo Customization</h3>
    <!-- Revision Request Page -->
    <form action="{{url(app()->getlocale().'/request-for-revision')}}" method="post" id="customization-form-new"
        enctype="multipart/form-data" class="checkout_from">
        @csrf
        <input type="hidden" name="order_id" value="{{ $orderDetail->id ?? '' }}" />
        @if($request->revision_type == 'logo_revision')
        <input type="hidden" name="type" value="logo" />
        <!-- logo and favicon -->
        <input type="hidden" name="availableRevisionID" value="{{ $receivedParams->availableRevisionID ?? '' }}" />
        @endif @if($request->revision_type == 'favicon_revision')
        <input type="hidden" name="type" value="favicon" />
        <input type="hidden" name="availableRevisionID"
            value="{{ $receivedParams->availableFaviconRevisionID ?? '' }}" />
        @endif

        <div class="tab card">
            <div class="step">
                <h4>Step 1</h4>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-form-label">Company Name<sup>*</sup></label>
                <span class="sub">Which company name should we use?</span>
                <input type="text" class="form-control" name="company_name" id="company_name" />
                <span id="company_name_error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="request_title" class="col-form-label">Subtitle<sup>*</sup></label>
                <span class="sub">Should the Logo contain a subtitle?</span>
                <input type="text" class="form-control" name="request_subtitle" id="request_subtitle" />
                <span id="title_error" class="text-danger"></span>
            </div>
            <div class="form-group">
                <div class="d-flex">
                    <button type="button" class="btn cta next_button">Next</button>
                </div>
            </div>
        </div>
        <div class="tab d-none card">
            <div class="step">
                <h4>Step 2</h4>
            </div>
            <div class="form-group">
                <label for="colors" class="col-form-label">Do you want to change the logo colors?</label>
                <div class="color-opt">
                    <input type="radio" id="yes" name="color" value="yes" onclick="show2()" />
                      <label for="yes">Yes</label>  
                    <input type="radio" id="no" name="color" value="no" onclick="show1()" />
                      <label for="no">No</label><br />
                </div>
                <div class="row color-picker" id="color_picker">
                    <div class="col-4">
                        <input type="text" class="form-control colorpicker" name="colors" id="colors"
                            placeholder="Choose color" />
                    </div>
                    <div class="btn cta" id="save-color" style="display: none">save</div>
                </div>
                <div class="" id="selected-color-box"></div>
            </div>
            <div class="btn-group">
                <div class="form-group">
                    <div class="d-flex">
                        <button type="button" class="btn cta back_button">previous</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex">
                        <button type="button" class="btn cta light next_button">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab d-none card">
            <div class="step">
                <h4>Step 3</h4>
            </div>
            <div class="form-group file-upld ">
                <label for="file" class="col-form-label">Upload file <span>(optional)</span></label>
                <div class="file-box">
                    <label for="file">
                        <div class="file-upload">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <h6>Click here to select your image.</h6>
                        </div>
                    </label>
                    <div id="file-upload-filename" class="files"></div>
                </div>
                <input type="file" class="hide" name="file" id="file" multiple />
                <div class="btn-group">
                    <div class="form-group">
                        <div class="d-flex">
                            <button type="button" class="btn cta back_button">previous</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-flex">
                            <button type="button" class="btn cta light next_button">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab d-none card">
            <div class="step">
                <h4>Step 4</h4>
            </div>
            <div class="form-group">
                <label for="request_desc" class="col-form-label">Description <span>(optional)</span></label>
                <textarea class="form-control" name="request_description" id="request_desc"></textarea>
                <span id="desc_error" class="text-danger"></span>
            </div>
            <div class="btn-group">
                <div class="form-group">
                    <div class="d-flex">
                        <button type="button" class="btn cta back_button">previous</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex">
                        <button type="submit" class="btn cta light">
                            Start Customization
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
<script>
    $(".colorpicker").colorpicker();
</script>

<script>
    // Customization form validation
    $("#customization-form-new").on("submit", function (e) {
        e.preventDefault();
        $("#company_name_error").html("");
        $("#title_error").html("");
        $("#desc_error").html("");
        company_name = $('input[name="company_name"]').val();
        title = $('input[name="request_subtitle"]').val();
        description = $('textarea[name="request_description"]').val();

        if (company_name == "" || company_name == null) {
            $("#company_name_error").html("Company name is required.");
            return false;
        }
        if (title == "" || title == null) {
            $("#title_error").html("Subtitle is required.");
            return false;
        }
        if (description == "" || description == null) {
            $("#desc_error").html("Description is required.");
            return false;
        }

        $(this).off("submit").submit();
    });

    // End

    $(document).ready(function () {
        let selectedColor = "";
        let selectedColorBox = $("#selected-color-box");
        $(".colorpicker").on("changeColor", function (e) {
            e.preventDefault();
            selectedColor = e.color.toString();
            console.log(selectedColor);
            $("#save-color").show();
            console.log("hello");
        });

        $("#save-color").on("click", function (event) {
            event.preventDefault();
            let colorLimit = 5;
            if (
                $("#selected-color-box").find(".color-wrapper").length === colorLimit
            ) {
                if (selectedColorBox.find(".colorSelectLimit").length === 0) {
                    selectedColorBox.append(
                        `<div class="text text-danger colorSelectLimit">You can select only ${colorLimit} colors.</div>`
                    );
                }
                return false;
            } else {
                if (selectedColor !== "") {
                    if (selectedColorBox.find(".colorSelectLimit").length > 0) {
                        selectedColorBox.find(".colorSelectLimit").remove();
                    }
                    let colorList = selectedColor.split("#");
                    let lastColor = `#${colorList[colorList.length - 1]}`;
                    let liElem = `<div class="color-wrapper"><div class="color-box" style="background:${lastColor}; height:20px; width:20px;"></div><div class="color-name"> ${lastColor} <input type="hidden" name="colors[]" value="${lastColor}" /><span class="unselect_color_code"><i class="fas fa-times"></i></span> </div></div>`;
                    console.log("length ->" + selectedColorBox.length);
                    selectedColorBox.append(liElem);
                }
            }
        });
    });

    $(document).on("click", ".unselect_color_code", function (e) {
        e.preventDefault();
        let selectedColorBox = $("#selected-color-box");
        if (selectedColorBox.find(".colorSelectLimit").length > 0) {
            selectedColorBox.find(".colorSelectLimit").remove();
        }
        thisObj = $(this);
        thisObj.parents(".color-wrapper").remove();
    });

    // step form
    $(document).ready(function () {
        var current = 0;
        var tabs = $(".tab");
        var tabs_pill = $(".tab-pills");

        loadFormData(current);

        function loadFormData(n) {
            $(tabs_pill[n]).addClass("active");
            $(tabs[n]).removeClass("d-none");
            $(".back_button").prop("disabled", n === 0);
            $(".next_button").prop("disabled", n === tabs.length - 1);
        }

        function next() {
            $(tabs[current]).addClass("d-none");
            $(tabs_pill[current]).removeClass("active");

            current++;
            loadFormData(current);
        }

        function back() {
            $(tabs[current]).addClass("d-none");
            $(tabs_pill[current]).removeClass("active");

            current--;
            loadFormData(current);
        }

        $(document).ready(function () {
            $(".back_button").on("click", back);
            $(".next_button").on("click", next);
        });

        $(".size_chart").hide();
        $("#option1").show();

        $("#size_select").change(function () {
            $(".size_chart").hide();
            $("#" + $(this).val()).show();
        });
    });

    // radio button hide & show  color picker

    function show1() {
        document.getElementById("color_picker").style.display = "none";
    }
    function show2() {
        document.getElementById("color_picker").style.display = "flex";
    }

    // file upload

    var input = document.getElementById('file');
    var infoArea = document.getElementById('file-upload-filename');
    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileNames = [];

        for (var i = 0; i < input.files.length; i++) {
            //   fileNames.push(input.files[i].name);
            var fileName = input.files[i].name;
            fileNames.push(fileName);

            var fileBloc = document.createElement('span');
            fileBloc.classList.add('file-block');

            var fileNameSpan = document.createElement('span');
            fileNameSpan.classList.add('name');
            fileNameSpan.textContent = fileName;
            fileNameSpan.style.color = 'black';
            fileNameSpan.style.fontSize = '16px';

            var fileDelete = document.createElement('span');
            fileDelete.classList.add('file-remove');
            fileDelete.innerHTML = '<span class="px-2">X</span>';
            fileDelete.style.color = 'black';
            fileDelete.style.fontSize = '16px';
            fileDelete.style.cursor = 'pointer';

            fileDelete.addEventListener('click', function () {
                var nameToRemove = this.nextElementSibling.textContent;

                for (var j = 0; j < dt.items.length; j++) {
                    if (nameToRemove === dt.items[j].getAsFile().name) {
                        dt.items.remove(j);
                        break;
                    }
                }

                input.files = dt.files;

                this.parentElement.remove();
            });

            fileBloc.appendChild(fileDelete);
            fileBloc.appendChild(fileNameSpan);
            infoArea.appendChild(fileBloc);
        }
    }

</script>

@endsection