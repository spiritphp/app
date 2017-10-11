<?php
use Spirit\Services\Validator\Rule;

return [
    Rule::TYPE_EXISTS => 'The selected <b>:attr</b> is invalid',
    Rule::TYPE_UNIQUE => 'The <b>:attr</b> has already been taken',
    Rule::TYPE_EMAIL => 'The <b>:attr</b> must be a valid email address.',
    Rule::TYPE_REQUIRED => 'The <b>:attr</b> field is required',
    Rule::TYPE_REQUIRED_IF => [
        'exist' => 'Поле <b>:attr</b> обязательно к заполнению, если заполнено поле <b>:attr_if</b>',
        'value' => 'Поле <b>:attr</b> обязательно к заполнению, если поле <b>:attr_if</b> имеет значение <b>:value</b>',
    ],
    Rule::TYPE_SAME => 'The <b>:attr</b> and <b>:attr_same</b> must match',
    Rule::TYPE_URL => 'The <b>:attr</b> is not a valid url',
    Rule::TYPE_DATE => 'The <b>:attr</b> is not a valid date',
    Rule::TYPE_DATE_FORMAT => 'The <b>:attr</b> does not match the format',
    Rule::TYPE_BOOLEAN => 'The <b>:attr</b> field must be true or false.',
    Rule::TYPE_AFTER => 'Дата в поле <b>:attr</b> должна быть больше :after',
    Rule::TYPE_BEFORE => 'Дата в поле <b>:attr</b> должна быть меньше :before',
    Rule::TYPE_IMAGE => 'Загруженный файл <b>:attr</b> не является изображением',
    Rule::TYPE_BETWEEN => [
        'string' => 'Значение в поле <b>:attr</b> должно быть от :min до :max символов',
        'numeric' => 'Значение в поле <b>:attr</b> должно быть от :min до :max',
        'array' => 'Количество значений в поле <b>:attr</b> должно быть от :min до :max',
        'file' => 'Загруженный файл <b>:attr</b> должен быть размером от :min до :max байт',
    ],
    Rule::TYPE_INTEGER => 'Значение в поле <b>:attr</b> должно быть числом',
    Rule::TYPE_STRING => 'Значение в поле <b>:attr</b> должно быть строкой',
    Rule::TYPE_NUMERIC => 'Значение в поле <b>:attr</b> должно быть числом',
    Rule::TYPE_CONFIRMED => 'Значения в поле <b>:attr</b> и в поле  <b>:attr_same</b> должны совпадать',
    Rule::TYPE_REGEX => 'Неверное значение в поле <b>:attr</b>',
    Rule::TYPE_MIN => [
        'string' => 'Значение в поле <b>:attr</b> должно быть больше :min символов',
        'numeric' => 'Значение в поле <b>:attr</b> должно быть больше :min',
        'array' => 'Количество значений в поле <b>:attr</b> должно быть больше :min',
        'file' => 'Загруженный файл <b>:attr</b> должен быть размером больше :min байт',
    ],
    Rule::TYPE_MAX => [
        'string' => 'Значение в поле <b>:attr</b> должно быть меньше :max символов',
        'numeric' => 'Значение в поле <b>:attr</b> должно быть меньше :max',
        'array' => 'Количество значений в поле <b>:attr</b> должно быть меньше :max',
        'file' => 'Загруженный файл <b>:attr</b> должен быть размером меньше :min байт',
    ],
    'customs' => []
];