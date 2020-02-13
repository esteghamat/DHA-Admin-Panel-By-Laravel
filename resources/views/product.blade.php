@extends('adminPanel.contentLayout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles header" id="fixBreadcrumb">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Product management</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Product management</li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->                
    <button type="button" id="addNewProduct" class="btn btn-success newProductRecord ">Add New Record</button>
    <br><br> 

    <!-- Main Product Gallery -->
    <div class="row_card tm-gallery contentpadding" id="topGallery" >
        @foreach ($product as $productItem)
            <div  id="product_{{$productItem->id}}" class="column_card">
                <div class="card" style="padding:5px; ">
                    <figure>
                        <img src="{{asset('/images/'.$productItem->product_imagename)}}" id="productImage{{$productItem->id}}" alt="Image" class="rounded img-fluid tm-gallery-img productImage fixheightimg" />
                        <figcaption style="text-align: left">
                            <h4 class="tm-gallery-title productTitle" id="productTitle{{$productItem->id}}" style="text-align: center">{{$productItem->product_title}}</h4>
                            <p class="tm-gallery-description productText fixheight" id="productText{{$productItem->id}}" >{{$productItem->product_text}}</p>                        
                            <p class="productCategory" id="productCategory{{$productItem->id}}" data-categoryid="{{$productItem->category->id}}">
                                <span style="color: #1A6692">Category : </span>{{$productItem->category->category_title}}
                            </p>
                            <?php if($productItem->product_isenabled===1): ?>
                                <p class="productIsEnabled" id="productIsEnabled{{$productItem->id}}" name="productIsEnabled" data-ischecked="checked">
                                Product Is Enabled
                                </p><br>
                            <?php else: ?>
                                <p class="productIsEnabled" id="productIsEnabled{{$productItem->id}}" name="productIsEnabled" data-ischecked="unchecked">
                                Product Is Disabled
                                </p><br>
                            <?php endif; ?>
                            <br>
                        </figcaption>
                        <a href="#">
                            <button type="button" class="btn btn-warning editmodalopen" data-product="product_{{$productItem->id}}" data-productid="{{$productItem->id}}" >Edit</button>
                        </a>
                        <span>&nbsp;&nbsp;</span>
                        <a href="#">
                            <button type="button" class="btn btn-warning deletemodalopen" data-product="product_{{$productItem->id}}" data-productid="{{$productItem->id}}">Delete</button>
                        </a>
                    </figure>
                </div><!--<div class="card">-->            
            </div><!--<div id="product_{{$productItem->id}}" class="column_card">-->
        @endforeach
    </div> <!--  Main Product Gallery -->

    <div class="modal" id="productEditModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                    </button>               
                </div><!--modal-header-->
                <div class="alert" id="imgMessage" style="display:none"></div>
                <form action="#" method="POST" id="modalForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body  bg-gray">
                        <div class="editproductElement">
                            <!--<label for="modal-Title" id="productLabel"><span> &nbsp;</span> Product </label>-->
                            <img class="rounded responsive modalImage" id="modalImage" src="{{asset('/images/no_preview.jpg')}}" alt="" name="modalImage" style="max-width: 100px; max-height: 100px;">
                            <br>
                            <input type="file" id="modalInputFile" name="modalInputFile"  accept="image/*">
                            <br>
                            <br>
                            <label for="modalproductTitle">Product Title</label>
                            <input type="text" id="modalproductTitle" name="modalproductTitle"  value="" class="form-control" style="background-color: khaki">
                            <br>
                            <label for="modalproductText">Product Description</label>
                            <textarea id="modalproductText" name="modalproductText"  value="" class="form-control" style="background-color: khaki"></textarea>
                            <br>
                            <div id="twoColumnDiv">
                                <div id="left" style="float: left">
                                        <label for="category">Category</label>
                                        <select   id="modalCategory" name="modalCategory" class="form-control chosen" style="width: 200px;background-color: khaki" >
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"> {{ $category->category_title }}</option>
                                        @endforeach
                                        </select>
                                </div><!--<div id="left">-->
                                <div id="right" style="float: right">
                                    <br>
                                    <br>
                                    <input type="checkbox" id="modalproductIsEnabled" name="modalproductIsEnabled"  value="0">
                                    Product Is Enabled
                                    <br>
                                </div><!--<div id="right">-->
                                <br style="clear:both;"/>
                            </div><!--<div id="twoColumnDiv">-->
                            <input type="hidden" id="editproductId" name="editproductId" value="">
                            <input type="hidden" id="modalproductIsEnabled_Value" name="modalproductIsEnabled_Value" value="0">
                            <div id="editmessage" style="display:none" style="color:crimson"></div>
                        </div><!--editproductElement-->
                    </div><!--modal-body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="submit" id="submitModal" class="btn btn-primary" value="Save"> 
                    </div><!--modal-footer-->
                </form>
            </div><!--modal-content-->
        </div> <!--modal-dialog-->
    </div> <!--modal - productEditModal-->


    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->  
</div>

@endsection

@section('final-scripts')
<script>
    window.onscroll = function() { fixArea() };
    var header = document.getElementById("fixBreadcrumb");
    var sticky = header.offsetTop;

    function fixArea() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

    $(document).ready(function($)
    {
        $('#addNewProduct').click(function(){
            $('#editmessage').hide();
            $("#imgMessage").hide();
            $('#submitModal').val('Add');
            $('#editproductid').val(0);
            $('#modalproductTitle').val('');
            $("#modalproductText").val('');
            $('#modalCategory').val(0);
            $('.modal-title').text('New Product');
            $('#modalImage').attr('src',"{{asset('/images/no_preview.jpg')}}");
            $('#productEditModal').modal('show');   
        });

        $('#topGallery').on('click','button.editmodalopen',function() {
            $('#editmessage').hide();
            var product = $(this).data('product');
            var productTitle = $('#'+ product + ' .productTitle').text();
            productTitle = $.trim(productTitle);
            var productText = $('#'+ product + ' .productText').text();
            productText = $.trim(productText);
            var productCategory = $('#'+ product + ' .productCategory').data('categoryid');
            var productIsEnabled = 0;
            if ($('#'+ product + ' .productIsEnabled').data('ischecked')=="checked")
            {
                productIsEnabled = 1;
            }            
            var imageSrc =  $('#'+ product + ' .productImage').attr("src");
            var imageName = imageSrc.split("/")[imageSrc.split("/").length-1];
            var productid = $(this).data('productid');

            $('#submitModal').val('Edit'); 
            $('#editproductId').val('');
            $('#editproductId').val(productid);
            $('#modalImage').attr('src', imageSrc);
            $('#modalproductText').val('');
            $('#modalproductText').val(productText);
            $('#modalproductTitle').val('');
            $('#modalproductTitle').val(productTitle);            
            $('#modalCategory').val(0);
            $('#modalCategory').val(productCategory);
            $('#modalproductIsEnabled').prop('checked', false);
            $('#modalproductIsEnabled').val(0);
            $('#modalproductIsEnabled_Value').val(0);
            if (productIsEnabled==1)
            {
                $('#modalproductIsEnabled').prop('checked', true);
                $('#modalproductIsEnabled').val(1);
                $('#modalproductIsEnabled_Value').val(1);
            }
            $('#editmessage').hide();
            $('#productEditModal').modal('show');
        });

        $("#modalForm").on("submit", function (event) {
            event.preventDefault();
            $("#editmessage").hide();
            var addOrEdit = $('#submitModal').val();
            var url='';
            if (addOrEdit=='Edit')
            {
                url = "{{ route('product.editproduct') }}";
            }
            else if(addOrEdit=='Add')
            {
                url = "{{ route('product.addproduct') }}";
            }
            if ($('#modalproductIsEnabled').prop('checked')==true){
                $('#modalproductIsEnabled_Value').val(1);
            }
            else{
                $('#modalproductIsEnabled_Value').val(0); 
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//$.ajaxSetup
            $.ajax({
                url : url,
                type : 'post',
                data : new FormData(this),
                dataType : 'JSON',
                contentType : false,
                cache :false,
                processData : false,
                async: false,            
                fail : function(res){
                    var insertmsg = '<div class="alert alert-danger" role="alert">'+'Server Error'+'</div>';
                    $('#editmessage').html(insertmsg);
                    $('#editmessage').fadeIn();
                },
                success : function(res){
                    if ((res['success']) === 'success')
                    {                        
                        if (addOrEdit=='Edit')
                        {
                            var insertmsg = '<div class="alert alert-danger" role="alert"> Success </div>';
                            $('#editmessage').html(insertmsg);
                            $('#editmessage').fadeIn();
                            $('#productEditModal').modal('hide');
                            $('#productTitle'+res.product.id).text(res.product.product_title);
                            $('#productText'+res.product.id).text(res.product.product_text);
                            $('#productCategory'+res.product.id).data("categoryid" , res.category.id);
                            var categoryHtml = "<span style="+"color: #1A6692"+">Category : </span>"+res.category.category_title;
                            $('#productCategory'+res.product.id).html(categoryHtml);
                            if(res.product.product_isenabled==1)
                            {
                                $('#productIsEnabled'+res.product.id).text("Product Is Enabled");
                                $('#productIsEnabled'+res.product.id).data("ischecked","checked");
                            }
                            else
                            {
                                $('#productIsEnabled'+res.product.id).text("Product Is Disabled");
                                $('#productIsEnabled'+res.product.id).data("ischecked","unchecked");
                            }
                            $('#productImage'+res.product.id).attr('src' , "{{asset('/images/')}}"+'/'+res.product.product_imagename);
                        }
                        else if (addOrEdit=='Add')
                        {
                            $("#imgMessage").css('display' , 'block');
                            $("#imgMessage").html(res.message);
                            $("#imgMessage").addClass(res.class_name);
                            $('#topGallery').append(addNewProductToPage(res));
                            $('#productEditModal').modal('hide');
                        }
                    }
                    else // ((res['success']) === 'fail')
                    {
                        var inserttxt = res['message'];
                        $('#editmessage').html(inserttxt);
                        $('#editmessage').fadeIn();                    
                    }
                }//success : function(res)
            });//$.ajax
        });//$("#submitModal").click

        $('#topGallery').on('click','button.deletemodalopen',function() {
            var answer = confirm ("Are you sure you want to delete from the database?");
            if (!answer)
            {
                return;
            }
            var productid = $(this).data('productid');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                    url :  "{{ route('product.deleteproduct') }}",
                    data : {  productid : productid , 
                                _token : '{{ csrf_token() }}'
                            },    
                    type : 'POST',
                    fail: function(){
                        var incerttxt = '<div class="alert alert-danger" role="alert">Server error</div>';
                        //$('#editmessage').html(incerttxt);
                        //$('#editmessage').fadeIn();
                    },
                    success : function( res ) {
                        var incerttxt = '<div class="alert alert-danger" role="alert"> Success </div>';
                        if(res)
                        {
                            $("#product_"+productid).remove();
                        }else
                        {
                            alert("can't delete the row")
                        }
                    }
            });//$.ajax
        });//$('table tbody').on('click','tr :button.deletemodalopen'

        $('#modalInputFile').change(function()
        {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#modalImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                $('#modalImage').attr('src', domain + 'images/no_preview.jpg');
            }
        });

        function addNewProductToPage(e)
        {
            var imgsrc = "{{asset('/images/no_preview.jpg')}}";
            var img = imgsrc.replace("no_preview.jpg", e.product.product_imagename);
            var html = 
            '<div  id="product_'+e.id+'" class="column_card">'+
                '<div class="card" style="padding:5px; ">'+
                    '<figure>'+
                        '<img src="'+img+'" id="productImage'+e.id+'" alt="Image" class="rounded img-fluid tm-gallery-img productImage fixheightimg" />'+
                        '<figcaption style="text-align: left">'+
                            '<h4 class="tm-gallery-title productTitle" id="productTitle'+e.id+'" style="text-align: center">'+e.product.product_title+'</h4>'+
                            '<p class="tm-gallery-description productText fixheight" id="productText'+e.id+'" >'+e.product.product_text+'</p>'+                        
                            '<p class="productCategory" id="productCategory'+e.id+'" data-categoryid="'+e.category.id+'">'+
                                '<span style="color: #1A6692">Category : </span>'+e.category.category_title+
                            '</p>';
                            if(+e.product.isenabled==1)
                            {
                                html = html + 
                                '<p class="productIsEnabled" id="productIsEnabled'+e.id+'" name="productIsEnabled" data-ischecked="checked">'+
                                'Product Is Enabled'+
                                '<br>';
                            }
                            else
                            {
                                html = html +
                                '<p class="productIsEnabled" id="productIsEnabled'+e.id+'" name="productIsEnabled" data-ischecked="unchecked">'+
                                'Product Is Disabled'+
                                '<br>';
                            }
                            html = html + 
                            '<br>'+
                        '</figcaption>'+
                        '<a href="#">'+
                            '<button type="button" class="btn btn-warning editmodalopen" data-product="product_'+e.id+'" data-productid="'+e.id+'" >Edit</button>'+
                        '</a>'+
                        '<span>&nbsp;&nbsp;</span>'+
                        '<a href="#">'+
                            '<button type="button" class="btn btn-warning deletemodalopen" data-product="product_'+e.id+'" data-productid="'+e.id+'">Delete</button>'+
                        '</a>'+
                    '</figure>'+
                '</div>'+            
            '</div>';
            //alert(html);
            return html;
        }//function addNewProductToPage

    });

</script>
@endsection
