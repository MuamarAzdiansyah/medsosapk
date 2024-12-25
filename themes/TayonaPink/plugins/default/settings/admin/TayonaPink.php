<?php
echo ossn_view_form('TayonaPink/settings', array(
    'action' => ossn_site_url() . 'action/TayonaPink/settings',
	'class' => 'tayonapink-form-admin',	
));
?>
<script>
$(document).ready(function() {
	$('#logo_text_color').colorpicker({
		position: {
			my: 'center',
			at: 'center',
			of: window
		},
		modal: true,
        colorFormat: ['RGB'],
            init: function(event, color) {
                $('#logo_text_color').text(color.formatted);
            },
            select: function(event, color) {
                $('#logo_text_color').text(color.formatted);
            }
	});
});
</script>
