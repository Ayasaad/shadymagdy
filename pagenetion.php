<?php
################ pagination function #########################################
// $item_per_page=	 $_POST['item_per_page'];
// $current_page=	 $_POST['current_page'];
// $total_records=	 $_POST['total_records'];
// $total_pages=	 $_POST['total_pages'];


function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{


	// <div class="row-fluid">
	// 								<div class="span6">
	// 								<div class="dataTables_info" id="sample_1_info">Showing 1 to 5 of 25 entries</div>
	// 								</div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination">
	// 								<ul>
	// 								<li class="prev disabled"><a href="#"> → <span class="hidden-480">Prev</span></a></li>
	// 								<li class="active"><a href="#">1</a></li>
	//								<li><a href="#">2</a></li>
	// 								<li><a href="#">3</a></li><li><a href="#">4</a></li>
	// 								<li><a href="#">5</a></li><li class="next"><a href="#"><span class="hidden-480">Next</span> ← </a></li>
	// 								</ul>
	// 								</div></div></div>
	// 							</div>
if ( ($current_page*$item_per_page)>$total_records ) {
	  $toto = $total_records ;
}else{$toto=($current_page*$item_per_page);}


    $pagination = '<div id="resultspagination" class="row-fluid"> <div class="span6"> <div class="dataTables_info" id="sample_1_info">تشاهد '. ((($current_page-1) * $item_per_page)+1).' الى '.$toto.' من '. $total_records .' سجل</div> </div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination">';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul>';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<li class="first"><a class="pageelm" href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" class="pageelm" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a class="pageelm" href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active"><a href="#">'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active"><a href="#">'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active disabled "><a href="#">'.$current_page.'</a></li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#"  class="pageelm" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="#"  class="pageelm" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" class="pageelm" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }
        
        $pagination .= '</ul></div></div></div></div></div>'; 
    }
    return $pagination; //return pagination links
}

  //echo paginate_function($item_per_page, $current_page, $total_records, $total_pages);
 
	
?>