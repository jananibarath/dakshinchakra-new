<?php
if (!defined('ABSPATH')) { exit; }
add_filter('pre_get_document_title', function($title){
    if (is_admin() || !is_page()) return $title;
    $map = [
        'home'=>'E-Waste and Scrap Collection in Bangalore | Dakshin Chakra',
        'about-dakshin-chakra'=>'About Dakshin Chakra | Bangalore E-Waste and Scrap Collection',
        'services'=>'E-Waste and Scrap Collection Services in Bangalore | Dakshin Chakra',
        'residential-e-waste-pickup'=>'Residential E-Waste Pickup in Bangalore | Dakshin Chakra',
        'corporate-e-waste-disposal'=>'Corporate E-Waste Disposal in Bangalore | Dakshin Chakra',
        'scrap-collection'=>'Scrap Collection in Bangalore | Dakshin Chakra',
        'items-we-collect'=>'Items We Collect | E-Waste and Scrap Pickup Bangalore',
        'data-bearing-devices'=>'Old Laptop, Hard Drive and Device Disposal in Bangalore | Dakshin Chakra',
        'service-areas-bangalore'=>'E-Waste Pickup Areas in Bangalore | Dakshin Chakra',
        'faq'=>'E-Waste Pickup Bangalore FAQs | Dakshin Chakra',
        'contact'=>'Contact Dakshin Chakra | WhatsApp for E-Waste Pickup Bangalore'
    ];
    $slug = get_post_field('post_name', get_queried_object_id());
    return $map[$slug] ?? $title;
});

add_action('wp_head', function(){
    if (!is_front_page()) return;
    echo '<meta name="description" content="Dakshin Chakra provides e-waste and scrap collection support for homes, apartments, offices, and businesses in Bangalore. WhatsApp for pickup, item review, and valuation where feasible.">';
}, 5);
