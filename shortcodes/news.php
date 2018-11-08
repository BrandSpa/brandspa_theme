<?php 

function ra_news_sc( $atts ) {
	$at = shortcode_atts([], $atts);
    $query = new Wp_Query(array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));

    $posts = array_map(function($item) {
		$attachment_id = get_post_thumbnail_id($item->ID);
		$item->post_thumbnail = wp_get_attachment_image_src($attachment_id, 'thumbnail')[0];
		$item->post_image = wp_get_attachment_image_src($attachment_id, 'full')[0];
		$item->post_categories = get_the_category($item->ID);
		return $item;
	}, $query->get_posts());

    foreach($posts as $post){
		$post->post_content="";
	}
    ob_start();
?>
<style>
.projects {
						padding: 0;
						margin: 20px 0;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
					}
					.pagination-btn {
						float: right;
						margin: 0 40px 20px 0;
						color: #039ED8;
						font-size: 20px;
					}
					.pagination-btn span {
						display: block;
					}
          .project-item {
						padding: 5px;
					}
					.empty-value {
						height: 100px;
						display: flex;
						flex: 1;
						align-items: center;
					}
					.empty-value h4 {
						font-size: 17px;
						color: #039ED8;
					}
					.filters-title {
						font-size: 15px;
						color: #039ED8;
					}
					.filters {
						width: 90%;
						background: #fff;
						box-shadow: 0 10px 10px rgba(0,0,0,.1);
						display: flex;
						flex-direction: column;
						padding-top: 20px;
						margin-left: 15px;
						transition: .3s ease;
					}
					.filters--in-bound {
						position: fixed;
						left: 0;
						right: 0;
						top: 60px;
						z-index: 100;
					}
					.filters__toggle {
						display: flex;
						align-self: flex-end;
						cursor: pointer;
						border: none;
						background: transparent;
						font-size: 15px;
						color: #039ED8;
						margin-bottom: 20px;
						align-items: center;
						outline: none;
					}
					.filters__toggle i {
						padding: 0 20px;
					}
					.filters__toggle--open i::before {
						transform: rotate(45deg);
					}
					.filters-container {
						display: none;
					}
					.filters-container--open {
						display: block;
						padding-bottom: 20px;
					}
					@media (min-width: 1024px) {
						.projects {
							flex-direction: row;
						}
						.filters {
							display: initial;
							box-shadow: none;
							background: transparent;
							padding: 0;
							margin: 0;
						}
						.filters-container {
							display: block;
						}
						.filters__toggle {
							display: none;
						}
					}
.project-item {
    display: flex;
    flex: 1;
    transition: transform .1s ease-in-out;
    position: relative;
    background: #fff;
    width: 100%;
    margin-bottom: 20px;
}
.miniline {
    width: 15px;
    height: 1px;
    background: #039ED8;
    margin: 5px 0;
}
.project-item:hover {
    transform: scale(1.150);
    z-index: 2;
    box-shadow: 0 0 20px rgba(0,0,0,.1)
}
.project-item__header {
    width: 40%;
    min-height: 140px;
    background-position: center;
    background-size: cover;
    position: relative
}
.project__info {
    padding: 10px 20px;
    color: #1E9CC0;
    width: 70%;
    position: relative;
}
.project__info__bottom {
    position: absolute;
    bottom: 10px;
}
.project__info span {
    display: block;
}
.project__info-title {
    font-size: 15px;
    color: #5D5D5D;
    margin-bottom: 10px;
}
.project__info-date {
    font-size: 13px;
}
.project__info-country, .project__info-state-city {
    font-size: 13px;
    color: #039ED8;
}
@media (min-width: 1024px) {
    .project-item {
        display: block;
        margin-bottom: 2px;
    }
    .project-item__header {
        height: 200px;
        width: 100%;
    }
    .project__info {
        height: 200px;
        padding: 20px;
        width: 100%;
    }
    .project__info__bottom {
        position: absolute;
        bottom: 20px;
    }
    .project__info-title {
        font-size: 17px;
        margin-bottom: 30px;
        width: 100%;
    }
    .miniline {
        margin: 10px 0;
    }
    .project__info-date {
        font-size: 15px;
    }
    .project__info-country, .project__info-state-city {
        font-size: 15px;
    }
}

</style>
<section class="news col-lg-12">
    <?php 
        foreach($posts as $post){
    ?>
    <div class="col-lg-4 col-md-6 project-item">
        <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>" class="project-item">
        <div
			class="project-item__header"
			style="background: url(<?php echo $post->post_image ?>); background-size: 100%;"
		></div>

		<div class="project__info">
			<span class="project__info-date"><?php echo date("M Y", strtotime($post->post_date));?></span>
			<div class="miniline"></div>
			<span class="project__info-title"><?php echo $post->post_title; ?></span>
			<div class="project__info__bottom">
				<a href="<?php echo esc_url( get_permalink($post->ID) ); ?>">Leer más</a>
			</div>
		</div>
        </a>
    </div>
    <?php
     }
    ?>    
</section>

<?php
	return ob_get_clean();
}

add_shortcode( 'ra_news', 'ra_news_sc' );
