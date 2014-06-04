<?php
//load class file
require_once('z2cs_class.php');

//Example
//Format = txt / xml / json
$z2cs = new zip2citystate;
$output = $z2cs->lookup('94301','json');
echo $output;
?>