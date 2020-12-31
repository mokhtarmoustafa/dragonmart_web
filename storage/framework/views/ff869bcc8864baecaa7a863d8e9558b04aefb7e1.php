<div class="modal-content" id="modal-content">
	<div class="modal-header">
		<h3 class="modal-title" id="myModalLabel1"><?php echo e(trans(lang_app_site().'.CP.New Promotion Code')); ?></h3>
		<button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
			<i class="bx bx-x"></i>
		</button>
	</div>
	<div class="modal-body">
		<form action="<?php echo e(url()->current()); ?>" id="promotion_code" method="post">
			<?php echo e(csrf_field()); ?>

			<div class="row mt-1">
				<div class="col-6">
					<!-- الكود -->
					<div class="col-md-12 col-12">
						<div class="form-group w-100">
							<div class="form-group">
								<label for="first-name-vertical"><?php echo e(trans(lang_app_site().'.CP.Code')); ?></label>
								<input type="text" class="form-control" name="code" required>
							</div>
						</div>
					</div>

					<!-- الوصف -->
					<div class="col-md-12 col-12">
						<div class="form-group w-100">
							<div class="form-group">
								<label for="first-name-vertical"><?php echo e(trans(lang_app_site().'.CP.Description')); ?></label>
								<input type="text" class="form-control" name="description" required>
							</div>
						</div>
					</div>

					<!-- التاريخ -->
					<div class="col-md-12 col-12">
						<div class="form-group  w-100">
							<label"><?php echo e(trans(lang_app_site().'.CP.Date')); ?></label>
								<div class="col-lg-12 col-md-9 col-sm-12">
									<div class="row">
										<div class="col ml-0">
											<div class="input-group date" id="kt_datetimepicker_7_1" data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input" name="action[start_date]" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" data-target="#kt_datetimepicker_7_1" />
												<div class="input-group-append" data-target="#kt_datetimepicker_7_1" data-toggle="datetimepicker">
													<span class="input-group-text">
														<i class="ki ki-calendar"></i>
													</span>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="input-group date" id="kt_datetimepicker_7_2" data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input" name="action[end_date]" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>" data-target="#kt_datetimepicker_7_2" />
												<div class="input-group-append" data-target="#kt_datetimepicker_7_2" data-toggle="datetimepicker">
													<span class="input-group-text">
														<i class="ki ki-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>

					<!-- نوع الخصم -->
					<div class="col-md-12 col-12">
						<div class="form-group w-100">
							<label><?php echo e(trans(lang_app_site().'.CP.Promotion Type')); ?></label>
							<div class="radio-inline">
								<label class="radio w-25">
									<input type="radio" name="action[promo_type]" value="discount" checked="checked" />
									<span></span>
									<?php echo e(trans(lang_app_site().'.CP.Discount')); ?>

								</label>
								<label class="radio w-25">
									<input type="radio" name="action[promo_type]" value="cash_back" />
									<span></span>
									<?php echo e(trans(lang_app_site().'.CP.Cash Back')); ?>

								</label>
							</div>
						</div>
					</div>

					<!-- القيمة -->
					<div class="form-group col-12">
						<div class="input-group ">
							<div class="input-group-prepend">
								<select class="form-control rounded-right-0" name="action[amount_type]" id="amount_type">
									<option value="static"><?php echo e(trans(lang_app_site().'.CP.Static Amount')); ?></option>
									<option value="percentage"><?php echo e(trans(lang_app_site().'.CP.Percentage')); ?></option>
								</select>

							</div>
							<input type="text" class="form-control" aria-label="Text input with dropdown button" name="action[amount]" required />
						</div>
					</div>
					<div class="max_discount col-md-12 col-12 hidden d-none" id="max_discount">
						<div class="form-group w-100">
							<div class="form-group">
								<input type="text" class="form-control" name="action[max_discount]" placeholder="<?php echo e(trans(lang_app_site().'.CP.Discount To')); ?>" disabled required>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<!-- خصم على -->
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label><?php echo e(trans(lang_app_site().'.CP.Promotion On')); ?></label>
							<select class="form-control" name="action[promo_on]" id="promo_on">
								<option value="delivery"><?php echo e(trans(lang_app_site().'.CP.Delivery')); ?></option>
								<option value="products"><?php echo e(trans(lang_app_site().'.CP.Products')); ?></option>
								<option value="delivery_products"><?php echo e(trans(lang_app_site().'.CP.Delivery and Products')); ?></option>
							</select>
						</div>
					</div>
					<div class="promo_on col-md-12 col-12 hidden d-none" id="products_promo">
						<div class="form-group">
							<select class="form-control" name="action[products_promo]" id="select_products_promo">
								<option value="all_stores"><?php echo e(trans(lang_app_site().'.CP.All Stores and Categories')); ?></option>
								<option value="category"><?php echo e(trans(lang_app_site().'.CP.Category')); ?></option>
								<option value="store"><?php echo e(trans(lang_app_site().'.CP.Store')); ?></option>
							</select>
						</div>
					</div>
					<div class="products_promo col-md-12 col-12 hidden d-none" id="category">
						<div class="form-group">
							<select class="form-control select2" id="kt_select2_3" name="action[category][]" multiple="multiple">
								<?php $__currentLoopData = $dm_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($category->id); ?>"><?php echo e($category->name_ar); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="products_promo col-md-12 col-12 hidden d-none" id="store">
						<div class="form-group">
							<select class="form-control select2" name="action[store][]" multiple="multiple">
								<?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($store->id); ?>"><?php echo e($store->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>

					<!-- sponsor - الراعي -->
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label><?php echo e(trans(lang_app_site().'.CP.Sponsor')); ?></label>
							<select class="form-control" name="action[sponsor]" id="sponsor">
								<option value="dragon_mart"><?php echo e(trans(lang_app_site().'.CP.Dragon Mart')); ?></option>
								<option value="store"><?php echo e(trans(lang_app_site().'.CP.Store')); ?></option>
							</select>
						</div>
					</div>

					<!-- الشروط -->
					<div class="col-md-12 col-12">
						<div class="form-group">
							<label><?php echo e(trans(lang_app_site().'.CP.Conditions')); ?></label>
							<div class="checkbox-inline">
								<label class="checkbox">
									<input id="first_order" type="checkbox" name="action[conditions]" value="first_order" />
									<span></span>
									<?php echo e(trans(lang_app_site().'.CP.First Order')); ?>

								</label>
								<label class="checkbox">
									<input id="minimum" type="checkbox" />
									<span></span>
									<?php echo e(trans(lang_app_site().'.CP.Minimum')); ?>

								</label>
								<label class="checkbox">
									<input id="maximum" type="checkbox" />
									<span></span>
									<?php echo e(trans(lang_app_site().'.CP.Maximum')); ?>

								</label>
							</div>
						</div>
					</div>
					<div class="condition_minimum col-md-12 col-12 hidden d-none" id="condition_minimum">
						<div class="form-group w-100">
							<div class="form-group">
								<input type="text" class="form-control" name="action[condition_minimum]" placeholder="<?php echo e(trans(lang_app_site().'.CP.Minimum')); ?>" disabled required>
							</div>
						</div>
					</div>
					<div class="condition_maximum col-md-12 col-12 hidden d-none" id="condition_maximum">
						<div class="form-group w-100">
							<div class="form-group">
								<input type="text" class="form-control" name="action[condition_maximum]" placeholder="<?php echo e(trans(lang_app_site().'.CP.Maximum')); ?>" disabled required>
							</div>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn" data-dismiss="modal">
			<i class="bx bx-x d-block d-sm-none"></i>
			<span class="d-none d-sm-block"><?php echo e(trans(lang_app_site().'.CP.Close')); ?></span>
		</button>
		<button class="btn btn-newgreen ml-1" form="promotion_code">
			<i class="bx bx-check d-block d-sm-none"></i>
			<span class="d-none d-sm-block"><?php echo e(trans(lang_app_site().'.CP.Save')); ?></span>
		</button>
	</div>
</div>

<script src="<?php echo e(url('/')); ?>/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

<script type="text/javascript">
	$('.selectize').each(function() {
		$(this).selectize({
			create: true,
			sortField: 'text'
		});
	})

	$("#amount_type").change(function() {

		$(".max_discount").addClass("hidden d-none");
		$(".max_discount input , .max_discount select").attr('disabled', true);
		switch (this.value) {
			case "static":
				break;
			case "percentage":
				$("#max_discount").removeClass("hidden d-none");
				$("#max_discount input  , #max_discount select").attr('disabled', false);
				break;
		}

	})

	$("#promo_on").change(function() {

		$(".promo_on").addClass("hidden d-none");
		$(".promo_on input , .promo_on select").attr('disabled', true);
		switch (this.value) {
			case "delivery":
				break;
			case "products":
			case "delivery_products":
				$("#products_promo").removeClass("hidden d-none");
				$("#products_promo input  , #products_promo select").attr('disabled', false);
				break;
		}

	})

	$("#select_products_promo").change(function() {

		$(".products_promo").addClass("hidden d-none");
		$(".products_promo input , .products_promo select").attr('disabled', true);
		console.log('this.value');
		console.log(this.value);
		switch (this.value) {
			case "all_stores":
				break;
			case "category":
				$("#category").removeClass("hidden d-none");
				$("#category input  , #category select").attr('disabled', false);
				break;
			case "store":
				$("#store").removeClass("hidden d-none");
				$("#store input  , #store select").attr('disabled', false);
				break;

		}

	})

	$("input[type='checkbox'][id='minimum']").change(function() {

		var checkbox = $("input[type='checkbox'][id='minimum']");

		if (checkbox.is(':checked')) {
			$("#condition_minimum").removeClass("hidden d-none");
			$("#condition_minimum input  , #condition_minimum select").attr('disabled', false);
		} else {
			$(".condition_minimum").addClass("hidden d-none");
			$(".condition_minimum input , .condition_minimum select").attr('disabled', true);
		}
	})
	$("input[type='checkbox'][id='maximum']").change(function() {

		var checkbox = $("input[type='checkbox'][id='maximum']");

		if (checkbox.is(':checked')) {
			$("#condition_maximum").removeClass("hidden d-none");
			$("#condition_maximum input  , #condition_maximum select").attr('disabled', false);
		} else {
			$(".condition_maximum").addClass("hidden d-none");
			$(".condition_maximum input , .condition_maximum select").attr('disabled', true);
		}
	})



	$("select:not(#action)").change(function() {

		$(function() {
			$('#OpenStore').filterByText($("#OpenCat").value);
		});

	})
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


		if (open == "OpenProduct") {
			return;
		}

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
					row += '<option value="' + v.id + '">' + v.username + '</option>'
				});

				$('#OpenStoreSelect').html(row);
				KTApp.unblock(card.getSelf());
			}
		});

	});


	$("#OpenStoreSelect").change(function(event) {
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
				$.each(data.items[0]['Cat'], function(i, v) {
					row += '<option value="' + v.id + '">' + v.name + '</option>'
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
					row += '<option value="' + v.id + '">' + v.name + '</option>'
				});

				$('#OpenProductSelect').html(row);
				KTApp.unblock(card.getSelf());
			}
		});
	});
</script><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/promotion_codes/modal/create.blade.php ENDPATH**/ ?>