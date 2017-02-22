<?php

// $dir = 'Lisura';
// $dir = 'Ivan';
// $dir = 'Adinan';
// $dir = 'Fernando';
$dir = 'SampleQuestions';

return array(
    'questions_dir' => realpath(__DIR__ . DIRECTORY_SEPARATOR . "../Questions/{$dir}"),
    'questions_file_name' => 'questions'
);
