# Laravel Markdown Blog

this repo implement blog feature built using laravel and tailwindcss

the data is hardcoded in `storage/posts` folder with markdown syntax.

you can add image in `public/posts` folder and add like this in your markdown files

```markdown
![image](./myimage.png)
```

## Requirement

- laravel 10
- php 8.2
- node v18

## Getting Started

```bash
git clone https://github.com/jhonoryza/laravel-blog-markdown.git
composer update
npm install
npm run build
php artisan serve
```

access from url [http://localhost:8000](http://localhost:8000)
