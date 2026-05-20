<?php
if (!defined('ABSPATH')) { exit; }
add_action('wp_head', function(){
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'Dakshin Chakra',
        'url' => home_url('/'),
        'telephone' => '+91 6364659339',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'No. 6, 11th Main Road, Vasanth Nagar',
            'addressLocality' => 'Bangalore',
            'postalCode' => '560001',
            'addressCountry' => 'IN'
        ],
        'areaServed' => 'Bangalore',
        'description' => 'E-waste collection and scrap collection support for homes and businesses in Bangalore.',
        'makesOffer' => [
            ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'E-waste collection']],
            ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'Scrap collection']],
            ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'Residential pickup']],
            ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'Corporate e-waste disposal']],
        ]
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
}, 20);
