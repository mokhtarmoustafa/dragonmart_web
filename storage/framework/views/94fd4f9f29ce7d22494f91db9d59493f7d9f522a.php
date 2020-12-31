<div class="pagination">
    <ul class="list-page">
        <?php $route = request()->segment(2);?>
        <?php $baseroute = request()->url();?>



        <?php


        $parameters = \Request::query();
        if(  $parameters ){


       // dd($m);
            if (strpos($baseroute, 'page_number') == false) {
              $m = http_build_query( $parameters );
              $baseroute = $baseroute .'?'.$m ;
          }
        }
      // dd($baseroute);



        ?>

        <?php if($total_pages > 1 ): ?>
        <?php for($i=1; $i <= $total_pages ; ++$i): ?>

                     <?php
                        $word = 'page_number='.$current_page ;
                        $newword = 'page_number='.$i ;
                        $route = str_replace($word ,  $newword ,$baseroute );
                      // dd(  $route );
                    ?>

                    <li><a href=" <?php echo e($route); ?>" class="page-number <?php echo e(($i == $current_page)? 'current' : ''); ?>"><?php echo e($i); ?></a></li>


        <?php endfor; ?>

             <?php if($current_page < $total_pages): ?>

                    <?php
                             $word    = 'page_number='.$current_page ;
                             $newword = 'page_number='. ($current_page +1 ) ;
                             $route   = str_replace($word ,  $newword , $baseroute );
                    ?>
                    <li><a href="<?php echo e($route); ?>" class="nav-button">Next</a></li>


              <?php endif; ?>
         <?php endif; ?>

    </ul>
</div><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/paging.blade.php ENDPATH**/ ?>