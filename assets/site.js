async function loadSiteData() {
    const response = await fetch('data/site-data.json');
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

function assetPath(path, prefix = '') {
    if (!path) {
        return '';
    }
    if (/^https?:\/\//i.test(path)) {
        return path;
    }
    return `${prefix}${String(path).replace(/^\/+/, '')}`;
}

function projectPagePath(slug) {
    return `projects/${slug}.html`;
}

function renderProfile(profile) {
    document.title = `${profile.name} | Portfolio`;
    document.getElementById('hero-eyebrow').textContent = profile.eyebrow;
    document.getElementById('hero-name').textContent = profile.name;
    document.getElementById('hero-summary').textContent = profile.summary;
    document.getElementById('hero-about-heading').textContent = profile.about_heading;
    document.getElementById('hero-about-text').textContent = profile.about_text;
    document.getElementById('hero-image').src = assetPath(profile.hero_image);
    document.getElementById('hero-image').alt = `Profile picture of ${profile.name}`;

    document.getElementById('hero-facts').innerHTML = profile.facts
        .map((fact) => `<span class="hero-fact">${escapeHtml(fact)}</span>`)
        .join('');

    document.getElementById('github-link').href = profile.github.url;
    document.getElementById('github-title').textContent = profile.github.title;
    document.getElementById('github-description').textContent = profile.github.description;

    document.getElementById('linkedin-link').href = profile.linkedin.url;
    document.getElementById('linkedin-title').textContent = profile.linkedin.title;
    document.getElementById('linkedin-description').textContent = profile.linkedin.description;

    document.getElementById('contact-email').textContent = profile.contact.email;
    document.getElementById('contact-phone').textContent = profile.contact.phone;
    document.getElementById('contact-location').textContent = profile.contact.location;
}

function renderProjects(projects) {
    const container = document.getElementById('projects-list');
    if (!projects.length) {
        container.innerHTML = '<div class="empty-state">No featured projects added yet.</div>';
        return;
    }

    container.innerHTML = projects
        .map((project) => {
            const previewImage = project.images[0];
            const technologies = project.technologies.length
                ? `<div class="project-tags">${project.technologies
                      .map(
                          (technology) => `
                            <span class="project-tag">
                                ${technology.icon ? `<img src="${escapeHtml(assetPath(technology.icon))}" alt="${escapeHtml(technology.name)} icon">` : ''}
                                <span>${escapeHtml(technology.name)}</span>
                            </span>
                        `
                      )
                      .join('')}</div>`
                : '';

            const period =
                project.started_at || project.completed_at
                    ? `<div class="project-meta">${escapeHtml(formatMonthYear(project.started_at || 'Start not added'))} - ${escapeHtml(formatMonthYear(project.completed_at))}</div>`
                    : '';

            const imageCount = project.images.length
                ? `<div class="project-meta">${project.images.length} project image${project.images.length > 1 ? 's' : ''} attached</div>`
                : '';

            return `
                <div class="project-item">
                    ${previewImage ? `<img class="project-preview" src="${escapeHtml(assetPath(previewImage.image_path))}" alt="${escapeHtml(project.title)}">` : ''}
                    <h3><a href="${escapeHtml(projectPagePath(project.slug))}">${escapeHtml(project.title)}</a></h3>
                    <p>${escapeHtml(project.short_description || project.description)}</p>
                    ${period}
                    ${technologies}
                    <div class="project-links">
                        <a class="project-link" href="${escapeHtml(projectPagePath(project.slug))}">View Project</a>
                        ${project.github_url ? `<a class="project-link" href="${escapeHtml(project.github_url)}" target="_blank" rel="noreferrer">GitHub</a>` : '<a class="project-link" >Source Code: Proprietary</a>'}
                        ${project.demo_url ? `<a class="project-link" href="${escapeHtml(project.demo_url)}" target="_blank" rel="noreferrer">Live Demo</a>` : ''}
                    </div>
                    ${imageCount}
                </div>
            `;
        })
        .join('');
}
function renderProProjects(projects) {
    const container = document.getElementById('projects-professional');
    if (!projects.length) {
        container.innerHTML = '<div class="empty-state">No projects added yet.</div>';
        return;
    }

    container.innerHTML = projects
        .map((project) => {
            const previewImage = project.images[0];
            const technologies = project.technologies.length
                ? `<div class="project-tags">${project.technologies
                      .map(
                          (technology) => `
                            <span class="project-tag">
                                ${technology.icon ? `<img src="${escapeHtml(assetPath(technology.icon))}" alt="${escapeHtml(technology.name)} icon">` : ''}
                                <span>${escapeHtml(technology.name)}</span>
                            </span>
                        `
                      )
                      .join('')}</div>`
                : '';

            const period =
                project.started_at || project.completed_at
                    ? `<div class="project-meta">${escapeHtml(formatMonthYear(project.started_at || 'Start not added'))} - ${escapeHtml(formatMonthYear(project.completed_at))}</div>`
                    : '';

            const imageCount = project.images.length
                ? `<div class="project-meta">${project.images.length} project image${project.images.length > 1 ? 's' : ''} attached</div>`
                : '';

            return `
                <div class="project-item">
                    ${previewImage ? `<img class="project-preview" src="${escapeHtml(assetPath(previewImage.image_path))}" alt="${escapeHtml(project.title)}">` : ''}
                    <h3><a href="${escapeHtml(projectPagePath(project.slug))}">${escapeHtml(project.title)}</a></h3>
                    <p>${escapeHtml(project.short_description || project.description)}</p>
                    ${period}
                    ${technologies}
                    <div class="project-links">
                        <a class="project-link" href="${escapeHtml(projectPagePath(project.slug))}">View Project</a>
                        <a class="project-link" >Source Code: Proprietary</a>
                        ${project.demo_url ? `<a class="project-link" href="${escapeHtml(project.demo_url)}" target="_blank" rel="noreferrer">Live Demo</a>` : ''}
                    </div>
                    ${imageCount}
                </div>
            `;
        })
        .join('');
}

function renderSkills(skills) {
    const container = document.getElementById('skills-groups');
    if (!skills.length) {
        container.innerHTML = '<div class="empty-state">No skills added yet.</div>';
        return;
    }

    const grouped = new Map();
    skills
        .slice()
        .sort((a, b) => (a.sort_order ?? 0) - (b.sort_order ?? 0) || a.name.localeCompare(b.name))
        .forEach((skill) => {
            const category = skill.category || 'Uncategorized';
            if (!grouped.has(category)) {
                grouped.set(category, []);
            }
            grouped.get(category).push(skill);
        });

    container.innerHTML = Array.from(grouped.entries())
        .map(
            ([category, groupedSkills]) => `
            <div class="skill-group">
                <h3>${escapeHtml(category)}</h3>
                ${groupedSkills
                    .map(
                        (skill) => `
                        <div class="skill-item">
                            <div><strong>${escapeHtml(skill.name)}</strong></div>
                            ${skill.proficiency != null ? `<div class="skill-score">Proficiency: ${escapeHtml(skill.proficiency)}</div>` : ''}
                        </div>
                    `
                    )
                    .join('')}
            </div>
        `
        )
        .join('');
}

function renderEducations(educations) {
    const container = document.getElementById('education-list');
    if (!educations.length) {
        container.innerHTML = '<div class="empty-state">No education entries added yet.</div>';
        return;
    }

    container.innerHTML = educations
        .slice()
        .sort((a, b) => (a.sort_order ?? 0) - (b.sort_order ?? 0))
        .map(
            (education) => `
            <div class="education-item">
                <h3>${escapeHtml(education.institution)}</h3>
                <div class="education-degree">${escapeHtml(education.degree_type)}</div>
                <div class="education-meta">Degree obtained: ${escapeHtml(education.degree_obtained || 'Not added')}</div>
                <p>${escapeHtml(education.subject)}</p>
                ${education.cgpa != null ? `<div class="education-meta">CGPA: ${escapeHtml(Number(education.cgpa).toFixed(2))}</div>` : ''}
            </div>
        `
        )
        .join('');
}

function renderExperiences(experiences) {
    const container = document.getElementById('experience-list');
    if (!experiences.length) {
        container.innerHTML = '<div class="empty-state">No experience entries added yet.</div>';
        return;
    }

    container.innerHTML = experiences
        .slice()
        .sort((a, b) => (a.sort_order ?? 0) - (b.sort_order ?? 0))
        .map(
            (experience) => `
            <div class="experience-item">
                <h3>${escapeHtml(experience.position)} at ${escapeHtml(experience.company_name)}</h3>
                <div class="experience-meta">${escapeHtml(experience.location || 'Location not added')}</div>
                <div class="experience-meta">${escapeHtml(formatMonthYear(experience.start_date || 'Start date not added'))} - ${escapeHtml(formatMonthYear(experience.end_date))}</div>
                ${experience.description ? `<p>${escapeHtml(experience.description)}</p>` : ''}
                ${experience.reference ? `<div class="experience-reference">${escapeHtml(experience.reference)}</div>` : ''}
            </div>
        `
        )
        .join('');
}

loadSiteData()
    .then((data) => {
        renderProfile(data.profile);
        renderProjects(data.projects.filter((project) => project.featured));
        renderProProjects(data.professional_projects.filter((project) => project.featured));
        renderSkills(data.skills);
        renderEducations(data.educations);
        renderExperiences(data.experiences);
    })
    .catch((error) => {
        console.error(error);
        document.body.insertAdjacentHTML(
            'beforeend',
            '<div class="page-shell"><div class="empty-state">Could not load static portfolio data.</div></div>'
        );
    });
