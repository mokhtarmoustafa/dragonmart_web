<script>
  var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
</script>

<!--begin::Global Config(global config for global JS scripts)-->
<script>
  var KTAppSettings = {
    "breakpoints": {
      "sm": 576,
      "md": 768,
      "lg": 992,
      "xl": 1200,
      "xxl": 1400
    },
    "colors": {
      "theme": {
        "base": {
          "white": "#ffffff",
          "primary": "#3699FF",
          "secondary": "#E5EAEE",
          "success": "#1BC5BD",
          "info": "#8950FC",
          "warning": "#FFA800",
          "danger": "#F64E60",
          "light": "#E4E6EF",
          "dark": "#181C32"
        },
        "light": {
          "white": "#ffffff",
          "primary": "#E1F0FF",
          "secondary": "#EBEDF3",
          "success": "#C9F7F5",
          "info": "#EEE5FF",
          "warning": "#FFF4DE",
          "danger": "#FFE2E5",
          "light": "#F3F6F9",
          "dark": "#D6D6E0"
        },
        "inverse": {
          "white": "#ffffff",
          "primary": "#ffffff",
          "secondary": "#3F4254",
          "success": "#ffffff",
          "info": "#ffffff",
          "warning": "#ffffff",
          "danger": "#ffffff",
          "light": "#464E5F",
          "dark": "#ffffff"
        }
      },
      "gray": {
        "gray-100": "#F3F6F9",
        "gray-200": "#EBEDF3",
        "gray-300": "#E4E6EF",
        "gray-400": "#D1D3E0",
        "gray-500": "#B5B5C3",
        "gray-600": "#7E8299",
        "gray-700": "#5E6278",
        "gray-800": "#3F4254",
        "gray-900": "#181C32"
      }
    },
    "font-family": "Poppins"
  };
</script>

<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?php echo e(url('/V2')); ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo e(url('/V2')); ?>/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?php echo e(url('/V2')); ?>/assets/js/scripts.bundle.js"></script>
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<script>
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
</script>
<script src="<?php echo e(url('/')); ?>/V2/assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
<!--end::Global Theme Bundle-->

<!--begin::Page Vendors(used by this page)-->
<script src="<?php echo e(url('/V2')); ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>

<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="<?php echo e(url('/V2')); ?>/assets/js/pages/widgets.js"></script>

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/main.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" type="text/javascript"></script>


<!--end::Page Scripts-->
<script>
    var baseURL = '<?php echo e(url("admin")); ?>';
    var baseAssets = '<?php echo e(url("assets")); ?>';

    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
</script>

<script type="text/javascript">
$( document ).ready(function() {
   $(".menu-item.menu-item-active").closest('ul').closest('li.menu-item').addClass('menu-item-here menu-item-open');
	 console.log('sd');
})
</script>



<script>


$(document).on("click",".ajax-modal",function(){
		 var link = $(this).attr("href");
		 var title = $(this).data("title");
		 var fullscreen = $(this).data("fullscreen");
		 $.ajax({
			 url: link,
			 beforeSend: function(){
				$("#preloader").css("display","block"); 
			 },success: function(data){
				$("#preloader").css("display","none");
				$('#main_modal .modal-title').html(title);
				$('#main_modal .modal-dialog').html(data);
				$("#main_modal .alert-success").css("display","none");
				$("#main_modal .alert-danger").css("display","none");
				$('#main_modal').modal(); 
				$('#main_modal').modal({backdrop:'static',keyboard:false}); 
				$('#main_modal').modal('show'); 
				
				if(fullscreen == true){
					$("#main_modal >.modal-dialog").addClass("fullscreen-modal");
				}else{
					$("#main_modal >.modal-dialog").removeClass("fullscreen-modal");
				}
				
//				 console.log("Done");
				 
				 if($("select.select2").length > 0){
					 //init Essention jQuery Library
					 
					 
          //  $("select.select2").select2();

           $('.select2').select2({
             placeholder: "اختر",
             dropdownCssClass : "select2-container--default"
            });
            
            $("span.select2").addClass("select2-container--default w-100");

					//  $("select.select2.multiple").select2({
					// 	 placeholder: "اختيار"
					//  });
//					 
					 
//					 $('.year').mask('0000-0000');
//					 $(".ajax-submit").validate();
//					 $('.timepicker').datetimepicker({
//						 format:'HH:mm:00'
//					 });
//					 $(".dropify").dropify();
//					 $("input:required, select:required, textarea:required").prev().append("<span class='required'> *</span>");
				 }
			 }
		 });
		 
		 return false;
   });
   


   
</script>


<script>


function CheckProjects(search , InSearch) {    
    var curProject = parseInt($('#project').val()); //Get the current select project and make it an integer
    $('#person option').each(function () { //Loop through each option
        var arrProjects = JSON.parse($(this).attr('data-project_ids')); //Put the array of projects in a variable
        if ($.inArray(curProject, arrProjects) > -1) { //If current project ID is in array of projects
            $(this).show(); //Show the option
        } else { // Else if current project ID is NOT in array of projects
            $(this).hide(); //hide the option
        }
    });
    //this is to stop the dropdown displaying a hidden option on project change
    if ($('#person :selected').is(':hidden')) { //If the selected person is now hidden
        $('#person').val(''); //Reset the person select box
    }
}


</script>

<script>




</script>

<script>
 
    var FormFileUpload = function() {
        return {
            init: function() {
                $("#fileuploadStore").fileupload({
                        disableImageResize: !1,
                        autoUpload: !1,
                        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                        maxFileSize: 5e6,
                        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
                    }), $("#fileuploadStore").fileupload("option", "redirect", window.location.href.replace(/\/[^\/]*$/, "/cors/result.html?%s")), $.support.cors && $.ajax({
                        type: "HEAD"
                    }).fail(function() {
                        $('<div class="alert alert-danger"/>').text("Upload server currently unavailable - " + new Date).appendTo("#fileuploadStore")
                    }), $("#fileuploadStore").addClass("fileupload-processing"),

                    $.ajax({
                        url: $("#fileuploadStore").attr("action"),
                        dataType: "json",
                        context: $("#fileuploadStore")[0],
                        data: {
                            _token: csrf_token
                        }
                    }).always(function() {
                        $(this).removeClass("fileupload-processing")
                    }).done(function(e) {
                        $(this).fileupload("option", "done").call(this, $.Event("done"), {
                            result: e
                        })
                    })
            }
        }
    }();
  
</script>

	<?php echo $__env->yieldContent('js'); ?>
</body>

<!--end::Body-->
</html>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/layout/footer.blade.php ENDPATH**/ ?>