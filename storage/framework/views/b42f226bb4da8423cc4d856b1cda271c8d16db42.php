<!DOCTYPE html>
<html lang="ar" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php echo $__env->make(site_layout_vw().'.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title>Dragon Mart</title>
    <script src="https://unpkg.com/eva-icons"></script>
    <link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/rtl-style.css">
  </head>
  <body class="login">
    <div class="row w-100">
      <div class="col-md-3 bg-login">
        <img class="logo center_all " src="<?php echo e(url('assets/site/images/white_DragonMart.png')); ?>">
      </div>
      <div class="col-md-9">
        <?php if(count($errors) == 0 && session()->has('message')): ?>
            <div class="alert alert-success w-50 center">
              <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger w-50 center">

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        <?php endif; ?>

        <div class="alert alert-warning w-50 center hidden error-msg">

        </div>


        <div class="login_div">
          <h1 class="white center title">التسجيل كتاجر</h1>
          <div class="login_form center">

            <form class="form-horizontal"
                  role="form"
                  method="POST"
                  action="<?php echo e(url('register/web')); ?>" id="formRegister">
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                  <input type="hidden" name="typeuser" value="merchant">




                <div class="hiddenInput center">
                  <input type="text" class="input-info" name="name" id="name" placeholder="اسم المتجر" required>
                  <input type="text" class="input-info" name="phone" id="phone" placeholder="9665xxxxxxx" required>
                </div>

                <div class="clearfix mt-4"></div>

                <div class="hiddenInput center">
                  <input type="password" class="input-info" name="password" id="password" required placeholder="كلمة المرور" >
                  <input type="password" class="input-info" name="password_confirmation" id="confirm_password" placeholder="تأكيد كلمة المرور" required>
                </div>
                <div class="clearfix mt-5"></div>
                <div class="group-button">
                    <button class="btn btn-radius btn-outline btn-sm mt-4" type="button" onclick="submitFn()">تسجيل</button>
                </div>
                <input type="hidden" id="crt_reg" name="crt_reg">
            </form>
          </div>
        </div>
      </div>
      <?php echo $__env->make(site_layout_vw().'.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <script src="<?php echo e(url('assets/site/js/jquery.validate.js')); ?>"></script>
      <script>


        function submitFn() {

          var regex = new RegExp(/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/);

            $('#phone').removeClass('err');
            if ($('#phone').val() == '' || $('#phone').val().length < 10 || !regex.test($('#phone').val())) {
              $(".error-msg").removeClass("hidden").text("صيغة رقم الجوال غير صحيحه");
              setTimeout( function(){
                $(".error-msg").addClass("hidden")
              }, 4000);
                return;

            }


            //  e.preventDefault();
            var req = 'This field is required ';
            var req_password = 'password is required';
            var em = 'email address is required';
            var phone_val = 'enter phone value';
            var confirm_val = 'password an password confirm not equal ';
            var number = 'phone must be correct number ';

                        if($('#username').val() == '' || $('#password').val() == '' || $('#confirm_password').val() == ''){
                          $(".error-msg").removeClass("hidden").text("يجب ملئ جميع الخانات");
                          setTimeout( function(){
                            $(".error-msg").addClass("hidden")
                          }, 4000);
                            return;
                        }

                                    if($('#confirm_password').val() != $('#password').val()){
                                      $(".error-msg").removeClass("hidden").text("كلمة المرور غير متطابقة");
                                      setTimeout( function(){
                                        $(".error-msg").addClass("hidden")
                                      }, 4000);
                                        return;
                                    }
                                    $("#formRegister").submit();

        }

    </script>
    </div>
  </body>
</html>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/site/login.blade.php ENDPATH**/ ?>