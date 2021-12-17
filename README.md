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
    "url": "https://github.com/micro-php-libs/micro-supports.git"
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

**Common Helper**
- check using Trait class

## NOTE

- For my usage, if it can help you in someway then great.
- No promise solve your issue
- It opens then feel free to fork and fix or add your changes if needed
- No testing, not sure if it still has bugs

## License

Under MIT. 

Package by Ty Huynh <hongty.huynh@gmail.com>. 

Feel free to use.
