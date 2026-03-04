<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark'=> ($appearance ?? 'system') == 'dark'])>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Inline script to detect system dark mode preference and apply it immediately --}}
    <script>
        (function() {
            const appearance = '{{ $appearance ?? "system" }}';
            if (appearance === 'system') {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (prefersDark) document.documentElement.classList.add('dark');
            }
        })();
    </script>

    {{-- Inline style to set the HTML background color based on theme --}}
    <style>
        html {
            background-color: oklch(1 0 0);
        }

        html.dark {
            background-color: oklch(0.145 0 0);
        }
    </style>

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('images/logo.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- SEO & Open Graph / Social Preview --}}
    <meta name="description" content="ইচ্ছেঘুড়ি রংপুরের একটি বিশ্বস্ত বাজেট ট্যুর এজেন্সি। দেশ ও বিদেশ ভ্রমণের সেরা প্যাকেজ, ভিসা প্রসেসিং, এয়ার টিকিট ও হোটেল বুকিং সেবা।">
    <meta name="keywords" content="Budget tour Bangladesh, Rangpur travel agency, tour package Bangladesh, honeymoon package, visa processing Bangladesh, Iccheghuri">
    <meta name="author" content="Iccheghuri Tours">

    {{-- Open Graph --}}
    <meta property="og:title" content="ইচ্ছেঘুড়ি - Budget Friendly Tour Organizer">
    <meta property="og:description" content="স্বল্প বাজেটে সারা বাংলাদেশ ঘুরুন ইচ্ছেঘুড়ির সাথে।">
    <meta property="og:image" content="https://iccheghuritours.com/images/cover.jpg">
    <meta property="og:url" content="https://iccheghuritours.com/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ইচ্ছেঘুড়ি">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ইচ্ছেঘুড়ি - Budget Friendly Tour Organizer">
    <meta name="twitter:description" content="স্বল্প বাজেটে সারা বাংলাদেশ ঘুরুন ইচ্ছেঘুড়ির সাথে।">
    <meta name="twitter:image" content="https://iccheghuritours.com/images/cover.jpg">

    {{-- Vite + Inertia --}}
    @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>