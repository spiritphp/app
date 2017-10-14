<?php
use Spirit\Services\Validator\Rule;

return [
    Rule::TYPE_EXISTS => 'The selected <b>:attr</b> is invalid',
    Rule::TYPE_UNIQUE => 'The <b>:attr</b> has already been taken',
    Rule::TYPE_EMAIL => 'The <b>:attr</b> must be a valid email address.',
    Rule::TYPE_REQUIRED => 'The <b>:attr</b> field is required',
    Rule::TYPE_REQUIRED_IF => [
        'exist' => 'The <b>:attr</b> field is required when <b>:attr_if</b> is filled',
        'value' => 'The <b>:attr</b> field is required when <b>:attr_if</b> is <b>:value</b>',
    ],
    Rule::TYPE_SAME => 'The <b>:attr</b> and <b>:attr_same</b> must match',
    Rule::TYPE_URL => 'The <b>:attr</b> is not a valid url',
    Rule::TYPE_DATE => 'The <b>:attr</b> is not a valid date',
    Rule::TYPE_DATE_FORMAT => 'The <b>:attr</b> does not match the format',
    Rule::TYPE_BOOLEAN => 'The <b>:attr</b> field must be true or false.',
    Rule::TYPE_AFTER => 'The <b>:attr</b> must be a date after :after',
    Rule::TYPE_BEFORE => 'The <b>:attr</b> must be a date before :before',
    Rule::TYPE_IMAGE => 'The <b>:attr</b> must be an image',
    Rule::TYPE_BETWEEN => [
        'string' => 'The <b>:attr</b> must be between :min and :max characters',
        'numeric' => 'The <b>:attr</b> must be between :min and :max',
        'array' => 'The <b>:attr</b> must have between :min and :max items',
        'file' => 'The <b>:attr</b> must be between :min and :max kilobytes',
    ],
    Rule::TYPE_INTEGER => 'The <b>:attr</b> must be an integer',
    Rule::TYPE_STRING => 'The <b>:attr</b> must be a string',
    Rule::TYPE_NUMERIC => 'The <b>:attr</b> must be a number',
    Rule::TYPE_CONFIRMED => 'The <b>:attr</b> confirmation does not match',
    Rule::TYPE_REGEX => 'The <b>:attr</b> format is invalid',
    Rule::TYPE_MIN => [
        'numeric' => 'The <b>:attr</b> must be at least :min.',
        'file' => 'The <b>:attr</b> must be at least :min kilobytes.',
        'string' => 'The <b>:attr</b> must be at least :min characters.',
        'array' => 'The <b>:attr</b> must have at least :min items.',
    ],
    Rule::TYPE_MAX => [
        'numeric' => 'The <b>:attr</b> may not be greater than :max.',
        'file' => 'The <b>:attr</b> may not be greater than :max kilobytes.',
        'string' => 'The <b>:attr</b> may not be greater than :max characters.',
        'array' => 'The <b>:attr</b> may not have more than :max items.',
    ],
    'customs' => []
];