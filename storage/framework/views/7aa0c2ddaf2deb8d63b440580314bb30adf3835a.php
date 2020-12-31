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
				<div class="col-6">
					<!-- الكود -->
					<div class="col-md-12 col-12">
						<div class="form-group w-100">
							<div class="form-group">
								<label for="first-name-vertical"><?php echo e(trans(lang_app_site().'.CP.Code')); ?></label>
								<input type="text" class="form-control" name="code" value="<?php echo e($promotion_code->code ?? ''); ?>" required>
							</div>
						</div>
					</div>

					<!-- الوصف -->
					<div class="col-md-12 col-12">
						<div class="form-group w-100">
							<div class="form-group">
								<label for="first-name-vertical"><?php echo e(trans(lang_app_site().'.CP.Description')); ?></label>
								<input type="text" class="form-control" name="description" value="<?php echo e($promotion_code->description ?? ''); ?>" required>
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
												<input type="text" class="form-control datetimepicker-input" name="action[start_date]" value="<?php echo e($promotion_code->action->start_date ?? ''); ?>" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" data-target="#kt_datetimepicker_7_1" />
												<div class="input-group-append" data-target="#kt_datetimepicker_7_1" data-toggle="datetimepicker">
													<span class="input-group-text">
														<i class="ki ki-calendar"></i>
													</span>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="input-group date" id="kt_datetimepicker_7_2" data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input" name="action[end_date]" value="<?php echo e($promotion_code->action->end_date ?? ''); ?>" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>" data-target="#kt_datetimepicker_7_2" />
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
									<input type="radio" name="action[promo_type]" value="discount" <?php if($promotion_code->action->promo_type == "discount"): ?> checked='checked' <?php endif; ?> />
									<span></span>
									<?php echo e(trans(lang_app_site().'.CP.Discount')); ?>

								</label>
								<label class="radio w-25">
									<input type="radio" name="action[promo_type]" value="cash_back" <?php if($promotion_code->action->promo_type == "cash_back"): ?> checked='checked' <?php endif; ?>/>
									<span></span>
									<?php echo e(trans(lang_app_site().'.CP.Cash Back')); ?>

								</label>
							</div>
						</div>
					</div>

					<!-- القيمة -->
					<div class="form-group col-12">
						<label><?php echo e(trans(lang_app_site().'.CP.Amount')); ?></label>
						<div class="input-group ">
							<div class="input-group-prepend">
								<select class="form-control rounded-right-0" name="action[amount_type]" id="amount_type">
									<option value="static" <?php if($promotion_code->action->amount_type == "static"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Static Amount')); ?></option>
									<option value="percentage" <?php if($promotion_code->action->amount_type == "percentage"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Percentage')); ?></option>
								</select>

							</div>
							<input type="text" class="form-control" aria-label="Text input with dropdown button" name="action[amount]" value="<?php echo e($promotion_code->action->amount ?? ''); ?>" required />
						</div>
					</div>
					<div class="max_discount col-md-12 col-12 hidden d-none" id="max_discount">
						<div class="form-group w-100">
							<div class="form-group">
								<label for="first-name-vertical"><?php echo e(trans(lang_app_site().'.CP.Discount To')); ?></label>
								<input type="text" class="form-control" name="action[max_discount]" value="<?php echo e($promotion_code->action->max_discount ?? ''); ?>" disabled required>
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
								<option value="delivery" <?php if($promotion_code->action->promo_on == "delivery"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Delivery')); ?></option>
								<option value="products" <?php if($promotion_code->action->promo_on == "products"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Products')); ?></option>
								<option value="delivery_products" <?php if($promotion_code->action->promo_on == "delivery_products"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Delivery and Products')); ?></option>
							</select>
						</div>
					</div>
					<div class="products_promo col-md-12 col-12 hidden d-none" id="products_promo">
						<div class="form-group">
							<select class="form-control" name="action[products_promo]" id="select_products_promo">
								<option value="all_stores" <?php if($promotion_code->action->products_promo == "all_stores"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.All Stores and Categories')); ?></option>
								<option value="category" <?php if($promotion_code->action->products_promo == "category"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Category')); ?></option>
								<option value="store" <?php if($promotion_code->action->products_promo == "store"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Store')); ?></option>
							</select>
						</div>
					</div>
					<?php if(isset($promotion_code->action->category)): ?>
					<div class="category col-md-12 col-12 hidden d-none" id="category">
						<div class="form-group">
							<select class="form-control select2" id="kt_select2_3" name="action[category][]" multiple="multiple">
								<?php $__currentLoopData = $dm_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($category->id); ?>" 
									<?php $__currentLoopData = $promotion_code->action->category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($category_id == $category->id): ?>
											selected
											<?php break; ?>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									><?php echo e($category->name_ar); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<?php endif; ?>
					<?php if(isset($promotion_code->action->store)): ?>
					<div class="products_promo col-md-12 col-12 hidden d-none" id="store">
						<div class="form-group">
							<select class="form-control select2" name="action[store][]" multiple="multiple">
								<?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($store->id); ?>" 
									<?php $__currentLoopData = $promotion_code->action->store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($store_id == $store->id): ?>
											selected
											<?php break; ?>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									><?php echo e($store->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<?php endif; ?>

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
							<label for="first-name-vertical"><?php echo e(trans(lang_app_site().'.CP.Conditions')); ?></label>
							<select class="form-control" name="action[conditions]" id="conditions">
								<option value="none" <?php if($promotion_code->action->conditions == "none"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.No Conditions')); ?></option>
								<option value="first_order" <?php if($promotion_code->action->conditions == "first_order"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.First Order')); ?></option>
								<option value="greater_than" <?php if($promotion_code->action->conditions == "greater_than"): ?> selected <?php endif; ?>><?php echo e(trans(lang_app_site().'.CP.Order\'s Totle Greater Than')); ?></option>
							</select>
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
		<button class="btn btn-newgreen ml-1" form="AD">
			<i class="bx bx-check d-block d-sm-none"></i>
			<span class="d-none d-sm-block"><?php echo e(trans(lang_app_site().'.CP.Save')); ?></span>
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

	$("#amount_type").change();
	$("#promo_on").change();
	$("#select_products_promo").change();
	$("input[type='checkbox'][id='minimum']").change();
	$("input[type='checkbox'][id='maximum']").change();
</script><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/promotion_codes/modal/edit.blade.php ENDPATH**/ ?>