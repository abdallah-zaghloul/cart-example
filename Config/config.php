<?php

return [
    'name' => 'User',
    'should_verify_email' => (bool) env('VERIFY_USER_EMAIL',false)
];
