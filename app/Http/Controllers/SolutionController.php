<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function security()
    {
        $solution = [
            'name' => 'Security Solutions',
            'slug' => 'security',
            'tagline' => 'Protect Your WordPress Site from Every Threat',
            'description' => 'Comprehensive security solutions designed to keep your website safe from malware, hackers, and brute force attacks.',
            'hero_color' => '#8b5cf6',
            'hero_color_dark' => '#7c3aed',
            'hero_color_darker' => '#6d28d9',
            'icon' => 'fas fa-shield-alt',
            'features' => [
                'Real-time Malware Scanning',
                'Advanced Firewall Protection',
                'Brute Force Defense',
                'Activity Logging & Auditing',
                'Two-Factor Authentication'
            ],
            'benefits' => [
                'Sleep soundly knowing your site is safe',
                'Prevent costly hacks and downtime',
                'Protect customer data and trust',
                'Meet compliance requirements'
            ],
            'products' => [
                'moon-security-pro'
            ]
        ];
        return view('solutions.show', compact('solution'));
    }

    public function seo()
    {
        $solution = [
            'name' => 'SEO Optimization',
            'slug' => 'seo',
            'tagline' => 'Dominate Search Rankings and Drive Traffic',
            'description' => 'Advanced SEO tools to help you rank higher on Google, attract more visitors, and grow your online presence.',
            'hero_color' => '#10b981',
            'hero_color_dark' => '#059669',
            'hero_color_darker' => '#047857',
            'icon' => 'fas fa-search',
            'features' => [
                'Keyword Optimization',
                'XML Sitemap Generation',
                'Meta Tag Management',
                'Content Analysis',
                'Local SEO Support'
            ],
            'benefits' => [
                'Increase organic traffic by up to 50%',
                'Improve click-through rates',
                'Rank for competitive keywords',
                'Better visibility on search engines'
            ],
            'products' => [
                'moon-seo-pro'
            ]
        ];
        return view('solutions.show', compact('solution'));
    }

    public function backup()
    {
        $solution = [
            'name' => 'Backup & Migration',
            'slug' => 'backup',
            'tagline' => 'Never Lose Your Data Again',
            'description' => 'Reliable backup and migration solutions to ensure your data is always safe and easy to move.',
            'hero_color' => '#f59e0b',
            'hero_color_dark' => '#d97706',
            'hero_color_darker' => '#b45309',
            'icon' => 'fas fa-cloud-upload-alt',
            'features' => [
                'Automated Daily Backups',
                'One-Click Restoration',
                'Cloud Storage Integration',
                'Seamless Site Migration',
                'Real-time Backup Monitoring'
            ],
            'benefits' => [
                'Secure your hard work',
                'Recover from crashes instantly',
                'Move sites with zero stress',
                'Peace of mind guaranteed'
            ],
            'products' => [
                'moon-backup-pro'
            ]
        ];
        return view('solutions.show', compact('solution'));
    }

    public function performance()
    {
        $solution = [
            'name' => 'Performance Optimization',
            'slug' => 'performance',
            'tagline' => 'Lightning Fast Websites, Better User Experience',
            'description' => 'Speed up your WordPress site to improve user experience, SEO rankings, and conversion rates.',
            'hero_color' => '#ef4444',
            'hero_color_dark' => '#dc2626',
            'hero_color_darker' => '#b91c1c',
            'icon' => 'fas fa-rocket',
            'features' => [
                'Advanced Caching',
                'Image Optimization',
                'Database Cleanup',
                'Code Minification',
                'CDN Support'
            ],
            'benefits' => [
                'Load pages in under 1 second',
                'Boost Core Web Vitals scores',
                'Keep visitors engaged',
                'Reduce server load'
            ],
            'products' => [
                'moon-performance-pro'
            ]
        ];
        return view('solutions.show', compact('solution'));
    }
}
