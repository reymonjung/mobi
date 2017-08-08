
<section class="<?php echo element('css', $view)?>">

    <h2>
    <?php 
        if(html_escape(element('board_name', element('board', $view)))=='패티쉬') echo "인기사진";
        else if (html_escape(element('board_name', element('board', $view)))=='금주추천') echo "추천웹툰";
        else echo html_escape(element('board_name', element('board', $view)));
    ?> 
    <span> <a href="<?php echo board_url(element('brd_key', element('board', $view))); ?>" title="<?php echo html_escape(element('board_name', element('board', $view))); ?>">더보기 ></a> </span> 
    </h2>
        <nav>
            <ul>
            <?php
            $i = 0;

            if (element('latest', $view)) {
                foreach (element('latest', $view) as $key => $value) {
 
            ?>
                <li><a <?php if(strpos(element('css', $view),'photo') !==false) echo 'rel="example_group"'; ?>  href="<?php echo element(element('href_url', $view), $value); ?>" title="<?php echo html_escape(element('title', $value)); ?>">
                    <?php 
                    if(element('pfi_url', $value)){
                        echo '<img src="'.html_escape(element('pfi_url', $value)).'" alt="photo_'.$i.'">';
                    } elseif (element('pln_url', $value)) { 
                        echo '<img src="'.html_escape(element('pln_url', $value)).'" alt="photo_'.$i.'" class="imgUrlExist" data-url="/img_url_header.php?url='.urlencode(element('pln_url', $value)).'&filename=photo_'.$i.'">';
                    }
                    ?>
                    </a>
                    <h3> <?php echo element('title', $value) && strpos(element('css', $view),'photo') ===false ? element('title', $value) :'';?></h3>
                </li>
            <?php
                    $i++;
                }
            }
            while ($i < element('latest_limit', $view)) {
            ?>
                <li>
                   <h3> 게시물이 없습니다</h3>
                    
                </li>
            <?php
                $i++;
            }
            ?>
       </ul>
    </nav>
</section>
