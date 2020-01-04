<?php

return [
    'PostTooLargeException' => 'The file is larger than ' . ini_get('post_max_size') . 'B. Please consider providing a small one.'
];