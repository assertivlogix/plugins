<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plugins = [
            [
                'name' => 'Moon Security Pro',
                'slug' => 'moon-security-pro',
                'short_description' => 'Comprehensive WordPress security solution with firewall, malware scanning, and real-time threat protection.',
                'description' => 'Protect your WordPress website with advanced security features including firewall, malware scanning, and real-time threat protection. Moon Security Pro provides comprehensive security solutions to keep your website safe from hackers, malware, and other online threats.',
                'version' => '2.1.0',
                'tested_up_to' => '6.5',
                'requires_php' => '7.4',
                'requires_wordpress' => '5.0',
                'price_monthly' => 9.99,
                'price_yearly' => 99.99,
                'file_path' => 'downloads/moon-security-pro.zip',
                'banner_image' => 'https://via.placeholder.com/1200x600/8b5cf6/ffffff?text=Moon+Security+Pro',
                'icon_image' => 'https://via.placeholder.com/200x200/8b5cf6/ffffff?text=SECURITY',
                'is_active' => true,
                'changelog' => 'Added new firewall rules, improved malware detection, enhanced performance.',
                'documentation_url' => 'https://docs.moonplugins.com/security',
                'github_url' => 'https://github.com/moonplugins/security-pro',
                'support_url' => 'https://support.moonplugins.com/security',
                'default_activation_limit' => 3,
            ],
            [
                'name' => 'Moon SEO Pro',
                'slug' => 'moon-seo-pro',
                'short_description' => 'Advanced SEO optimization tools including keyword analysis, meta tags, sitemaps, and search engine visibility.',
                'description' => 'Boost your search engine rankings with comprehensive SEO tools including keyword analysis, meta tags, sitemaps, and content optimization. Moon SEO Pro helps you achieve better search rankings and increase organic traffic to your website.',
                'version' => '3.2.0',
                'tested_up_to' => '6.5',
                'requires_php' => '7.4',
                'requires_wordpress' => '5.0',
                'price_monthly' => 7.99,
                'price_yearly' => 79.99,
                'file_path' => 'downloads/moon-seo-pro.zip',
                'banner_image' => 'https://via.placeholder.com/1200x600/10b981/ffffff?text=Moon+SEO+Pro',
                'icon_image' => 'https://via.placeholder.com/200x200/10b981/ffffff?text=SEO',
                'is_active' => true,
                'changelog' => 'Improved keyword research, new schema markup options, enhanced performance.',
                'documentation_url' => 'https://docs.moonplugins.com/seo',
                'github_url' => 'https://github.com/moonplugins/seo-pro',
                'support_url' => 'https://support.moonplugins.com/seo',
                'default_activation_limit' => 1,
            ],
            [
                'name' => 'Moon Backup Pro',
                'slug' => 'moon-backup-pro',
                'short_description' => 'Automated backup solution with cloud storage integration and one-click restore functionality.',
                'description' => 'Never lose your data again with automated backups, cloud storage integration, and one-click restore functionality. Moon Backup Pro ensures your website data is always safe and easily recoverable.',
                'version' => '1.8.0',
                'tested_up_to' => '6.5',
                'requires_php' => '7.4',
                'requires_wordpress' => '5.0',
                'price_monthly' => 12.99,
                'price_yearly' => 129.99,
                'file_path' => 'downloads/moon-backup-pro.zip',
                'banner_image' => 'https://via.placeholder.com/1200x600/f59e0b/ffffff?text=Moon+Backup+Pro',
                'icon_image' => 'https://via.placeholder.com/200x200/f59e0b/ffffff?text=BACKUP',
                'is_active' => true,
                'changelog' => 'Added new cloud providers, improved restore speed, enhanced encryption.',
                'documentation_url' => 'https://docs.moonplugins.com/backup',
                'github_url' => 'https://github.com/moonplugins/backup-pro',
                'support_url' => 'https://support.moonplugins.com/backup',
                'default_activation_limit' => 2,
            ],
            [
                'name' => 'Moon Performance Pro',
                'slug' => 'moon-performance-pro',
                'short_description' => 'Speed optimization with advanced caching, lazy loading, and performance monitoring tools.',
                'description' => 'Supercharge your website speed with advanced caching, lazy loading, image optimization, and performance monitoring tools. Moon Performance Pro helps you achieve lightning-fast load times and better user experience.',
                'version' => '2.5.0',
                'tested_up_to' => '6.5',
                'requires_php' => '7.4',
                'requires_wordpress' => '5.0',
                'price_monthly' => 14.99,
                'price_yearly' => 149.99,
                'file_path' => 'downloads/moon-performance-pro.zip',
                'banner_image' => 'https://via.placeholder.com/1200x600/ef4444/ffffff?text=Moon+Performance+Pro',
                'icon_image' => 'https://via.placeholder.com/200x200/ef4444/ffffff?text=PERFORMANCE',
                'is_active' => true,
                'changelog' => 'New caching algorithms, improved image optimization, better Core Web Vitals.',
                'documentation_url' => 'https://docs.moonplugins.com/performance',
                'github_url' => 'https://github.com/moonplugins/performance-pro',
                'support_url' => 'https://support.moonplugins.com/performance',
                'default_activation_limit' => 1,
            ],
            [
                'name' => 'Moon Analytics Pro',
                'slug' => 'moon-analytics-pro',
                'short_description' => 'Privacy-friendly analytics with detailed insights, visitor tracking, and conversion optimization.',
                'description' => 'Get detailed insights about your visitors with privacy-friendly analytics, conversion tracking, and comprehensive reporting. Moon Analytics Pro respects user privacy while providing valuable data insights.',
                'version' => '1.6.0',
                'tested_up_to' => '6.5',
                'requires_php' => '7.4',
                'requires_wordpress' => '5.0',
                'price_monthly' => 8.99,
                'price_yearly' => 89.99,
                'file_path' => 'downloads/moon-analytics-pro.zip',
                'banner_image' => 'https://via.placeholder.com/1200x600/3b82f6/ffffff?text=Moon+Analytics+Pro',
                'icon_image' => 'https://via.placeholder.com/200x200/3b82f6/ffffff?text=ANALYTICS',
                'is_active' => true,
                'changelog' => 'New heatmap features, improved conversion tracking, better GDPR compliance.',
                'documentation_url' => 'https://docs.moonplugins.com/analytics',
                'github_url' => 'https://github.com/moonplugins/analytics-pro',
                'support_url' => 'https://support.moonplugins.com/analytics',
                'default_activation_limit' => 1,
            ],
            [
                'name' => 'Moon Central Pro',
                'slug' => 'moon-central-pro',
                'short_description' => 'Manage multiple WordPress sites from a single dashboard with bulk updates and monitoring.',
                'description' => 'Manage multiple WordPress sites from a single dashboard with bulk updates, centralized monitoring, and streamlined workflow. Moon Central Pro is perfect for agencies and developers managing multiple websites.',
                'version' => '2.0.0',
                'tested_up_to' => '6.5',
                'requires_php' => '7.4',
                'requires_wordpress' => '5.0',
                'price_monthly' => 19.99,
                'price_yearly' => 199.99,
                'file_path' => 'downloads/moon-central-pro.zip',
                'banner_image' => 'https://via.placeholder.com/1200x600/8b5cf6/ffffff?text=Moon+Central+Pro',
                'icon_image' => 'https://via.placeholder.com/200x200/8b5cf6/ffffff?text=CENTRAL',
                'is_active' => true,
                'changelog' => 'New multi-site dashboard, improved bulk operations, enhanced security.',
                'documentation_url' => 'https://docs.moonplugins.com/central',
                'github_url' => 'https://github.com/moonplugins/central-pro',
                'support_url' => 'https://support.moonplugins.com/central',
                'default_activation_limit' => 5,
            ],
        ];

        foreach ($plugins as $plugin) {
            Product::updateOrCreate(
                ['slug' => $plugin['slug']],
                $plugin
            );
        }
    }
}
