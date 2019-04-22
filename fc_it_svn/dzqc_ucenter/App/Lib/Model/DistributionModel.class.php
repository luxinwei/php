<?php

class DistributionModel extends QModel {
	function notify($url) {
		$app_list = C ( 'APP_LIST' );
		
		foreach ($app_list as $app) {
			Method::curl_get($app.$url);
		}
	}
}