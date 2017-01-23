<?php
return [
        'name' => 'FoodForFun',
        'title' => 'FoodForFun',
        'subtitle' => '以美食之名发现乐趣',
        'description' => '以美食之名发现乐趣',
        'author' => 'FoodForFun',
        'posts_per_page' => 5,
        'page_image' => '/upload/image/post_pic_default.jpg',
        'contact_image' => '/upload/image/contact-bg.jpg',
        'contact_email' => 'sanmisan@foodforfun.me',
        'rss_size' => 25,
        'uploads' => [
            'storage' => 'local',   //定义使用的文件系统
            'webpath' => '/upload/' //定义web访问根目录
        ]
];