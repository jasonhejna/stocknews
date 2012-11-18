<?php
$string = 'a';
while ($string != 'aaaaa') {
    echo $string++,PHP_EOL;
}

function combinations($size) {
    $string = str_repeat('a',$size);
    $endLoopTest = str_repeat('z',$size);
    $endLoopTest++;
    while ($string != $endLoopTest) {
        echo $string++,PHP_EOL;
    }
}
?>