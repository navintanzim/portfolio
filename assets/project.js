async function loadSiteData() {
    const response = await fetch('../data/site-data.json');
    if (!response.ok) {
        throw new Error('Could not load site data.');
    }
    return response.json();
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

function assetPath(path) {
    if (!path) {
        return '';
    }
    if (/^https?:\/\//i.test(path)) {
        return path;
    }
    return `../${String(path).replace(/^\/+/, '')}`;
}

function formatMonthYear(value) {
    if (!value) {
        return 'Present';
    }
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) {
        return value;
    }
    return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
}

const projectSlug = document.body.dataset.projectSlug;

loadSiteData()
    .then((data) => {
        const project = data.projects.find((item) => item.slug === projectSlug);
        if (!project) {
            throw new Error(`Project not found for slug: ${projectSlug}`);
        }

        document.title = `${project.title} | ${data.profile.name}`;
        document.getElementById('project-title').textContent = project.title;
        document.getElementById('project-eyebrow').textContent = 'Project Case Study';
        document.getElementById('project-summary').textContent = project.short_description || project.description || '';
        document.getElementById('project-period').textContent =
            project.started_at || project.completed_at
                ? `${formatMonthYear(project.started_at || 'Start not added')} - ${formatMonthYear(project.completed_at)}`
                : 'Timeline not added';

        const featuredBadge = document.getElementById('project-featured');
        if (!project.featured) {
            featuredBadge.remove();
        }

        const cover = project.images[0];
        const coverContainer = document.getElementById('project-cover');
        if (cover) {
            coverContainer.innerHTML = `<img class="cover-image" src="${escapeHtml(assetPath(cover.image_path))}" alt="${escapeHtml(cover.caption || project.title)}">`;
        } else {
            coverContainer.innerHTML = '<div class="empty-note">No project cover image added yet.</div>';
        }

        const tags = document.getElementById('project-tags');
        if (project.technologies.length) {
            tags.innerHTML = project.technologies
                .map(
                    (technology) => `
                        <span class="tag">
                            ${technology.icon ? `<img src="${escapeHtml(assetPath(technology.icon))}" alt="${escapeHtml(technology.name)} icon">` : ''}
                            <span>${escapeHtml(technology.name)}</span>
                        </span>
                    `
                )
                .join('');
        } else {
            tags.remove();
        }

        const links = document.getElementById('project-links');
        const linkItems = [];
        if (project.github_url) {
            linkItems.push(`<a class="action-link" href="${escapeHtml(project.github_url)}" target="_blank" rel="noreferrer">View GitHub</a>`);
        }
        if (project.demo_url) {
            linkItems.push(`<a class="action-link" href="${escapeHtml(project.demo_url)}" target="_blank" rel="noreferrer">View Live Demo</a>`);
        }
        if (linkItems.length) {
            links.innerHTML = linkItems.join('');
        } else {
            links.remove();
        }

        const overview = document.getElementById('project-overview');
        overview.textContent = project.description || 'No full project description added yet.';

        const highlights = document.getElementById('project-highlights');
        if (project.highlights.length) {
            highlights.innerHTML = project.highlights
                .map((highlight) => `<div class="highlight-item">${escapeHtml(highlight)}</div>`)
                .join('');
        } else {
            highlights.innerHTML = '<div class="empty-note">No project highlights added yet.</div>';
        }

        const screenshots = document.getElementById('project-screenshots');
        if (project.images.length) {
            screenshots.innerHTML = project.images
                .map(
                    (image) => `
                        <div class="image-card">
                            <img src="${escapeHtml(assetPath(image.image_path))}" alt="${escapeHtml(image.caption || project.title)}">
                            ${image.caption ? `<p class="caption">${escapeHtml(image.caption)}</p>` : ''}
                        </div>
                    `
                )
                .join('');
        } else {
            screenshots.innerHTML = '<div class="empty-note">No screenshots added yet.</div>';
        }
    })
    .catch((error) => {
        console.error(error);
        document.body.insertAdjacentHTML(
            'beforeend',
            '<div class="page-shell"><div class="empty-state">Could not load the project page.</div></div>'
        );
    });
