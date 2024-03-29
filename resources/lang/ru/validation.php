<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class Some of these rules have multiple versions such
    | as the size rules Feel free to tweak each of these messages here
    |
    */

    'accepted'             => ':attribute должен быть принят',
    'active_url'           => ':attribute не является ссылкой',
    'after'                => ':attribute должно быть датой после :date',
    'after_or_equal'       => ':attribute должно быть датой после или равной :date',
    'alpha'                => ':attribute может содержать только буквы',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры, дефис и подчеркивание',
    'alpha_num'            => ':attribute может содержать только буквы и цифры',
    'array'                => ':attribute должно быть массивом',
    'before'               => ':attribute должно быть датой перед :date',
    'before_or_equal'      => ':attribute должно быть датой перед или равной :date',
    'between' => [
        'numeric' => ':attribute должно быть между :min и :max',
        'file'    => ':attribute должен быть от :min до :max килобайт',
        'string'  => ':attribute должна быть от :min до :max символов',
        'array'   => ':attribute должно содержать :min - :max элементов',
    ],
    'boolean'              => ':attribute должно быть логической истинной или ложью',
    'confirmed'            => ':attribute не совпадает с подтверждением',
    'date'                 => ':attribute не является датой',
    'date_format'          => ':attribute не соответствует формату :format',
    'different'            => ':attribute и :other должны различаться',
    'digits'               => ':attribute должен быть длиной :digits',
    'digits_between'       => ':attribute должен быть между :min и :max',
    'dimensions'           => ':attribute имеет недопустимые размеры изображения',
    'distinct'             => ':attribute имеет повторяющееся зачение',
    'email'                => 'Некорректный адрес электронной почты',
    'exists'               => ':attribute не зарегистрирован',
    'file'                 => ':attribute должно быть файлом',
    'filled'               => ':attribute обязательно для заполнения',
    'image'                => ':attribute должно быть изображением',
    'in'                   => 'Выбранное значение для :attribute ошибочно',
    'in_array'             => ':attribute не существует в :other',
    'integer'              => ':attribute должно быть целым числом',
    'ip'                   => 'Некорректный IP-адрес',
    'ipv4'                 => 'Некорректный IPv4-адрес',
    'ipv6'                 => 'Некорректный IPv6-адрес',
    'json'                 => 'Некорректная JSON строка',
    'max'                  => [
        'numeric' => ':attribute должно быть не больше :max',
        'file'    => ':attribute должно быть не больше :max Килобайт',
        'string'  => ':attribute должно быть не длиннее :max символов',
        'array'   => ':attribute должно содержать не более :max элементов',
    ],
    'mimes'                => ':attribute должно быть файлом одного из типов: :values',
    'mimetypes'            => ':attribute должно быть файлом одного из типов: :values',
    'min'                  => [
        'numeric' => ':attribute должен быть не менее :min',
        'file'    => ':attribute должен быть не менее :min Килобайт',
        'string'  => ':attribute должен быть не короче :min символов',
        'array'   => ':attribute должен содержать не менее :min элементов'
    ],
    'not_in'               => 'Выбранное значение для :attribute ошибочно',
    'numeric'              => ':attribute должно быть числом',
    'present'              => ':attribute должно присутствовать',
    'regex'                => ':attribute имеет неверный формат',
    'required'             => ':attribute обязательно для заполнения',
    'required_if'          => ':attribute обязательно для заполнения, когда :other равно :value',
    'required_unless'      => ':attribute обязательно для заполнения, когда :other не равно :values',
    'required_with'        => ':attribute обязательно для заполнения, когда :values указано',
    'required_with_all'    => ':attribute обязательно для заполнения, когда :values указаны',
    'required_without'     => ':attribute обязательно для заполнения, когда :values не указано',
    'required_without_all' => ':attribute обязательно для заполнения, когда :values не указаны',
    'same'                 => 'Значение :attribute должно совпадать с :other',
    'size'                 => [
        'numeric' => ':attribute должно быть :size',
        'file'    => ':attribute должно быть :size Килобайт',
        'string'  => ':attribute должно быть длиной :size символов',
    ],
    'string'               => ':attribute должно быть строкой',
    'timezone'             => ':attribute должнобыть валидной временной зоной',
    'unique'               => ':attribute уже занят',
    'uploaded'             => ':attribute не удалось загрузить',
    'url'                  => ':attribute имеет ошибочный формат',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attributerule" to name the lines This makes it quick to
    | specify a specific custom language line for a given attribute rule
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email" This simply helps us make messages a little cleaner
    |
    */

    'attributes' => [
        'username' => 'Никнейм',
        'email' => 'Адрес электронной почты',
        'password' => 'Пароль',
        'age' => 'Возраст',
        'phone' => 'Телефон',
    ],

];
