<?php
use Spirit\Services\Validator\Rule;

return [
    Rule::TYPE_EXISTS => 'Неверное значение в поле <b>:attr</b>',
    Rule::TYPE_UNIQUE => 'Значение в поле <b>:attr</b> должно быть уникальным',
    Rule::TYPE_EMAIL => 'Значение в поле <b>:attr</b> не проходит проверку на электронный адрес',
    Rule::TYPE_REQUIRED => 'Поле <b>:attr</b> обязательно к заполнению',
    Rule::TYPE_REQUIRED_IF => [
        'exist' => 'Поле <b>:attr</b> обязательно к заполнению, если заполнено поле <b>:attr_if</b>',
        'value' => 'Поле <b>:attr</b> обязательно к заполнению, если поле <b>:attr_if</b> имеет значение <b>{{VALUE}}</b>',
    ],
    Rule::TYPE_SAME => 'Значения в поле <b>:attr</b> и в поле  <b>:attr_same</b> должны совпадать',
    Rule::TYPE_URL => 'Неверное значение в поле <b>:attr</b>',
    Rule::TYPE_DATE => 'Неправильная дата в поле <b>:attr</b>',
    Rule::TYPE_DATE_FORMAT => 'Дата в поле <b>:attr</b> не соответствует формату',
    Rule::TYPE_BOOLEAN => 'Неверное значение в поле <b>:attr</b>',
    Rule::TYPE_AFTER => 'Дата в поле <b>:attr</b> должна быть больше :after',
    Rule::TYPE_BEFORE => 'Дата в поле <b>:attr</b> должна быть меньше :before',
    Rule::TYPE_IMAGE => 'Загруженный файл <b>:attr</b> не является изображением',
    Rule::TYPE_BETWEEN => [
        'string' => 'Значение в поле <b>:attr</b> должно быть от :min до :max символов',
        'numeric' => 'Значение в поле <b>:attr</b> должно быть от :min до :max',
        'array' => 'Количество значений в поле <b>:attr</b> должно быть от :min до :max',
        'file' => 'Загруженный файл <b>:attr</b> должен быть размером от :min до :max килобайт',
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