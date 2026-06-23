<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $project->title }} | {{ config('app.name', 'Portfolio') }}</title>
        <style>
            :root {
                --bg: #f5efe6;
                --surface: rgba(255, 250, 244, 0.82);
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
                width: min(1100px, calc(100% - 2rem));
                margin: 0 auto;
                padding: 2rem 0 4rem;
            }

            .back-link {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                margin-bottom: 1.25rem;
                padding: 0.7rem 1rem;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: rgba(255, 250, 244, 0.72);
                color: var(--accent);
                font-weight: 700;
                box-shadow: var(--shadow);
            }

            .hero,
            .content-card {
                border: 1px solid var(--line);
                border-radius: 28px;
                background: var(--surface);
                backdrop-filter: blur(12px);
                box-shadow: var(--shadow);
            }

            .hero {
                display: grid;
                grid-template-columns: 1.15fr 0.85fr;
                gap: 1.5rem;
                padding: 1.6rem;
                margin-bottom: 1.25rem;
            }

            .eyebrow {
                display: inline-flex;
                margin-bottom: 0.9rem;
                padding: 0.45rem 0.8rem;
                border-radius: 999px;
                background: var(--accent-soft);
                color: var(--accent);
                font-size: 0.88rem;
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
                margin-bottom: 0.8rem;
                font-size: clamp(2.2rem, 5vw, 4.2rem);
                line-height: 0.96;
            }

            .lead {
                color: var(--muted);
                font-size: 1.05rem;
                line-height: 1.75;
            }

            .meta-list,
            .tag-list,
            .link-list {
                display: flex;
                flex-wrap: wrap;
                gap: 0.65rem;
                margin-top: 1rem;
            }

            .meta-pill,
            .tag,
            .action-link {
                display: inline-flex;
                align-items: center;
                padding: 0.45rem 0.75rem;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.48);
                line-height: 1.2;
            }

            .tag {
                gap: 0.45rem;
            }

            .tag img {
                width: 18px;
                height: 18px;
                object-fit: contain;
                flex-shrink: 0;
            }

            .action-link {
                color: var(--accent);
                font-weight: 700;
            }

            .cover-image {
                width: 100%;
                height: 100%;
                min-height: 280px;
                object-fit: cover;
                border-radius: 22px;
                border: 1px solid var(--line);
            }

            .content-grid {
                display: grid;
                grid-template-columns: 1.2fr 0.8fr;
                gap: 1.25rem;
            }

            .content-card {
                padding: 1.4rem;
            }

            .content-card h2 {
                margin-bottom: 0.8rem;
                font-size: 1.55rem;
            }

            .body-copy {
                color: var(--text);
                line-height: 1.85;
                white-space: pre-line;
            }

            .highlight-list {
                display: grid;
                gap: 0.75rem;
                margin-top: 0.9rem;
            }

            .highlight-item,
            .image-card {
                padding: 1rem;
                border: 1px solid var(--line);
                border-radius: 20px;
                background: rgba(255, 255, 255, 0.45);
            }

            .image-grid {
                display: grid;
                gap: 1rem;
                margin-top: 0.9rem;
            }

            .image-card img {
                width: 100%;
                border-radius: 14px;
                border: 1px solid var(--line);
                object-fit: cover;
            }

            .caption {
                margin-top: 0.7rem;
                color: var(--muted);
                line-height: 1.6;
            }

            .empty-note {
                padding: 1rem;
                border: 1px dashed rgba(198, 107, 61, 0.35);
                border-radius: 18px;
                color: var(--muted);
                background: rgba(255, 255, 255, 0.28);
            }

            @media (max-width: 900px) {
                .hero,
                .content-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        @php
            $coverImage = $project->images->first();
        @endphp

        <div class="page-shell">
            <a class="back-link" href="{{ url('/#projects') }}">← Back to Featured Projects</a>

            <section class="hero">
                <div>
                    <div class="eyebrow">Project Case Study</div>
                    <h1>{{ $project->title }}</h1>

                    @if ($project->short_description)
                        <p class="lead">{{ $project->short_description }}</p>
                    @elseif ($project->description)
                        <p class="lead">{{ \Illuminate\Support\Str::limit($project->description, 240) }}</p>
                    @endif

                    <div class="meta-list">
                        @if ($project->started_at || $project->completed_at)
                            <span class="meta-pill">
                                {{ $project->started_at?->format('M Y') ?? 'Start not added' }} -
                                {{ $project->completed_at?->format('M Y') ?? 'Present' }}
                            </span>
                        @endif
                        @if ($project->featured)
                            <span class="meta-pill">Featured Project</span>
                        @endif
                    </div>

                    @if ($project->technologies->isNotEmpty())
                        <div class="tag-list">
                            @foreach ($project->technologies as $technology)
                                <span class="tag">
                                    @if ($technology->icon)
                                        <img src="{{ asset($technology->icon) }}" alt="{{ $technology->name }} icon">
                                    @endif
                                    <span>{{ $technology->name }}</span>
                                </span>
                            @endforeach
                        </div>
                    @elseif (! empty($project->tech_stack))
                        <div class="tag-list">
                            @foreach ($project->tech_stack as $tech)
                                <span class="tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if ($project->github_url || $project->demo_url)
                        <div class="link-list">
                            @if ($project->github_url)
                                <a class="action-link" href="{{ $project->github_url }}" target="_blank" rel="noreferrer">View GitHub</a>
                            @endif
                            @if ($project->demo_url)
                                <a class="action-link" href="{{ $project->demo_url }}" target="_blank" rel="noreferrer">View Live Demo</a>
                            @endif
                        </div>
                    @endif
                </div>

                <div>
                    @if ($coverImage)
                        @php
                            $coverPath = $coverImage->image_path;
                            if (! \Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://'])) {
                                $coverPath = \Illuminate\Support\Str::startsWith($coverPath, 'public/')
                                    ? asset(\Illuminate\Support\Str::after($coverPath, 'public/'))
                                    : asset(ltrim($coverPath, '/'));
                            }
                        @endphp
                        <img class="cover-image" src="{{ $coverPath }}" alt="{{ $coverImage->caption ?: $project->title }}">
                    @else
                        <div class="empty-note">No project cover image added yet.</div>
                    @endif
                </div>
            </section>

            <section class="content-grid">
                <article class="content-card">
                    <h2>Overview</h2>
                    @if ($project->description)
                        <p class="body-copy">{{ $project->description }}</p>
                    @else
                        <div class="empty-note">No full project description added yet.</div>
                    @endif
                </article>

                <aside class="content-card">
                    <h2>Highlights</h2>
                    @if ($project->highlights->isNotEmpty())
                        <div class="highlight-list">
                            @foreach ($project->highlights as $highlight)
                                <div class="highlight-item">{{ $highlight->highlight }}</div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-note">No project highlights added yet.</div>
                    @endif
                </aside>
            </section>

            <section class="content-card" style="margin-top: 1.25rem;">
                <h2>Screenshots</h2>
                @if ($project->images->isNotEmpty())
                    <div class="image-grid">
                        @foreach ($project->images as $image)
                            @php
                                $imagePath = $image->image_path;
                                if (! \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])) {
                                    $imagePath = \Illuminate\Support\Str::startsWith($imagePath, 'public/')
                                        ? asset(\Illuminate\Support\Str::after($imagePath, 'public/'))
                                        : asset(ltrim($imagePath, '/'));
                                }
                            @endphp
                            <div class="image-card">
                                <img src="{{ $imagePath }}" alt="{{ $image->caption ?: $project->title }}">
                                @if ($image->caption)
                                    <p class="caption">{{ $image->caption }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-note">No screenshots added yet.</div>
                @endif
            </section>
        </div>
    </body>
</html>
