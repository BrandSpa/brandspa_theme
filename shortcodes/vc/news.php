<?php
function ra_news_vc() {
	vc_map(
    [
      "name" =>  "news",
      "base" => "ra_news",
      "category" =>  "RA",
      'params' => []
		]
	);
}
add_action( 'vc_before_init', 'ra_news_vc' );