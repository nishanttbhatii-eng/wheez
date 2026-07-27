<?php

return [
    'filters' => [
        ['id' => 'all', 'label' => 'All Services'],
        ['id' => 'startup', 'label' => 'Start-Up'],
        ['id' => 'license', 'label' => 'License'],
        ['id' => 'tax', 'label' => 'Tax'],
        ['id' => 'regulatory', 'label' => 'Regulatory'],
        ['id' => 'environmental', 'label' => 'Environmental'],
    ],

    'recommended' => [
        ['title' => 'NGO Registration', 'tag' => 'Popular'],
        ['title' => 'ISI Mark Certification', 'tag' => 'Trending'],
        ['title' => 'Virtual CFO Services', 'tag' => 'Featured'],
        ['title' => 'Startup India Registration', 'tag' => 'New'],
    ],

    'categories' => [
        [
            'id' => 'startup',
            'title' => 'START A BUSINESS',
            'description' => 'Incorporate and launch your business with the right legal structure.',
            'services' => [
                'Private Limited Company',
                'Limited Liability Partnership',
                'One Person Company',
                'Partnership Firm',
                'Proprietorship Firm',
                'Public Limited Company',
                'Indian Subsidiary Company',
                'Nidhi Company Registration',
                'Startup India Registration',
            ],
        ],
        [
            'id' => 'license',
            'title' => 'TRADEMARK & COPYRIGHT',
            'description' => 'Protect your brand, creative work, and intellectual property.',
            'services' => [
                'Trademark Registration',
                'Trademark Objection',
                'Trademark Assignment',
                'Trademark Renewal',
                'Copyright Registration',
                'Patent Registration',
                'Design Registration',
            ],
        ],
        [
            'id' => 'tax',
            'title' => 'GOVT & TAX REGISTRATION',
            'description' => 'Stay compliant with government registrations and tax obligations.',
            'services' => [
                'GST Registration',
                'TDS Return',
                'Importer Exporter Code',
                'Professional Tax Registration',
                'Shops & Establishments Registration',
                'GST Return Filing',
                'Income Tax Return Filing',
            ],
        ],
        [
            'id' => 'regulatory',
            'title' => 'LEGAL DOCUMENTATION',
            'description' => 'Professional agreements and legal documents for every business stage.',
            'services' => [
                'Non-Disclosure Agreement',
                'Founders Agreement',
                'Term Sheet',
                'Shareholders Agreement',
                'Share Purchase Agreement',
                'Employment Agreement',
                'Service Level Agreement',
            ],
        ],
        [
            'id' => 'environmental',
            'title' => 'MANDATORY COMPLIANCE',
            'description' => 'Ongoing filings, audits, and regulatory compliance made simple.',
            'services' => [
                'Annual Compliance',
                'ROC Filing',
                'Secretarial Audit',
                'FSSAI License',
                'ISO Certification',
                'MSME Registration',
                'Accounting & Bookkeeping',
            ],
        ],
    ],
];
