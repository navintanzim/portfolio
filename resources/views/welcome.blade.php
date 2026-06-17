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

            .contact-list {
                display: grid;
                gap: 0.75rem;
                margin-top: 1rem;
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
                    <a href="#experience">Experience</a>
                    <a href="#github">GitHub</a>
                    <a href="#linkedin">LinkedIn</a>
                    <a href="#contact">Contact</a>
                </nav>
            </header>

            <main>
                <section class="hero" id="home">
                    <div>
                        <div class="eyebrow">Portfolio Scaffold</div>
                        <h1>Your Name Here</h1>
                        <p>
                            This homepage is ready for your portfolio content. Replace this intro text, add your
                            project details, and update each section below when you are ready.
                        </p>
                    </div>

                    <div class="hero-panel">
                        <div class="placeholder-box">
                            <strong>Hero Placeholder</strong>
                            <span>Add a short summary, portrait, tagline, or call-to-action here later.</span>
                        </div>
                    </div>
                </section>

                <section class="content-grid">
                    <article class="section-card span-7" id="about">
                        <h2>About Me</h2>
                        <p>Write your personal introduction, background, interests, and what kind of work you do.</p>
                    </article>

                    <article class="section-card span-5" id="projects">
                        <h2>Featured Projects</h2>
                        <p>List your standout projects here with titles, summaries, stack details, and links.</p>
                    </article>

                    <article class="section-card span-5" id="skills">
                        <h2>Skills</h2>
                        <p>Add your technical skills, tools, frameworks, and strengths in this section.</p>
                    </article>

                    <article class="section-card span-7" id="experience">
                        <h2>Experience</h2>
                        <p>Use this area for roles, internships, freelance work, or your learning journey timeline.</p>
                    </article>

                    <article class="section-card span-6" id="github">
                        <h2>GitHub</h2>
                        <div class="link-grid">
                            <a href="#" aria-label="GitHub placeholder link">
                                <strong>GitHub Profile</strong>
                                <span>Replace this placeholder with your GitHub URL and a short description.</span>
                            </a>
                        </div>
                    </article>

                    <article class="section-card span-6" id="linkedin">
                        <h2>LinkedIn</h2>
                        <div class="link-grid">
                            <a href="#" aria-label="LinkedIn placeholder link">
                                <strong>LinkedIn Profile</strong>
                                <span>Replace this placeholder with your LinkedIn URL and headline later.</span>
                            </a>
                        </div>
                    </article>

                    <article class="section-card span-12" id="contact">
                        <h2>Contact</h2>
                        <p>Add your preferred contact details, availability, and any message or form here.</p>
                        <div class="contact-list">
                            <div>Email placeholder</div>
                            <div>Phone placeholder</div>
                            <div>Location placeholder</div>
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
