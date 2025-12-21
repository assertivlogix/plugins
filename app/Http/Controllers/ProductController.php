<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();
        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        \Log::info("ProductController show hit with slug: " . $slug);
        $plugin = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $data = $this->getPluginData($plugin); // Returns ['plugin' => [...]]
        $viewData = $data['plugin']; // Unwrap the inner array to assume top-level variables
        $viewData['plugin'] = $data['plugin']; // Keep 'plugin' key available for array access in view
        $viewData['product'] = $plugin;
        
        $slug = trim($slug);
        \Log::info("Trimmed slug: '" . $slug . "'");
        
        // Special case for Central Pro Detailed Feature List
        if ($slug === 'moon-central-pro' || $slug === 'assertivlogix-central-pro') {
            \Log::info("Serving central-pro view");
            return view('plugins.central-pro', $viewData);
        }

        // Special case for 2FA Authentication Detailed Feature List
        if ($slug === 'assertiv-logix-2fa-authentication') {
            \Log::info("Serving 2fa-authentication view");
            return view('plugins.2fa-authentication', $viewData);
        }

        // Special case for Backup Pro Detailed Feature List
        if ($slug === 'assertivlogix-backup-pro' || $slug === 'moon-backup-pro') {
            \Log::info("Serving backup-pro view");
            return view('plugins.backup-pro', $viewData);
        }

        // If it's one of the legacy specific views, we could use them, but the user requested "each and every plugin have own details page".
        // Using the generic template ensures consistency for all plugins.
        return view('plugins.plugin-template', $viewData);
    }

    private function getPluginData($plugin)
    {
        $category = $plugin->category; // Accessor we added
        
        // Default color scheme based on category
        $colors = [
            'security' => ['#8b5cf6', '#7c3aed', '#6d28d9', '#8b5cf6', '#7c3aed', '#10b981', '#059669'],
            'seo' => ['#10b981', '#059669', '#047857', '#10b981', '#059669', '#3b82f6', '#2563eb'],
            'backup' => ['#f59e0b', '#d97706', '#b45309', '#f59e0b', '#d97706', '#ef4444', '#dc2626'],
            'performance' => ['#ef4444', '#dc2626', '#b91c1c', '#ef4444', '#dc2626', '#8b5cf6', '#7c3aed'],
            'analytics' => ['#3b82f6', '#2563eb', '#1d4ed8', '#3b82f6', '#2563eb', '#10b981', '#059669'],
            'management' => ['#8b5cf6', '#7c3aed', '#6d28d9', '#8b5cf6', '#7c3aed', '#f59e0b', '#d97706'],
            'other' => ['#6b7280', '#4b5563', '#374151', '#6b7280', '#4b5563', '#3b82f6', '#2563eb']
        ];
        
        $c = $colors[$category] ?? $colors['other'];

        $pluginData = [
            'name' => str_replace('Moon', 'Assertivlogix', $plugin->name),
            'slug' => $plugin->slug,
            'tagline' => str_replace('Moon', 'Assertivlogix', $plugin->short_description),
            'description' => $plugin->description,
            'price_monthly' => $plugin->price_monthly,
            'price_yearly' => $plugin->price_yearly,
            'banner_image' => $plugin->banner_image ?? 'https://via.placeholder.com/800x600',
            'icon_image' => $plugin->icon_image,
            'version' => $plugin->version,
            'tested_up_to' => $plugin->tested_up_to,
            'requires_php' => $plugin->requires_php,
            'requires_wordpress' => $plugin->requires_wordpress,
            'file_path' => $plugin->file_path,
            
            // Defaults that can be overridden by switch
            'icon' => $plugin->icon_image ?? 'fas fa-cube',
            'category' => $category,
            'plugin_category' => ucfirst($category),
            'cta_action' => 'Get Started',
            
            'hero_color' => $c[0],
            'hero_color_dark' => $c[1],
            'hero_color_darker' => $c[2],
            'feature_color' => $c[3],
            'feature_color_dark' => $c[4],
            'benefit_color' => $c[5],
            'benefit_color_dark' => $c[6],
            
            'features' => [
                 'Easy to install and configure',
                 'Regular updates and improvements',
                 'Premium customer support',
                 'Compatible with latest WordPress',
                 'Lightweight and fast',
                 'User-friendly interface'
            ],
            'benefits' => [
                'Save time and effort',
                'Improve your website',
                'Professional results',
                'Reliable performance'
            ],
            'screenshots' => [
                'Main Interface' => 'The main dashboard of ' . $plugin->name,
                'Settings' => 'Easy to use configuration settings'
            ],
            'testimonials' => [
                 [
                     'name' => 'Happy Customer',
                     'role' => 'WordPress User',
                     'content' => 'This plugin has been a great addition to my website. Highly recommended!',
                     'rating' => 5
                 ]
            ]
        ];

        // Add plugin-specific data overrides
        switch ($plugin->slug) {
            case 'moon-security-pro':
            case 'assertivlogix-security-pro':
                $pluginData['icon'] = 'fas fa-shield-alt';
                $pluginData['cta_action'] = 'Secure Your Website';
                $pluginData['features'] = [
                    'Advanced Web Application Firewall (WAF)',
                    'Real-time malware scanning and removal',
                    'Brute force attack protection',
                    'File integrity monitoring',
                    'Security audit logging',
                    'Two-factor authentication support',
                    'IP blacklist and whitelist',
                    'Comment spam protection',
                    'Login attempt monitoring',
                    'Database security scanner'
                ];
                $pluginData['benefits'] = [
                    'Protect against 99% of known threats',
                    'Automatic security updates',
                    '24/7 security monitoring',
                    'Detailed security reports',
                    'Easy-to-use dashboard',
                    'GDPR compliant'
                ];
                $pluginData['screenshots'] = [
                    'dashboard' => 'Security Dashboard showing threat levels and protection status',
                    'firewall' => 'Firewall rules configuration interface',
                    'scanning' => 'Malware scanning results and cleanup tools',
                    'logs' => 'Security logs and audit trail'
                ];
                $pluginData['testimonials'] = [
                    [
                        'name' => 'Sarah Johnson',
                        'role' => 'Website Owner',
                        'content' => 'Assertivlogix Security Pro saved my website from multiple hacking attempts. The real-time protection is invaluable.',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Mike Chen',
                        'role' => 'Developer',
                        'content' => 'The firewall features are incredibly powerful yet easy to configure. Best security plugin I\'ve used.',
                        'rating' => 5
                    ]
                ];
                break;

            case 'moon-seo-pro':
            case 'assertivlogix-seo-pro':
                $pluginData['icon'] = 'fas fa-search';
                $pluginData['cta_action'] = 'Boost Your SEO';
                $pluginData['features'] = [
                    'Advanced keyword research tool',
                    'On-page SEO optimization',
                    'XML sitemap generation',
                    'Google Schema markup',
                    'Social media integration',
                    'Content analysis and suggestions',
                    'Image optimization',
                    'Local SEO tools',
                    'SEO-friendly URLs',
                    'Google Analytics integration'
                ];
                $pluginData['benefits'] = [
                    'Improve search rankings by 40%',
                    'Increase organic traffic',
                    'Better user experience',
                    'Mobile-first optimization',
                    'Voice search ready',
                    'Regular SEO audits'
                ];
                $pluginData['screenshots'] = [
                    'dashboard' => 'SEO Dashboard showing site health and optimization scores',
                    'keywords' => 'Keyword research and analysis tools',
                    'content' => 'Content optimization suggestions',
                    'analytics' => 'SEO performance metrics and reports'
                ];
                $pluginData['testimonials'] = [
                    [
                        'name' => 'Emily Rodriguez',
                        'role' => 'Marketing Manager',
                        'content' => 'Our search rankings improved dramatically after using Assertivlogix SEO Pro. The keyword analysis is spot-on.',
                        'rating' => 5
                    ],
                    [
                        'name' => 'David Kim',
                        'role' => 'Content Creator',
                        'content' => 'The content optimization suggestions helped us create better, more SEO-friendly articles.',
                        'rating' => 5
                    ]
                ];
                break;

            case 'moon-backup-pro':
            case 'assertivlogix-backup-pro':
                $pluginData['icon'] = 'fas fa-cloud-upload-alt';
                $pluginData['cta_action'] = 'Secure Your Data';
                $pluginData['features'] = [
                    'Automated daily backups',
                    'Multiple cloud storage options',
                    'One-click restore functionality',
                    'Incremental backup technology',
                    'Database and file backups',
                    'Backup scheduling options',
                    'Backup encryption and security',
                    'Backup health monitoring',
                    'Export and migration tools',
                    'Staging environment support'
                ];
                $pluginData['benefits'] = [
                    'Peace of mind with automatic backups',
                    'Quick recovery from disasters',
                    'Secure cloud storage',
                    'No data loss guarantee',
                    'Easy site migration',
                    'Version control for backups'
                ];
                $pluginData['screenshots'] = [
                    'dashboard' => 'Backup Dashboard showing schedule and status',
                    'restore' => 'One-click restore interface',
                    'schedule' => 'Backup scheduling configuration',
                    'storage' => 'Cloud storage management'
                ];
                $pluginData['testimonials'] = [
                    [
                        'name' => 'Lisa Thompson',
                        'role' => 'E-commerce Owner',
                        'content' => 'Assertivlogix Backup Pro saved my business when my site crashed. Restored everything in minutes!',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Robert Wilson',
                        'role' => 'IT Manager',
                        'content' => 'The automated backups are reliable and the restore process is incredibly simple.',
                        'rating' => 5
                    ]
                ];
                break;

            case 'moon-performance-pro':
            case 'assertivlogix-performance-pro':
                $pluginData['icon'] = 'fas fa-rocket';
                $pluginData['cta_action'] = 'Supercharge Your Site';
                $pluginData['features'] = [
                    'Advanced page caching',
                    'Database query optimization',
                    'Image lazy loading and compression',
                    'CSS/JS minification and compression',
                    'CDN integration',
                    'Google Font optimization',
                    'Performance monitoring and reports',
                    'Mobile speed optimization',
                    'Critical CSS generation',
                    'Heartbeat API control'
                ];
                $pluginData['benefits'] = [
                    'Load time improvement by 60%',
                    'Better Core Web Vitals scores',
                    'Higher search rankings',
                    'Improved user experience',
                    'Reduced server load',
                    'Mobile-first performance'
                ];
                $pluginData['screenshots'] = [
                    'dashboard' => 'Performance Dashboard showing speed metrics',
                    'caching' => 'Caching configuration and status',
                    'images' => 'Image optimization tools',
                    'reports' => 'Performance reports and analytics'
                ];
                $pluginData['testimonials'] = [
                    [
                        'name' => 'Jennifer Adams',
                        'role' => 'Site Owner',
                        'content' => 'My site load time went from 4 seconds to under 1 second. Incredible performance boost!',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Tom Martinez',
                        'role' => 'Developer',
                        'content' => 'The caching features are powerful and the performance monitoring is detailed and actionable.',
                        'rating' => 5
                    ]
                ];
                break;

            case 'moon-analytics-pro':
            case 'assertivlogix-analytics-pro':
                $pluginData['icon'] = 'fas fa-chart-bar';
                $pluginData['cta_action'] = 'Gain Insights';
                $pluginData['features'] = [
                    'Privacy-first analytics',
                    'Real-time visitor tracking',
                    'Conversion goal tracking',
                    'Custom event tracking',
                    'Heatmap generation',
                    'A/B testing tools',
                    'Custom dashboards',
                    'Email reports and alerts',
                    ' GDPR compliant tracking',
                    'Google Analytics alternative'
                ];
                $pluginData['benefits'] = [
                    '100% privacy compliant',
                    'No cookie banners needed',
                    'Better data accuracy',
                    'Real-time insights',
                    'Easy-to-understand reports',
                    'No data sampling'
                ];
                $pluginData['screenshots'] = [
                    'dashboard' => 'Analytics Dashboard with key metrics',
                    'visitors' => 'Visitor behavior and flow analysis',
                    'conversions' => 'Conversion tracking and goals',
                    'reports' => 'Custom reports and insights'
                ];
                $pluginData['testimonials'] = [
                    [
                        'name' => 'Amanda Foster',
                        'role' => 'Marketing Director',
                        'content' => 'Finally, an analytics tool that respects privacy while giving us all the data we need.',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Chris Lee',
                        'role' => 'Business Owner',
                        'content' => 'The conversion tracking has helped us optimize our sales funnel significantly.',
                        'rating' => 5
                    ]
                ];
                break;

            case 'moon-central-pro':
            case 'assertivlogix-central-pro':
                $pluginData['icon'] = 'fas fa-users';
                $pluginData['cta_action'] = 'Streamline Management';
                $pluginData['features'] = [
                    'Manage unlimited WordPress sites',
                    'Bulk plugin and theme updates',
                    'Centralized user management',
                    'Cross-site content publishing',
                    'Unified security monitoring',
                    'Performance tracking across sites',
                    'Backup management for all sites',
                    'Staging environment creation',
                    'White-label reporting',
                    'API access for automation'
                ];
                $pluginData['benefits'] = [
                    'Save 80% management time',
                    'Consistent site performance',
                    'Centralized security oversight',
                    'Streamlined workflows',
                    'Better resource utilization',
                    'Professional client reporting'
                ];
                $pluginData['screenshots'] = [
                    'dashboard' => 'Central Dashboard showing all sites',
                    'updates' => 'Bulk updates management',
                    'monitoring' => 'Cross-site monitoring tools',
                    'users' => 'User management across sites'
                ];
                $pluginData['testimonials'] = [
                    [
                        'name' => 'Michael Brown',
                        'role' => 'Agency Owner',
                        'content' => 'Managing 50+ client sites is now effortless. Assertivlogix Central Pro is a game-changer for agencies.',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Nina Patel',
                        'role' => 'Digital Manager',
                        'content' => 'The bulk updates and centralized monitoring save us hours every week.',
                        'rating' => 5
                    ]
                ];
                break;
        }

        return ['plugin' => $pluginData];
    }
    
    public function download($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        if (empty($product->file_path)) {
            return back()->with('error', 'Download file not found.');
        }

        if (!\Storage::disk('public')->exists($product->file_path)) {
            return back()->with('error', 'File not found locally.');
        }

        return \Storage::disk('public')->download($product->file_path);
    }
}
