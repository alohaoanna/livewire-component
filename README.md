# Livewire component

```bash
composer require oanna/livewire-component
```

```bash
php artisan livewire-component:install
```

Ajouter les scripts est les assets à vos templates. 
```html
<head>
    ...
    @oannaAssets
    ...
</head>
<body>
    ...
    @oannaScripts
    ...
</body>
```

Importez les styles dans votre css/scss si nécessaire. (recommander)
```css
@import "../../vendor/oanna/livewire-component/dist/oanna.css";  
/*@import "../../vendor/oanna/livewire-component/dist/oanna.min.css"; FICHIER ALTERNATIVE */
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
