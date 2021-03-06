<?php

return [
    'apiUrl' => 'https://in.sherlockscore.com/v1',
    'waitTimeout' => 5,
    'apiKey' => env('SHERLOCK_SCORE_API_KEY', null),
    'enabled' => env('SHERLOCK_SCORE_ENABLED', true),
    'async_calls' => env('SHERLOCK_ASYNC_CALLS', false),
];