<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ironspan Commercial Coatings') — Commercial & Industrial Painting</title>
    <meta name="description" content="@yield('meta', 'Ironspan Commercial Coatings — Houston-based commercial and industrial painting for warehouses, plants, and high-rise facades.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0A1628;
            --ink-soft: #1B2A41;
            --teal: #0D9488;
            --teal-deep: #0F766E;
            --amber: #F59E0B;
            --mist: #E8EEF2;
            --steel: #64748B;
            --white: #FFFFFF;
            --font-display: 'Barlow Condensed', sans-serif;
            --font-body: 'Figtree', sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: var(--font-body);
            color: var(--ink);
            background: var(--mist);
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin-inline: auto; }
        .nav {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(12px);
            background: rgba(10, 22, 40, 0.92);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .nav-inner { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.9rem 0; }
        .brand { font-family: var(--font-display); font-size: 1.55rem; letter-spacing: 0.04em; color: #fff; text-transform: uppercase; }
        .brand span { color: var(--amber); }
        .nav-links { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; }
        .nav-links a { color: rgba(255,255,255,0.82); font-size: 0.92rem; font-weight: 500; }
        .nav-links a:hover { color: #fff; }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.85rem 1.35rem; border-radius: 4px; font-weight: 600;
            border: none; cursor: pointer; transition: transform .2s ease, background .2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-amber { background: var(--amber); color: var(--ink); }
        .btn-teal { background: var(--teal); color: #fff; }
        .btn-ghost { background: transparent; color: #fff; border: 1px solid rgba(255,255,255,0.35); }
        .hero {
            min-height: 92vh;
            display: grid; align-items: end;
            background:
                linear-gradient(115deg, rgba(10,22,40,0.88) 0%, rgba(10,22,40,0.45) 48%, rgba(13,148,136,0.28) 100%),
                url('https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&w=2000&q=80') center/cover no-repeat;
            color: #fff;
            padding: 6rem 0 4rem;
        }
        .hero h1 {
            font-family: var(--font-display);
            font-size: clamp(2.8rem, 8vw, 5.2rem);
            line-height: 0.95; letter-spacing: 0.02em; text-transform: uppercase;
            margin: 0 0 1rem; max-width: 14ch;
        }
        .hero p { max-width: 36rem; font-size: 1.1rem; color: rgba(255,255,255,0.88); margin: 0 0 1.6rem; }
        .cta-row { display: flex; flex-wrap: wrap; gap: 0.75rem; }
        section { padding: 4.5rem 0; }
        .section-kicker { color: var(--teal-deep); font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.5rem; }
        .section-title { font-family: var(--font-display); font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase; letter-spacing: 0.02em; margin: 0 0 0.75rem; line-height: 1; }
        .section-lead { color: var(--steel); max-width: 38rem; margin: 0 0 2rem; }
        .grid-3 { display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        .tile {
            background: #fff; border-radius: 8px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(10,22,40,0.06);
            transition: transform .25s ease;
        }
        .tile:hover { transform: translateY(-4px); }
        .tile img { height: 180px; width: 100%; object-fit: cover; }
        .tile-body { padding: 1.2rem 1.25rem 1.4rem; }
        .tile h3 { margin: 0 0 0.4rem; font-family: var(--font-display); font-size: 1.45rem; text-transform: uppercase; letter-spacing: 0.02em; }
        .tile p { margin: 0; color: var(--steel); font-size: 0.95rem; }
        .split { display: grid; gap: 2rem; grid-template-columns: 1.1fr 0.9fr; align-items: center; }
        .split img { border-radius: 10px; min-height: 360px; object-fit: cover; width: 100%; }
        .dash-preview {
            background: linear-gradient(160deg, var(--ink) 0%, #123047 55%, var(--teal-deep) 100%);
            color: #fff; border-radius: 12px; padding: 1.5rem; display: grid; gap: 1rem;
        }
        .dash-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
        .dash-stat { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 1rem; }
        .dash-stat strong { display: block; font-family: var(--font-display); font-size: 1.8rem; }
        .dash-stat span { font-size: 0.82rem; opacity: 0.8; }
        .form { display: grid; gap: 0.9rem; background: #fff; padding: 1.5rem; border-radius: 10px; }
        .form input, .form textarea, .form select {
            width: 100%; padding: 0.85rem 0.95rem; border: 1px solid #CBD5E1; border-radius: 6px;
            font: inherit; background: #fff;
        }
        .form label { font-size: 0.85rem; font-weight: 600; color: var(--ink-soft); }
        .alert { padding: 0.9rem 1rem; border-radius: 6px; background: #CCFBF1; color: #115E59; margin-bottom: 1rem; }
        .prose { max-width: 720px; }
        .prose h2 { font-family: var(--font-display); text-transform: uppercase; }
        .footer { background: var(--ink); color: rgba(255,255,255,0.78); padding: 3rem 0 2rem; margin-top: 2rem; }
        .footer strong { color: #fff; font-family: var(--font-display); font-size: 1.3rem; letter-spacing: 0.04em; text-transform: uppercase; }
        .wa {
            position: fixed; right: 1.1rem; bottom: 1.1rem; z-index: 50;
            background: #25D366; color: #fff; width: 56px; height: 56px; border-radius: 50%;
            display: grid; place-items: center; font-weight: 700; box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        }
        .chat-widget {
            position: fixed; right: 1.1rem; bottom: 5rem; z-index: 50; width: min(340px, calc(100vw - 2rem));
            background: #fff; border-radius: 12px; box-shadow: 0 18px 40px rgba(10,22,40,0.25); overflow: hidden;
            display: none; flex-direction: column; max-height: 420px;
        }
        .chat-widget.open { display: flex; }
        .chat-head { background: var(--ink); color: #fff; padding: 0.85rem 1rem; font-weight: 600; display: flex; justify-content: space-between; }
        .chat-body { padding: 0.85rem; overflow-y: auto; flex: 1; background: #F8FAFC; font-size: 0.9rem; }
        .chat-msg { margin-bottom: 0.6rem; padding: 0.55rem 0.7rem; border-radius: 8px; max-width: 90%; }
        .chat-msg.bot { background: #fff; border: 1px solid #E2E8F0; }
        .chat-msg.user { background: #CCFBF1; margin-left: auto; }
        .chat-form { display: flex; gap: 0.4rem; padding: 0.65rem; border-top: 1px solid #E2E8F0; }
        .chat-form input { flex: 1; border: 1px solid #CBD5E1; border-radius: 6px; padding: 0.55rem 0.7rem; font: inherit; }
        .chat-toggle {
            position: fixed; right: 4.6rem; bottom: 1.2rem; z-index: 50;
            background: var(--teal); color: #fff; border: none; border-radius: 999px;
            padding: 0.75rem 1rem; font-weight: 600; cursor: pointer; box-shadow: 0 10px 25px rgba(13,148,136,0.35);
        }
        .page-hero {
            background: linear-gradient(120deg, var(--ink), var(--ink-soft));
            color: #fff; padding: 4rem 0 2.5rem;
        }
        .page-hero h1 { font-family: var(--font-display); font-size: clamp(2.2rem, 5vw, 3.4rem); text-transform: uppercase; margin: 0; }
        @media (max-width: 800px) {
            .split { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .hero { min-height: 78vh; align-items: center; }
        }
        @keyframes rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        .rise { animation: rise .7s ease both; }
        .rise-delay { animation-delay: .15s; }
        .rise-delay-2 { animation-delay: .3s; }
    </style>
    @stack('head')
</head>
<body>
<header class="nav">
    <div class="wrap nav-inner">
        <a class="brand" href="{{ url('/') }}">Ironspan <span>Coatings</span></a>
        <nav class="nav-links">
            <a href="{{ url('/services') }}">Services</a>
            <a href="{{ url('/about') }}">About</a>
            <a href="{{ url('/blog') }}">Insights</a>
            <a href="{{ url('/knowledge') }}">Knowledge</a>
            <a href="{{ url('/contact') }}">Contact</a>
            <a class="btn btn-amber" href="{{ url('/contact') }}" style="padding:0.55rem 0.9rem;">Get Estimate</a>
        </nav>
    </div>
</header>

@yield('content')

<footer class="footer">
    <div class="wrap" style="display:grid;gap:1rem;">
        <strong>Ironspan Commercial Coatings</strong>
        <div>4200 Navigation Blvd, Houston, TX 77003 · (713) 555-0148 · hello@ironspan.coatings</div>
        <div style="opacity:.7;font-size:.9rem;">Commercial & industrial painting for warehouses, plants, towers, and structural steel.</div>
    </div>
</footer>

<a class="wa" href="https://wa.me/17135550148" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>
<button class="chat-toggle" type="button" id="chatToggle">Ask Ironspan AI</button>
<div class="chat-widget" id="chatWidget">
    <div class="chat-head"><span>Ironspan AI Assistant</span><button type="button" id="chatClose" style="background:none;border:none;color:#fff;cursor:pointer;">✕</button></div>
    <div class="chat-body" id="chatBody">
        <div class="chat-msg bot">Hi — ask about warehouse coatings, plant exteriors, estimates, or scheduling.</div>
    </div>
    <form class="chat-form" id="chatForm">
        <input type="text" id="chatInput" placeholder="Type your question..." required maxlength="2000">
        <button class="btn btn-teal" type="submit" style="padding:0.55rem 0.8rem;">Send</button>
    </form>
</div>
<script>
(() => {
    const widget = document.getElementById('chatWidget');
    const body = document.getElementById('chatBody');
    document.getElementById('chatToggle').onclick = () => widget.classList.add('open');
    document.getElementById('chatClose').onclick = () => widget.classList.remove('open');
    document.getElementById('chatForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const input = document.getElementById('chatInput');
        const message = input.value.trim();
        if (!message) return;
        body.insertAdjacentHTML('beforeend', `<div class="chat-msg user"></div>`);
        body.lastElementChild.textContent = message;
        input.value = '';
        body.scrollTop = body.scrollHeight;
        try {
            const res = await fetch('{{ url('/api/chat') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message })
            });
            const data = await res.json();
            body.insertAdjacentHTML('beforeend', `<div class="chat-msg bot"></div>`);
            body.lastElementChild.textContent = data.reply || 'Unable to respond right now.';
        } catch (err) {
            body.insertAdjacentHTML('beforeend', `<div class="chat-msg bot">Connection issue — please call (713) 555-0148.</div>`);
        }
        body.scrollTop = body.scrollHeight;
    });
})();
</script>
</body>
</html>
