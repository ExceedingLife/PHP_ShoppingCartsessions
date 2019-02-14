<?php
echo '<div class="col-md-12">';
    echo '<ul class="pagination mb-2 mt-0">';
        // button for 1st page
        if($page > 1) {
            echo "<li><a href='{$page_url}' title='Go to first page.'>";
                echo "First Page";
            echo '</a></li>';
        }

        $total_pages = ceil($total_rows / $recordsPerPage);
        // range of links to show
        $range = 2;
        // display links to 'range of pages' around 'current page'
        $initial_num = $page - $range;
        $conditional_limit_num = ($page + $range) + 1;

        for($x = $initial_num; $x < $conditional_limit_num; $x++) {
            // make sure x is greater than 0 AND less than or equal to $total_pages
            if(($x > 0) && ($x <= $total_pages)) {
                // current page     "\"#\"
                if($x == $page) {
                    echo "<li class='active'><a href=\"#\">$x </a></li>";
                } else {
                    // not the current page
                    echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
                }
            }
        }
        // button for last page
        if($page < $total_pages) {
            echo '<li>';
                echo "<a href='". $page_url ." page={$total_pages}' title='Last Page is {$total_pages}.'>";
                    echo "Last Page";
                echo '</a>';
            echo '</li>';
        }
    echo '</ul>';
echo '</div>';

?>
