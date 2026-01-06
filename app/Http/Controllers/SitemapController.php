<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ForumTopic;

class SitemapController extends Controller
{
    public function index()
    {
        $now = now()->toAtomString();

        // Start XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static pages with high priority
        $staticPages = [
            ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('products.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => route('pricing'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('support.index'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('support.documentation'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => route('support.contact'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => route('support.forum'), 'priority' => '0.7', 'changefreq' => 'daily'],
        ];

        foreach ($staticPages as $page) {
            $xml .= $this->generateUrlEntry($page['url'], $now, $page['changefreq'], $page['priority']);
        }

        // Product pages (only active products)
        $products = Product::where('is_active', true)->get();
        foreach ($products as $product) {
            $url = route('products.show', $product->slug);
            $xml .= $this->generateUrlEntry($url, $now, 'weekly', '0.8');
        }

        // Forum topics (public topics)
        $forumTopics = ForumTopic::where('is_locked', false)->get();
        foreach ($forumTopics as $topic) {
            $url = route('support.forum.show', $topic->slug);
            $xml .= $this->generateUrlEntry($url, $now, 'weekly', '0.6');
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function generateUrlEntry($url, $lastmod, $changefreq, $priority)
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n" .
               "    <lastmod>" . $lastmod . "</lastmod>\n" .
               "    <changefreq>" . $changefreq . "</changefreq>\n" .
               "    <priority>" . $priority . "</priority>\n" .
               "  </url>\n";
    }
}

