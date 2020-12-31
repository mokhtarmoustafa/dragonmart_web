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

        @if($total_pages > 1 )
        @for ($i=1; $i <= $total_pages ; ++$i)

                     <?php
                        $word = 'page_number='.$current_page ;
                        $newword = 'page_number='.$i ;
                        $route = str_replace($word ,  $newword ,$baseroute );
                      // dd(  $route );
                    ?>

                    <li><a href=" {{ $route }}" class="page-number {{ ($i == $current_page)? 'current' : '' }}">{{$i}}</a></li>


        @endfor

             @if($current_page < $total_pages)

                    <?php
                             $word    = 'page_number='.$current_page ;
                             $newword = 'page_number='. ($current_page +1 ) ;
                             $route   = str_replace($word ,  $newword , $baseroute );
                    ?>
                    <li><a href="{{$route}}" class="nav-button">Next</a></li>


              @endif
         @endif

    </ul>
</div>