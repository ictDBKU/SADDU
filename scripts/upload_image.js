$(document).ready(function(){
    $('#upload_files').on('change',function(){
        $('#image_upload_form').ajaxForm({           
            target:'#images_preview',
            beforeSubmit:function(e){
                $('.image_uploading').hide();
            },
            success:function(e){
                $('.image_uploading').show();
            },
            error:function(e){
            }
        }).submit();
    });
});

