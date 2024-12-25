<?php

return [
    'required' => 'Vui lòng nhập đầy đủ :attribute.',
    'string' => 'Trường :attribute phải là một chuỗi ký tự.',
    'integer' => 'Trường :attribute phải là số nguyên',
    'in' => 'Giá trị đã chọn cho trường :attribute không hợp lệ.',
    'unique' => 'Trường :attribute đã tồn tại trong hệ thống.',
    'email' => 'Trường :attribute phải là địa chỉ email hợp lệ.',
    'alpha_dash' => 'Trường :attribute chỉ được chứa chữ cái, số, dấu gạch ngang, và dấu gạch dưới.',
    'max' => [
        'string' => 'Trường :attribute không được vượt quá :max ký tự.',
    ],
    'min' => [
        'array' => 'Trường :attribute phải có ít nhất :min mục.'
    ],
    'size' => [
        'string' => 'Trường :attribute phải luôn có :size ký tự',
    ],
    'regex' => 'Trường :attribute có định dạng không hợp lệ',
    'date' => 'Trường :attribute phải là ngày hợp lệ.',
    'before' => 'Trường :attribute phải là ngày trước ngày :date.',
    'after' => 'Trường :attribute phải là ngày sau ngày :date.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'attributes' => [
        'username'=>'tên đăng nhập',
        'fullname'=>'họ tên',
        'password' => 'mật khẩu',
        'phone' => 'số điện thoại',
        'address' => 'địa chỉ',
    ],
    'custom' => [
        'username' => [
            'unique' => 'Tên đăng nhập này đã được đăng ký. Vui lòng chọn một tên đăng nhập khác.',
            'max' => 'Tên đăng nhập tối đa 255 ký tự',
        ],
        'password' => [
            'min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',
        ],
        'fullname' => [
            'max' => 'Họ tên tối đa 255 ký tự',
        ],
        'email' => [
            'unique' => 'Địa chỉ email đã được sử dụng. Vui lòng chọn một địa chỉ khác.',
            'max' => 'Email tối đa 255 ký tự',
        ],
        'phone' => [
            'max' => 'Số điện thoại tối đa 15 ký tự',
        ],
        'address' => [
            'max' => 'Địa chỉ tối đa 255 ký tự',
        ],
        
    ],
    'attribute_sum_min' => 'Tổng của :attribute phải ít nhất là :min'
];