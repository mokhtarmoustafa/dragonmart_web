<div class="modal-content" id="modal-content">
	<div class="modal-header">
		<h3 class="modal-title" id="myModalLabel1">Edit Ad.</h3>
		<button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
			<i class="bx bx-x"></i>
		</button>
	</div>
	<div class="modal-body">
		<form action="<?php echo e(url()->current()); ?>" id="AD" method="post">
			<?php echo e(csrf_field()); ?>

			<div class="row mt-1">


				<div class="col-12 text-center">
					<div class="image-input image-input-outline w-100 center mb-5" id="UploadImage">
						<div class="image-input-wrapper w-100" style="background-size: 100% 100%; background-image:url(<?php echo e($ad->image); ?>)"></div>

						<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
							<i class="fa fa-pen icon-sm text-muted"></i>
							<input type="file" name="image" accept=".png, .jpg, .jpeg" />
							<input type="hidden" name="profile_avatar_remove" />
						</label>

						<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
							<i class="ki ki-bold-close icon-xs text-muted"></i>
						</span>
					</div>
				</div>
				<div class="col-md-12 col-12">
					<div class="form-group">
						<label for="first-name-vertical">الأمر</label>
						<select class="form-control" name="action[action]" id="action">
							<option value="OpenWeb" <?php if($ad->action->action == "OpenWeb"): ?> selected <?php endif; ?>>فتح موقع على المتصفح</option>
							<option value="OpenWebIn" <?php if($ad->action->action == "OpenWebIn"): ?> selected <?php endif; ?>>فتح موقع داخل التطبيق</option>
							<option value="OpenCat" <?php if($ad->action->action == "OpenCat"): ?> selected <?php endif; ?>>الدخول الى قسم</option>
							<option value="OpenStore" <?php if($ad->action->action == "OpenStore"): ?> selected <?php endif; ?>>الدخول الى متجر</option>
							<option value="OpenProduct" <?php if($ad->action->action == "OpenProduct"): ?> selected <?php endif; ?>>الدخول الى منتج</option>
						</select>
					</div>
				</div>
				<div class="action_option w-100" id="Url">
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label for="first-name-vertical">الرابط</label>
							<input type="text" class="form-control" name="action[url]" required value="<?php echo e($ad->action->url ?? ""); ?>">
						</div>
					</div>
				</div>
				<div class="action_option w-100 hidden d-none" id="OpenCat">
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label for="first-name-vertical">القسم</label>
							<select class="form-control" name="action[OpenCat]" id="OpenCatSelect" disabled required>
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($category->id); ?>" <?php if(isset($ad->action->OpenCat) && $ad->action->OpenCat == $category->id): ?> selected <?php endif; ?> ><?php echo e($category->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
				</div>
				<div class="action_option w-100 hidden d-none" id="OpenStore">
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label for="first-name-vertical">المتجر</label>
							<select class="form-control" name="action[OpenStore]" id="OpenStoreSelect" disabled required>
							</select>
						</div>
					</div>
				</div>
				<div class="action_option w-100 hidden d-none" id="OpenStoreCat">
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label for="first-name-vertical">أقسام المتجر</label>
							<select class="form-control" name="action[OpenStoreCat]" id="OpenStoreCatSelect" disabled required>
							</select>
						</div>
					</div>
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label for="first-name-vertical" class="w-100">المنتج</label>
							<select class="form-control select2 w-100" name="action[OpenProducts][]" id="OpenProductSelect" disabled multiple required>
							</select>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-light-secondary" data-dismiss="modal">
			<i class="bx bx-x d-block d-sm-none"></i>
			<span class="d-none d-sm-block">إغلاق</span>
		</button>
		<button class="btn btn-newgreen ml-1" form="AD">
			<i class="bx bx-check d-block d-sm-none"></i>
			<span class="d-none d-sm-block">حفظ</span>
		</button>
	</div>
</div>


<script>
	var card = new KTCard('modal-content');

</script>

<script type="text/javascript">
	var open = '';

	$('.selectize').each(function() {
		$(this).selectize({
			create: true,
			sortField: 'text'
		});
	})

	var avatar3 = new KTImageInput('UploadImage');
	FormFileUpload.init();


	$("#action").change(function() {

		$(".action_option").addClass("hidden d-none");
		$(".action_option input , .action_option select").attr('disabled', true);
		open = '';
		switch (this.value) {
			case "OpenWeb":
			case "OpenWebIn":
				$("#Url").removeClass("hidden d-none");
				$("#Url input  , #Url select").attr('disabled', false);
				open = "web";
				break;
			case "OpenProduct":
				$("#OpenProduct , #OpenStoreCat").removeClass("hidden d-none");
				$("#OpenProduct input  , #OpenProductSelect , #OpenStoreCat input  , #OpenStoreCatSelect").attr('disabled', false);
				open = "OpenProduct";
			case "OpenStore":
				$("#OpenStore").removeClass("hidden d-none");
				$("#OpenStore input  , #OpenStoreSelect").attr('disabled', false);
				open = open ?? "OpenStore";
				$("#OpenStoreSelect").change();
			case "OpenCat":
				$("#OpenCat").removeClass("hidden d-none");
				$("#OpenCat input  , #OpenCatSelect").attr('disabled', false);
				open = open ?? "OpenCat";
				$("#OpenCatSelect").change();
		}

	})
	$("#action").change();

</script>



<script>
	$("#OpenCatSelect").change(function(event) {

		KTApp.block(card.getSelf(), {
			overlayColor: '#ffffff',
			type: 'loader',
			state: 'primary',
			opacity: 0.3,
			message: 'يتم تحميل البيانات',
			size: 'lg'
		});		
		event.preventDefault();
		$('#OpenStoreSelect  , #OpenStoreCatSelect , #OpenProductSelect').html('');
		var _this = $(this);
		var id = this.value;
		var action = _this.attr('href');
		$.ajax({
			url: baseURL + '/merchants',
			type: 'POST',
			dataType: 'json',
			data: ({
				'_token': csrf_token,
				'category_id': id
			}),
			success: function(data) {
				var row = '<option value="" disabled selected>اختر المتجر</option>';
				$.each(data.items.data, function(i, v) {
					var selID = <?php echo e($ad->action->OpenStore ?? "null"); ?> ;
					var selected = selID == v.id ? "selected" : "" ;

					row += '<option value="' + v.id + '" '+ selected +' >' + v.username + '</option>'
				});

				$('#OpenStoreSelect').html(row);
				KTApp.unblock(card.getSelf());
			}
		});

	});


	$("#OpenStoreSelect").change(function(event) {

		console.log("asdlsakdlnsalkdn");

		open = "OpenStore";
		KTApp.block(card.getSelf(), {
			overlayColor: '#ffffff',
			type: 'loader',
			state: 'primary',
			opacity: 0.3,
			message: 'يتم تحميل البيانات',
			size: 'lg'
		});
		event.preventDefault();
		$('#OpenStoreCatSelect , #OpenProductSelect ').html('');
		var _this = $(this);
		var id = this.value;
		var action = _this.attr('href');
		$.ajax({
			url: baseURL + '/merchantCat',
			type: 'POST',
			dataType: 'json',
			data: ({
				'_token': csrf_token,
				'id': id
			}),
			success: function(data) {
				var row = '<option value="" disabled selected>اختر القسم</option>';

				console.log(data.items);

				$.each(data.items[0]['Cat'], function(i, v) {

					var selID = <?php echo e($ad->action->OpenStoreCat ?? "null"); ?>;
					var selected = selID == v.id ? "selected" : "" ;


					row += '<option value="' + v.id + '" '+ selected +'>' + v.name + '</option>'
				});
				$('#OpenStoreCatSelect').html(row);
				KTApp.unblock(card.getSelf());
			}
		});
	});


	$("#OpenStoreCatSelect").change(function(event) {
		KTApp.block(card.getSelf(), {
			overlayColor: '#ffffff',
			type: 'loader',
			state: 'primary',
			opacity: 0.3,
			message: 'يتم تحميل البيانات',
			size: 'lg'
		});
		event.preventDefault();
		$('#OpenProductSelect').html('');
		var _this = $(this);
		var StoreID = $("#OpenStoreSelect option:selected").val();
		var id = this.value;
		var action = _this.attr('href');
		$.ajax({
			url: baseURL + '/Products/' + id,
			type: 'GET',
			dataType: 'json',
			data: ({
				'_token': csrf_token
			}),
			success: function(data) {
				// console.log(data);
				var row = '';
				$.each(data, function(i, v) { 

					var selIDs = <?php if(isset($ad->action->OpenProducts)) print_r(json_encode(json_decode(json_encode($ad->action->OpenProducts) , true))); else echo "null" ?>;
					var selected = selIDs.includes(v.id.toString()) ? "selected" : "" ;
					row += '<option value="' + v.id + '" '+ selected +'>' + v.name + '</option>'
				});

				$('#OpenProductSelect').html(row);
				KTApp.unblock(card.getSelf());
			}
		});
	});


	<?php if(isset($ad->action->OpenCat)): ?> $("#OpenCatSelect").change(); <?php endif; ?>


	<?php if(isset($ad->action->OpenStore)): ?>
	    setTimeout(function(){
			$("#OpenStoreSelect").change();
			

			<?php if(isset($ad->action->OpenProducts)): ?>
	     setTimeout(function(){
	    	$("#OpenStoreCatSelect").change() 
	    }, 500);
	 <?php endif; ?>



	    }, 1000);
	 <?php endif; ?>
	

	 



	
	


</script><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/advertisements/modal/edit.blade.php ENDPATH**/ ?>