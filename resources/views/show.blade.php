<?php
	str_replace("}}", "?>", str_replace("{{", "<?php", $html));
	echo $html;