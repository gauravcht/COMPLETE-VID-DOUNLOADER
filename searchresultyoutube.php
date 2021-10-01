<?php
//-> Auctor : Zhareiv 
//-> 
//-> 
$add_action->add_action('Hook_code_plugin_1','search_result_yt');
function search_result_yt(){
		global $data_load;
		$data_load['status']  			= 400;
		$data_load['status_search']  	= 400;

		if (!empty($_POST['search_value'])) {
			$search_value 	= PHP_Secure($_POST['search_value']);
			$search_result 	= PHP_SYSTEM_url_get_contents("https://suggestqueries.google.com/complete/search?client=youtube&ds=yt&q=".urlencode($search_value));
			$out = substr($search_result, strpos($search_result, "(", 0)+1);
			$out = substr($out, 0, strpos($out, ")", 0));
			@$data_result = json_decode($out, true);
			if (!empty($data_result[1])) {
				$html = '';
				foreach ($data_result[1] as $key => $search) {
					$search_text = str_replace(' ','+',$search[0]);
					$html.= "<a class='search_dropdown_yt_a' target='_blank' href='https://www.youtube.com/results?search_query=".$search_text."'><div class='search_result_yt'>".$search[0]."</div></a>";
				}
				$data_load = array('status' => 200, 'status_search' => 200, 'html' => $html);
			}else{
				$data_load['status_search']  = 400;
			} 
		}  
	}  
