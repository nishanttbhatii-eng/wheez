<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $authorId = User::where('role', 'admin')->value('id');

        Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Whizseed - Business Solutions',
                'content' => "At Whizseed, we're dedicated to fueling your entrepreneurial fire. Our services and expert guidance empower startups and entrepreneurs across India to build, grow, and prosper.",
                'status' => 'published',
                'order' => 0,
                'seo_title' => 'Whizseed, business registration, GST, trademark, compliance',
                'seo_description' => 'Whizseed is your one-stop destination for company registration, GST, trademark, compliance, and business growth services across India.',
                'meta_title' => 'Whizseed - Business Solutions',
                'meta_description' => 'One-stop destination for company registration, GST, trademark, compliance, and business services in India.',
                'og_title' => 'Whizseed - Business Solutions',
                'og_description' => 'Fuel your entrepreneurial journey with Whizseed. Registration, compliance, and growth services for startups across India.',
                'og_image_url' => null,
                'author_id' => $authorId,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'services'],
            [
                'title' => 'Our Services - Whizseed',
                'content' => 'From your first incorporation to your hundredth filing, Whizseed handles the paperwork, deadlines, and regulatory complexity — so you can stay focused on building.',
                'status' => 'published',
                'order' => 1,
                'seo_title' => 'Whizseed services, company registration, GST, trademark, compliance',
                'seo_description' => 'Explore Whizseed services for business registration, tax filing, trademark, legal documentation, and mandatory compliance across India.',
                'meta_title' => 'Our Services - Whizseed',
                'meta_description' => 'Browse Whizseed business, tax, trademark, legal, and compliance services for startups and entrepreneurs in India.',
                'og_title' => 'Our Services - Whizseed',
                'og_description' => 'Company registration, GST, trademark, legal docs, and compliance — all in one place with Whizseed.',
                'og_image_url' => null,
                'author_id' => $authorId,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'about-us'],
            [
                'title' => 'About Us - Whizseed',
                'content' => 'We serve many customers, ranging from small businesses, medium entrepreneurs, to world-renowned companies.',
                'status' => 'published',
                'order' => 2,
                'seo_title' => 'Whizseed about us, legal consulting, business registration India',
                'seo_description' => 'Learn about Whizseed — India’s technology-driven legal services platform connecting entrepreneurs with professionals for registration, compliance, tax, and IP.',
                'meta_title' => 'Legal Consulting Firm | About Us | Whizseed',
                'meta_description' => 'Whizseed is your go-to online hub for legal and business services. Discover our story, platform, and how we help startups across India.',
                'og_title' => 'About Us - Whizseed',
                'og_description' => 'Meet Whizseed — empowering SMEs and entrepreneurs with business registration, compliance, tax, and legal support across India.',
                'og_image_url' => null,
                'author_id' => $authorId,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'contact-us'],
            [
                'title' => 'Contact Us - Whizseed',
                'content' => 'We serve many customers, ranging from small businesses, medium entrepreneurs, to world-renowned companies.',
                'status' => 'published',
                'order' => 3,
                'seo_title' => 'Whizseed contact, business inquiry, legal support India',
                'seo_description' => 'Contact Whizseed for company registration, GST, trademark, and compliance help. Call +91-9625432342 or write to info@whizseed.com.',
                'meta_title' => 'For Any Inquiry Contact Us Here | Whizseed',
                'meta_description' => 'Get in touch with Whizseed — Noida head office, phone, email, and enquiry form for startups and entrepreneurs across India.',
                'og_title' => 'Contact Us - Whizseed',
                'og_description' => 'Reach Whizseed for business registration, compliance, tax, and legal support. We’re ready to help.',
                'og_image_url' => null,
                'author_id' => $authorId,
            ]
        );

        foreach (config('legal_pages') as $legal) {
            Page::updateOrCreate(
                ['slug' => $legal['slug']],
                [
                    'title' => $legal['title'] . ' - Whizseed',
                    'content' => $legal['hero_desc'],
                    'status' => 'published',
                    'order' => $legal['slug'] === 'privacy-policy' ? 4 : 5,
                    'seo_title' => $legal['title'] . ', Whizseed',
                    'seo_description' => $legal['meta_description'],
                    'meta_title' => $legal['meta_title'],
                    'meta_description' => $legal['meta_description'],
                    'og_title' => $legal['title'] . ' - Whizseed',
                    'og_description' => $legal['meta_description'],
                    'og_image_url' => null,
                    'author_id' => $authorId,
                ]
            );
        }
    }
}
