# Laravel Supports Helper

This is package for helping dev process.
Some helper classes for Laravel Projects

## Require

- laravel/framework: ^8.41
- spatie/laravel-http-logger:^1.7

## Install

Config repository composer.json 

```
{
    "type": "vcs",
    "url": "https://personal-access-token@github.com/micro-php-libs/micro-supports.git"
}
```

Then add the package to dependency

```
"micro-php-libs/micro-supports": "dev-master",
```

## Supports

**Eloquent**
- Eloquent DB Trait
- Eloquent Read Only Model Trait

**Miscellaneous**
- array functions 
- http functions
- string function 
- jp function 

**Http**
- Custom Log class for spatie/laravel-http-logger
- Json response wrapper 

**Array**
- Array to XML 

**Validation Rules**
- Japan phone
- Base64
- Base64 Image
- Kanji string
- Kana string

**Services**
- Image Imagick: make image, change gray scale, change dpi

**Common Helper**
- check using Trait class

## NOTE

- For internal usage, if it can help you in someway then great.
- No promise solve your issue
- No testing, not sure if it still has bugs
- Use it if you were being allowed by author

## License

Under MIT. 

Package by Ty Huynh <hongty.huynh@gmail.com>. 

Feel free to use.
