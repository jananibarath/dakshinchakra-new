<?php
if (!defined('ABSPATH')) { exit; }

function dc_seed_pages() {
    if (get_option('dc_pages_seeded_v1')) { return; }

    $pages = [
        'home' => ['title'=>'Home','slug'=>'home','content'=>dc_home_content()],
        'about-dakshin-chakra' => ['title'=>'About Dakshin Chakra','slug'=>'about-dakshin-chakra','content'=>dc_simple_page('About Dakshin Chakra','Dakshin Chakra is a Bangalore-based e-waste and scrap collection company operating since 2023.', ['Who We Are','Why Dakshin Chakra Exists','What We Help With','Responsible Routing','Our Bangalore Focus'])],
        'services' => ['title'=>'Services','slug'=>'services','content'=>dc_services_content()],
        'residential-e-waste-pickup' => ['title'=>'Residential E-Waste Pickup','slug'=>'residential-e-waste-pickup','content'=>dc_sectioned('Residential E-Waste Pickup in Bangalore',['For homes and apartments','Items commonly collected','How pickup works','Apartment and community pickups','Payment and valuation','Items not accepted','FAQ'])],
        'corporate-e-waste-disposal' => ['title'=>'Corporate E-Waste Disposal','slug'=>'corporate-e-waste-disposal','content'=>dc_sectioned('Corporate E-Waste Disposal in Bangalore',['For offices and businesses','Bulk e-waste pickup','IT equipment and office electronics','Facilities team coordination','Responsible routing','Data-bearing device caution','FAQ'])],
        'scrap-collection' => ['title'=>'Scrap Collection','slug'=>'scrap-collection','content'=>dc_sectioned('Scrap Collection in Bangalore',['E-waste plus selected recyclable scrap','Metal scrap','Wires and cables','Appliances and old equipment','Household and business scrap','What we do not collect','Payment and valuation'])],
        'items-we-collect' => ['title'=>'Items We Collect','slug'=>'items-we-collect','content'=>dc_items_content()],
        'data-bearing-devices' => ['title'=>'Data-Bearing Devices','slug'=>'data-bearing-devices','content'=>dc_data_content()],
        'service-areas-bangalore' => ['title'=>'Service Areas in Bangalore','slug'=>'service-areas-bangalore','content'=>dc_areas_content()],
        'faq' => ['title'=>'FAQ','slug'=>'faq','content'=>dc_faq_content()],
        'contact' => ['title'=>'Contact','slug'=>'contact','content'=>dc_contact_content()],
    ];

    foreach ($pages as $p) {
        $existing = get_page_by_path($p['slug']);
        if ($existing) {
            if (!trim(wp_strip_all_tags($existing->post_content))) {
                wp_update_post(['ID'=>$existing->ID,'post_content'=>$p['content']]);
            }
            continue;
        }
        wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_title'=>$p['title'],'post_name'=>$p['slug'],'post_content'=>$p['content']]);
    }

    $home = get_page_by_path('home');
    if ($home) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home->ID);
    }
    update_option('dc_pages_seeded_v1', 1);
}
add_action('after_switch_theme', 'dc_seed_pages');

function dc_cta(){ return "<!-- wp:buttons --><div class=\"wp-block-buttons\"><!-- wp:button {\"backgroundColor\":\"primary\"} --><div class=\"wp-block-button\"><a class=\"wp-block-button__link has-primary-background-color has-background wp-element-button\" href=\"https://wa.me/916364659339\">WhatsApp for Pickup</a></div><!-- /wp:button --></div><!-- /wp:buttons -->"; }
function dc_sectioned($h1,$sections){ $c="<!-- wp:heading {\"level\":1} --><h1>{$h1}</h1><!-- /wp:heading -->"; foreach($sections as $s){$c.="<!-- wp:heading --><h2>{$s}</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Practical support is available in Bangalore based on item type, quantity, condition, and location. Materials are routed through authorized recycling partners where applicable.</p><!-- /wp:paragraph -->";} return $c.dc_cta(); }
function dc_simple_page($h1,$intro,$sections){ return dc_sectioned($h1,$sections)."<!-- wp:paragraph --><p>{$intro}</p><!-- /wp:paragraph -->"; }
function dc_home_content(){ return '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"backgroundColor":"base"} --><div class="wp-block-group has-base-background-color has-background" style="padding-top:3rem;padding-bottom:3rem"><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column {"width":"60%"} --><div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"level":1} --><h1>Responsible E-Waste and Scrap Collection in Bangalore</h1><!-- /wp:heading --><!-- wp:paragraph --><p>Clear old electronics, appliances, IT assets, wires, cables, and recyclable scrap from your home, apartment, office, or business with convenient pickup support from Dakshin Chakra.</p><!-- /wp:paragraph -->'.dc_cta().'<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/items-we-collect/">View Items We Collect</a></div><!-- /wp:button --></div><!-- /wp:buttons --><!-- wp:list --><ul><li>Homes, apartments, offices and businesses</li><li>Selected items paid where feasible</li><li>Bangalore pickup support</li><li>Routed through authorized recycling partners where applicable</li></ul><!-- /wp:list --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"dc-placeholder"} --><div class="wp-block-group dc-placeholder"><!-- wp:paragraph --><p>Add e-waste pickup or recycling image here.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:group -->'.dc_sectioned('Our Work in Action',['Residential Pickup','Bulk and Office Collection','Sorting and Responsible Routing']).dc_sectioned('Committed to Cleaner E-Waste Disposal in Bangalore',['Ready to Dispose of Your E-Waste?','What Customers Can Expect','See How Pickup Works','Reach Out to Dakshin Chakra','Get in Touch With Us','Frequently Asked Questions','Clear Your E-Waste the Simple Way']); }
function dc_services_content(){ return dc_sectioned('E-Waste and Scrap Collection Services in Bangalore',['Residential E-Waste Pickup','Corporate E-Waste Disposal','Scrap Collection','Items We Collect','Data-Bearing Devices','Service Areas in Bangalore']); }
function dc_items_content(){ return dc_sectioned('Items We Collect',['Computers and IT equipment','Mobile and personal devices','Office electronics','Home appliances','Scrap and recyclable material','Items not accepted']); }
function dc_data_content(){ return dc_sectioned('Old Laptop, Hard Drive and Device Disposal in Bangalore',['Why data-bearing devices need care','Devices covered','What customers should do before pickup','Household devices','Corporate devices','Safe wording around data handling','FAQ']); }
function dc_areas_content(){ return dc_sectioned('E-Waste Pickup Areas in Bangalore',['Vasanth Nagar','RT Nagar','Hebbal','Indiranagar','Koramangala','Whitefield','Marathahalli','Jayanagar','JP Nagar','Malleshwaram','Rajajinagar','Yelahanka','HSR Layout','Electronic City','MG Road / Central Bangalore']); }
function dc_faq_content(){ $qs=[
'Do you collect e-waste from homes in Bangalore?','Do you collect old laptops and computers?','Do you pay for e-waste?','Which items have resale or scrap value?','Do you collect from apartments?','Do you collect from offices and companies?','Can I send photos before pickup?','Do you collect old mobile phones?','Do you collect printers and UPS systems?','Do you collect batteries?','Do you collect general scrap also?','What items are not accepted?','Do you provide same-day pickup?','How is pricing decided?','What happens after items are collected?','Do you handle data-bearing devices?','Is there a minimum quantity for pickup?','Do you collect old clothes?','Do you collect wet waste or household garbage?','Which areas of Bangalore do you cover?']; $c='<!-- wp:heading {"level":1} --><h1>E-Waste Pickup Bangalore FAQs</h1><!-- /wp:heading -->'; foreach($qs as $q){$c.="<!-- wp:heading {\"level\":3} --><h3>{$q}</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Support depends on item type, quantity, condition, and location in Bangalore. Materials are routed through authorized recycling partners where applicable.</p><!-- /wp:paragraph -->";} return $c.dc_cta(); }
function dc_contact_content(){ return dc_sectioned('Contact Dakshin Chakra',['WhatsApp CTA','Phone/contact card','Address card','Pickup instructions','What to send on WhatsApp','Final CTA']).'<!-- wp:list --><ul><li>Name</li><li>Area in Bangalore</li><li>Type of items</li><li>Approximate quantity</li><li>Photos if available</li></ul><!-- /wp:list -->'; }
