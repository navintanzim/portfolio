<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portfolio') }}</title>
    <style>
        :root {
            --bg: #f5efe6;
            --surface: rgba(255, 250, 244, 0.78);
            --surface-strong: #fffaf4;
            --text: #1f2937;
            --muted: #6b7280;
            --line: rgba(31, 41, 55, 0.12);
            --accent: #c66b3d;
            --accent-soft: rgba(198, 107, 61, 0.12);
            --shadow: 0 24px 80px rgba(84, 54, 31, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(198, 107, 61, 0.18), transparent 28%),
                radial-gradient(circle at top right, rgba(47, 95, 83, 0.14), transparent 24%),
                linear-gradient(180deg, #f8f2ea 0%, var(--bg) 100%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page-shell {
            width: min(1120px, calc(100% - 2rem));
            margin: 0 auto;
            padding: 2rem 0 4rem;
        }

        .topbar {
            position: sticky;
            top: 1rem;
            z-index: 10;
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .topbar nav {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0.85rem 1rem;
            border: 1px solid var(--line);
            border-radius: 999px;
            background: rgba(255, 250, 244, 0.72);
            backdrop-filter: blur(16px);
            box-shadow: var(--shadow);
        }

        .topbar a {
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .topbar a:hover {
            background: var(--accent-soft);
            color: var(--text);
        }

        .hero,
        .section-card {
            border: 1px solid var(--line);
            background: var(--surface);
            backdrop-filter: blur(12px);
            box-shadow: var(--shadow);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.3fr 0.9fr;
            gap: 1.5rem;
            padding: 2rem;
            border-radius: 32px;
            margin-bottom: 1.5rem;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            font-size: 0.9rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        h1 {
            font-size: clamp(2.6rem, 6vw, 5.2rem);
            line-height: 0.95;
            margin-bottom: 1rem;
        }

        .hero p {
            max-width: 42rem;
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.75;
        }

        .hero-panel {
            display: grid;
            gap: 1rem;
        }

        .placeholder-box {
            border: 1px dashed rgba(198, 107, 61, 0.4);
            border-radius: 24px;
            background:
                linear-gradient(135deg, rgba(198, 107, 61, 0.12), rgba(47, 95, 83, 0.08)),
                var(--surface-strong);
            min-height: 220px;
            padding: 1.25rem;
        }

        .placeholder-box strong,
        .section-card strong {
            display: block;
            margin-bottom: 0.45rem;
            font-size: 1rem;
        }

        .placeholder-box span,
        .section-card p,
        .link-grid a span {
            color: var(--muted);
            line-height: 1.7;
        }

            .hero-image {
                width: 100%;
                max-width: 300px;
                height: 300px;
                object-fit: cover;
                object-position: center top;
                border-radius: 20px;
                border: 1px solid rgba(31, 41, 55, 0.1);
                box-shadow: 0 16px 40px rgba(84, 54, 31, 0.18);
                margin-bottom: 1rem;
                margin-inline: auto;
            }

        .hero-facts {
            display: grid;
            gap: 0.65rem;
            margin-top: 0.25rem;
        }

        .hero-fact {
            display: block;
            padding: 0.7rem 0.85rem;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.56);
            border: 1px solid var(--line);
            font-weight: 700;
            color: var(--text);
            line-height: 1.5;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.25rem;
        }

        .section-card {
            padding: 1.5rem;
            border-radius: 28px;
            min-height: 220px;
        }

        .section-card h2 {
            margin-bottom: 0.8rem;
            font-size: 1.7rem;
        }

        .span-7 {
            grid-column: span 7;
        }

        .span-5 {
            grid-column: span 5;
        }

        .span-6 {
            grid-column: span 6;
        }

        .span-12 {
            grid-column: span 12;
        }

        .link-grid {
            display: grid;
            gap: 1rem;
        }

        .link-grid a {
            display: block;
            padding: 1rem 1.1rem;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.36);
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .link-grid a:hover {
            transform: translateY(-2px);
            border-color: rgba(198, 107, 61, 0.4);
        }

        .link-cta {
            display: inline-flex;
            align-items: center;
            margin-top: 0.85rem;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--accent);
        }

        .contact-list {
            display: grid;
            gap: 0.75rem;
            margin-top: 1rem;
        }

            .stack-list,
            .experience-list,
            .education-list,
            .project-list {
                display: grid;
                gap: 0.9rem;
                margin-top: 1rem;
            }

            .project-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        .skill-groups {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .skill-group {
            padding: 1rem 1.1rem;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.42);
        }

        .skill-group h3 {
            margin-bottom: 0.85rem;
            font-size: 1rem;
            color: var(--accent);
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

            .skill-item,
            .experience-item,
            .education-item,
            .project-item {
                padding: 1rem 1.1rem;
                border-radius: 20px;
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.42);
            }

        .skill-item {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 0;
            border: 0;
            border-radius: 0;
            background: transparent;
        }

        .skill-item+.skill-item {
            border-top: 1px solid var(--line);
        }

        .skill-meta,
        .experience-meta {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .experience-meta {
            display: block;
            margin-top: 0.25rem;
            font-weight: 700;
            color: var(--text);
        }

        .skill-score {
            flex-shrink: 0;
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .experience-item h3 {
            margin-bottom: 0.35rem;
            font-size: 1.1rem;
        }

        .experience-reference {
            margin-top: 0.85rem;
            font-weight: 700;
            line-height: 1.7;
            color: var(--text);
        }

        .education-item h3 {
            margin-bottom: 0.35rem;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .education-degree {
            margin-bottom: 0.25rem;
            color: var(--text);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

            .education-meta {
                margin-top: 0.35rem;
                font-weight: 700;
                color: var(--text);
                line-height: 1.6;
            }

            .project-item h3 {
                margin-bottom: 0.4rem;
                font-size: 1.15rem;
            }

            .project-meta {
                margin-top: 0.55rem;
                color: var(--muted);
                line-height: 1.6;
            }

            .project-tags,
            .project-links,
            .project-highlights {
                display: flex;
                flex-wrap: wrap;
                gap: 0.55rem;
                margin-top: 0.9rem;
            }

            .project-tag,
            .project-link {
                display: inline-flex;
                align-items: center;
                padding: 0.4rem 0.7rem;
                border-radius: 999px;
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.55);
                font-size: 0.9rem;
                line-height: 1.2;
            }

            .project-link {
                font-weight: 700;
                color: var(--accent);
            }

            .project-highlights {
                display: grid;
                gap: 0.5rem;
            }

            .project-highlights div {
                font-weight: 700;
                color: var(--text);
            }

        .empty-state {
            margin-top: 1rem;
            padding: 1rem 1.1rem;
            border: 1px dashed rgba(198, 107, 61, 0.35);
            border-radius: 20px;
            color: var(--muted);
            background: rgba(255, 255, 255, 0.28);
        }

        .contact-list div {
            padding: 0.9rem 1rem;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.4);
            border: 1px solid var(--line);
            color: var(--muted);
        }

        footer {
            padding: 1.5rem 0 0;
            text-align: center;
            color: var(--muted);
            font-size: 0.95rem;
        }

        @media (max-width: 900px) {

            .hero,
            .content-grid {
                grid-template-columns: 1fr;
            }

                .skill-groups {
                    grid-template-columns: 1fr;
                }

                .project-list {
                    grid-template-columns: 1fr;
                }

                .span-7,
                .span-5,
                .span-6,
            .span-12 {
                grid-column: auto;
            }
        }

        @media (max-width: 640px) {
            .page-shell {
                width: min(100% - 1rem, 1120px);
                padding-top: 1rem;
            }

            .topbar {
                top: 0.5rem;
                margin-bottom: 1rem;
            }

            .topbar nav {
                border-radius: 24px;
            }

            .hero,
            .section-card {
                padding: 1.2rem;
                border-radius: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="page-shell">
        <header class="topbar">
            <nav aria-label="Section navigation">
                <a href="#about">About Me</a>
                <a href="#projects">Featured Projects</a>
                <a href="#skills">Skills</a>
                <a href="#education">Education</a>
                <a href="#experience">Experience</a>
                <a href="#github">GitHub</a>
                <a href="#linkedin">LinkedIn</a>
                <a href="#contact">Contact</a>
            </nav>
        </header>

        <main>
            <section class="hero" id="home">
                <div>
                    <div class="eyebrow">Portfolio </div>
                    <h1>Mashrure Tanzim</h1>
                    <p>
                        This homepage is ready for your portfolio content. Replace this intro text, add your
                        project details, and update each section below when you are ready.
                    </p>
                </div>

                <div class="hero-panel">
                    <div class="placeholder-box">
                        <img
                            class="hero-image"
                            src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(resource_path('views/1738556345484.jpeg'))) }}"
                            alt="Profile picture of Mashrure Tanzim">

                        <div class="hero-facts">
                            <span class="hero-fact">Marital Status: Unmarried</span>
                            <span class="hero-fact">Gender: Male</span>
                            <span class="hero-fact">Religion: Islam</span>
                            <span class="hero-fact">Nationality: Bangladeshi</span>
                            <span class="hero-fact">Date of Birth: 25-03-1997</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content-grid">
                <article class="section-card span-7" id="about">
                    <h2>About Me</h2>
                    <p>I have been working for 6 years as a full stack developer. During my tenure I
                        worked with php (cakephp and laravel), html, css, javascript (both raw and
                        vue.js), React with Polaris for Shopify, MYSQL and some rudimentary wordpress.
                        I led a team as a focal point to complete given projects. I have worked on more
                        than 15 projects related to the a2i initiative of the ministry.</p>
                </article>

                <article class="section-card span-5" id="projects">
                    <h2>Featured Projects</h2>

                    @if ($projects->isEmpty())
                    <div class="empty-state">
                        No featured projects added yet. Add rows in <code>projects</code> and mark them as featured to
                        show them here.
                    </div>
                    @else
                    <div class="project-list">
                        @foreach ($projects as $project)
                        <div class="project-item">
                            <h3>{{ $project->title }}</h3>

                            @if ($project->short_description)
                            <p>{{ $project->short_description }}</p>
                            @elseif ($project->description)
                            <p>{{ \Illuminate\Support\Str::limit($project->description, 180) }}</p>
                            @endif

                            @if ($project->started_at || $project->completed_at)
                            <div class="project-meta">
                                {{ $project->started_at?->format('M Y') ?? 'Start not added' }}
                                -
                                {{ $project->completed_at?->format('M Y') ?? 'Present' }}
                            </div>
                            @endif

                            @if ($project->technologies->isNotEmpty())
                            <div class="project-tags">
                                @foreach ($project->technologies as $technology)
                                <span class="project-tag">{{ $technology->name }}</span>
                                @endforeach
                            </div>
                            @elseif (! empty($project->tech_stack))
                            <div class="project-tags">
                                @foreach ($project->tech_stack as $tech)
                                <span class="project-tag">{{ $tech }}</span>
                                @endforeach
                            </div>
                            @endif

                            @if ($project->highlights->isNotEmpty())
                            <div class="project-highlights">
                                @foreach ($project->highlights as $highlight)
                                <div>{{ $highlight->highlight }}</div>
                                @endforeach
                            </div>
                            @endif

                            @if ($project->github_url || $project->demo_url)
                            <div class="project-links">
                                @if ($project->github_url)
                                <a class="project-link" href="{{ $project->github_url }}" target="_blank" rel="noreferrer">GitHub</a>
                                @endif
                                @if ($project->demo_url)
                                <a class="project-link" href="{{ $project->demo_url }}" target="_blank" rel="noreferrer">Live Demo</a>
                                @endif
                            </div>
                            @endif

                            @if ($project->images->isNotEmpty())
                            <div class="project-meta">
                                {{ $project->images->count() }} project image{{ $project->images->count() > 1 ? 's' : '' }} attached
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </article>

                <article class="section-card span-12" id="skills">
                    <h2>Skills</h2>
                    <!-- <p>Your skills now load from the database.</p> -->

                    @if ($skills->isEmpty())
                    <div class="empty-state">
                        No skills added yet. Insert rows into the <code>skills</code> table to show them here.
                    </div>
                    @else
                    <div class="skill-groups">
                        @foreach ($skills->groupBy(fn ($skill) => $skill->category ?: 'Uncategorized') as $category => $groupedSkills)
                        <div class="skill-group">
                            <h3>{{ $category }}</h3>

                            @foreach ($groupedSkills as $skill)
                            <div class="skill-item">
                                <div>
                                    <strong>{{ $skill->name }}</strong>
                                </div>

                                @if (! is_null($skill->proficiency))
                                <div class="skill-score">
                                    Proficiency: {{ $skill->proficiency }}
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    @endif
                </article>

                <article class="section-card span-6" id="education">
                    <h2>Education</h2>

                    @if ($educations->isEmpty())
                    <div class="empty-state">
                        No education entries added yet. Insert rows into the <code>educations</code> table to
                        show them here.
                    </div>
                    @else
                    <div class="education-list">
                        @foreach ($educations as $education)
                        <div class="education-item">
                            <h3>{{ $education->institution }}</h3>
                            <div class="education-degree">{{ $education->degree_type }}</div>
                            <div class="education-meta">
                                Degree obtained: {{ $education->degree_obtained ?: 'Not added' }}
                            </div>
                            <p>{{ $education->subject }}</p>

                            @if (! is_null($education->cgpa))
                            <div class="education-meta">
                                CGPA: {{ number_format((float) $education->cgpa, 2) }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </article>

                <article class="section-card span-6" id="experience">
                    <h2>Experience</h2>
                    <!-- <p>Your experience entries now load from the database.</p> -->

                    @if ($experiences->isEmpty())
                    <div class="empty-state">
                        No experience entries added yet. Insert rows into the <code>experiences</code> table to
                        show them here.
                    </div>
                    @else
                    <div class="experience-list">
                        @foreach ($experiences as $experience)
                        <div class="experience-item">
                            <h3>{{ $experience->position }} at {{ $experience->company_name }}</h3>
                            <div class="experience-meta">{{ $experience->location ?: 'Location not added' }}</div>
                            <div class="experience-meta">
                                {{ $experience->start_date?->format('M Y') ?? 'Start date not added' }}
                                -
                                {{ $experience->end_date?->format('M Y') ?? 'Present' }}
                            </div>

                            @if ($experience->description)
                            <p>{{ $experience->description }}</p>
                            @endif

                            @if ($experience->reference)
                            <div class="experience-reference">
                                {{ $experience->reference }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </article>

                <article class="section-card span-6" id="github">
                    <h2>GitHub</h2>
                    <div class="link-grid">
                        <a href="https://github.com/navintanzim" target="_blank" rel="noreferrer" aria-label="Open GitHub profile">
                            <strong>View GitHub Profile</strong>
                            <span>i am a web developer working with mainly php (cakephp and laravel). I also work in JavaScript (Jquery, Vue, React), JAVA, SQL, HTML plus shopify polaris</span>
                            <!-- <div class="link-cta">Open GitHub -></div> -->
                        </a>
                    </div>
                </article>

                <article class="section-card span-6" id="linkedin">
                    <h2>LinkedIn</h2>
                    <div class="link-grid">
                        <a href="https://www.linkedin.com/in/mashrure-tanzim-24b77a168" target="_blank" aria-label="Open LinkedIn profile">
                            <strong>View LinkedIn Profile</strong>
                            <span>I started my career as a junior IT officer in Notre Dame University Bangladesh. My responsibilities included maintaining software for admission and inventory management. It also included managing the 3 computer labs. It taught me minor repair works for computers and power supply devices.

                                My next job was as a web developer for Business Automation Ltd. I worked for 5 years as a full stack developer. During my tenure I worked with php (cakephp and laravel), html, css, javascript (both raw and vue.js), mysql and some rudimentary wordpress. I led a team as a focal point to complete given projects. I have worked in more than 15 projects related to the a2i initiative of the ministry.

                                Currently I am working at Klinkode as a Software Engineer. My work generally involves Laravel and React.

                                If you wish to contact me, you can find me at tanzimndub@gmail.com</span>
                            <!-- <div class="link-cta">Open LinkedIn -></div> -->
                        </a>
                    </div>
                </article>

                <article class="section-card span-12" id="contact">
                    <h2>Contact</h2>

                    <div class="contact-list">
                        <div>tanzimndub@gmail.com</div>
                        <div>01987168379</div>
                        <div> MIRBAGH MORE,MODHUBAGH, DHAKA</div>
                    </div>
                </article>
            </section>
        </main>

        <footer>
            Portfolio scaffold ready for content.
        </footer>
    </div>
</body>

</html>
