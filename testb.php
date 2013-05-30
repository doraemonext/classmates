<?php

$query_string = 'foo=' . urlencode('s&@#$%^&*()');
echo htmlentities($query_string);

?>
