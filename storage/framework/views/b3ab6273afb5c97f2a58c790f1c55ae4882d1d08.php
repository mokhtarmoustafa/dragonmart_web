<html>
<head>
</head>
<body>
<script>

    window.location = "<?php echo e($primaryRedirection); ?>"; // will result in error message if app not installed
    setTimeout(function() {
        // Link to the App Store should go here -- only fires if deep link fails
        window.location = "<?php echo e($secndaryRedirection); ?>";
    }, 5000);

</script>
</body>
</html><?php /**PATH /home/saudidragonmart/public_html/resources/views/emails/deep_link.blade.php ENDPATH**/ ?>