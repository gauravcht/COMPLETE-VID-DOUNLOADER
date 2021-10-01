<?php
#=======
# ->
# ->
# ->
#======= 
$add_action->add_action('Hook_load_plugin_8_1_1','HtmlSearch_youtube');
function HtmlSearch_youtube(){
	echo "
		<div class='search_dropdown_yt hidden'></div>
		<style>
			.search_dropdown_yt {
				position: absolute;
				left: 0;
				right: 0;
				width: 100%;
				background-color: #fff;
				color: #333;
				border-right: 1px solid #f2f2f2;
				border-left: 1px solid #f2f2f2;
				border-bottom: 1px solid #f2f2f2;
				font-family: Open Sans,Helvetica,Arial,sans-serif;
				text-align: initial;
				font-size: 14px;
				z-index: 5;
			}

			.search_result_yt {
				padding: 10px;
			}

			.search_dropdown_yt_a {
				color: #384552 !important;
				text-decoration: unset !important;
			}

			.search_result_yt:active,.search_result_yt:focus,.search_result_yt:hover {
				background: #f5f7f9;
			}
		</style>
		<script>
			$('#data_urls').keyup(function(event) {
				var token_data = $('#token_hidden').val();
				var search_value = $(this).val();
				var search_dropdown = $('.search_dropdown_yt');
				if (search_value == '') {
					search_dropdown.addClass('hidden');
					search_dropdown.empty();
					return false;
				} else {
					search_dropdown.removeClass('hidden');
				}
				$.post('{{LINK requests.php?upload=search_data&mailer=}}'+token_data, {search_value: search_value}, function(data, textStatus, xhr) {
					if (data.status == 200) {
						search_dropdown.html(data.html);
						$('#token_web').html('<input id=token_hidden type=hidden name=token[mailer_web] value=' + data.token_web + '>');
					} else {
					   search_dropdown.addClass('hidden');
					   search_dropdown.empty();
					   $('#token_web').html('<input id=token_hidden type=hidden name=token[mailer_web] value=' + data.token_web + '>');
					   return false;
					}
				});
			});
			jQuery(document).click(function(event){
				if (!(jQuery(event.target).closest('.search_dropdown_yt').length)) {
					jQuery('.search_dropdown_yt').addClass('hidden');
				}
			});
		</script>
	";
}


 
