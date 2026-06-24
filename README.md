# Portfolio

This repository now contains a static portfolio site prepared for GitHub Pages.

## Local Preview

Run a simple static server from the project root:

```bash
php -S 127.0.0.1:8080
```

Then open:

```text
http://127.0.0.1:8080/index.html
```

## Static Files

- `index.html` - homepage
- `projects/*.html` - project detail pages
- `data/site-data.json` - portfolio content
- `assets/site.css` - shared styling
- `assets/site.js` - homepage rendering
- `assets/project.js` - project page rendering
- `public/images/*` - screenshots, tech icons, and profile image

## Editing Content

Most content now lives in:

```text
data/site-data.json
```

Update this file to change:

- profile text
- hero facts
- skills
- education
- experience
- project summaries
- project screenshots
- technologies
- project highlights
- contact/social links

## Notes

- The old Laravel Blade-driven rendering path has been removed from active use.
- `routes/web.php` now only redirects to the static HTML pages if Laravel is ever started.
- GitHub Pages should use the static files directly from the repository.
