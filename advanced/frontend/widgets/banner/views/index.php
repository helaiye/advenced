<?php

?>


<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <?php foreach ($items as $k => $v):?>
        <li class="<?= $v['active']?>" data-target="#myCarousel" data-slide-to="<?= $k?>"></li>
        <?php endforeach;?>
       
    </ol>   
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <?php foreach ($items as $k =>$v):?>
        <div class="item <?=$v['active']?>">
            <img src="<?= $v['image_url']?>" alt="<?= $v['image_name']?>">
        </div>
        <?php endforeach; ?>
        
        
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="carousel-control left" href="#myCarousel" 
        data-slide="prev">&lsaquo;
    </a>
    <a class="carousel-control right" href="#myCarousel" 
        data-slide="next">&rsaquo;
    </a>
</div>
