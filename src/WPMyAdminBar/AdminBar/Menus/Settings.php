<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012-2015, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 1.0.0
 */

/**
 * Declared Namespace
 */
namespace WPMyAdminBar\AdminBar\Menus;

// Required To Run
if( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Features found on the Menus
 * 
 * @see src/WPMyAdminBar/AdminBar/Menus/MyCache.php
 * @see src/WPMyAdminBar/AdminBar/Menus/MyTools.php
 * 
 * @since 1.0.0
 */
class Settings
{


    /**
     * My Tools Menu - Groups for Tools
     * 
     * @return array
     */
    final public static function cachePlugins() {
        return array(
            'dbcache'   => array( __( 'DB Cache', 'WPMyAdminBar' ),      'wp-admin/options-general.php?page=db-cache-reloaded-fix/db-cache-reloaded.php' ),
            'super'     => array( __( 'Super Cache', 'WPMyAdminBar' ),   'options-general.php?page=wpsupercache' ),
            'total'     => array( __( 'Total Cache', 'WPMyAdminBar' ),   'admin.php?page=w3tc_general' ),
            'widget'    => array( __( 'Widget Cache', 'WPMyAdminBar' ),  'options-general.php?page=widget-cache.php' ),
            'minify'    => array( __( 'WP Minify', 'WPMyAdminBar' ),     'options-general.php?page=wp-minify' )
        );
    }


    /**
     * Groups for My Tools Menu
     * 
     * @return array
     */
    final public static function toolGroups() {
        return array(
            "keywords"      => __( 'Keyword Tools', 'WPMyAdminBar' ),
            "seo"           => __( 'SEO Tools', 'WPMyAdminBar' ),
            "ranking"       => __( 'Traffic &amp; Rankings', 'WPMyAdminBar' ),
            "validate"      => __( 'Validators', 'WPMyAdminBar' ),
            "monitor"       => __( 'Web Health', 'WPMyAdminBar' ),
            "web"           => __( 'Web Tools', 'WPMyAdminBar' ),
            "words"         => __( 'Word Tools', 'WPMyAdminBar' )
        );
    }


    /**
     * My Tools Menu Group - Keyword Tools
     * 
     * @return array
     */
    final public static function toolsKeywords() {
        return array(
            array( 'group' => 'keywords', 'title' => __( 'Google KeyTool', 'WPMyAdminBar' ), 'url' => 'https://adwords.google.com/select/KeywordToolExternal' ),
            array( 'group' => 'keywords', 'title' => __( 'Google Insights', 'WPMyAdminBar' ), 'url' => 'http://www.google.com/insights/search/' ),
            array( 'group' => 'keywords', 'title' => __( 'Google Trends', 'WPMyAdminBar' ), 'url' => 'http://www.google.com/trends/' ),
            array( 'group' => 'keywords', 'title' => __( 'Keyword Map', 'WPMyAdminBar' ), 'url' => 'http://www.kwmap.net/' ),
            array( 'group' => 'keywords', 'title' => __( 'Keyword Spy', 'WPMyAdminBar' ), 'url' => 'http://www.keywordspy.com/research/search.aspx?q={$website}&tab=domain-overview' ),
            array( 'group' => 'keywords', 'title' => __( 'Meta Glossary', 'WPMyAdminBar' ), 'url' => 'http://www.metaglossary.com/' ),
            array( 'group' => 'keywords', 'title' => __( 'SEO Digger', 'WPMyAdminBar' ), 'url' => 'http://analyticsdigger.org/search.php?q={$website}' ),
            array( 'group' => 'keywords', 'title' => __( 'Thesaurus', 'WPMyAdminBar' ), 'url' => 'http://thesaurus.com/' ),
            array( 'group' => 'keywords', 'title' => __( 'Uber Suggest', 'WPMyAdminBar' ), 'url' => 'http://ubersuggest.org/' ),
            array( 'group' => 'keywords', 'title' => __( 'Urban Dictionary', 'WPMyAdminBar' ), 'url' => 'http://www.urbandictionary.com/' ),
            array( 'group' => 'keywords', 'title' => __( 'Wordtracker', 'WPMyAdminBar' ), 'url' => 'https://freekeywords.wordtracker.com/' )
        );
    }

    
    /**
     * My Tools Menu Group - Traffic & Rankings Tools
     * 
     * @return array
     */
    final public static function toolsRanking() {
        return array(
            array( 'group' => 'ranking', 'title' => __( 'Compete Rank', 'WPMyAdminBar' ), 'url' => 'http://siteanalytics.compete.com/{$website}/' ),
            array( 'group' => 'ranking', 'title' => __( 'Alexa Rank', 'WPMyAdminBar' ), 'url' => 'http://www.alexa.com/siteinfo/{$website}' )
        );
    }

    
    /**
     * My Tools Menu Group - Search Engine Tools
     * 
     * @return array
     */
    final public static function toolsSeo() {
        return array(
            array( 'group' => 'seo', 'title' => __( 'Ahrefs Explorer', 'WPMyAdminBar' ), 'url' => 'https://ahrefs.com/site-explorer/backlinks/subdomains/{$website}' ),
            array( 'group' => 'seo', 'title' => __( 'Majestic SEO', 'WPMyAdminBar' ), 'url' => 'http://www.majesticseo.com/reports/site-explorer/summary/{$website}?IndexDataSource=F' ),
            array( 'group' => 'seo', 'title' => __( 'SEO Moz', 'WPMyAdminBar' ), 'url' => 'http://www.opensiteexplorer.org/links?site={$website}' ),
            array( 'group' => 'seo', 'title' => __( 'SEO Profiler', 'WPMyAdminBar' ), 'url' => 'http://www.seoprofiler.com/analyze/{$website}' ),
            array( 'group' => 'seo', 'title' => __( 'SE Rush', 'WPMyAdminBar' ), 'url' => 'http://www.semrush.com/info/{$website}' )
        );
    }

    
    /**
     * My Tools Menu Group - Validator Tools
     * 
     * @return array
     */
    final public static function toolsValidate() {
        return array(
            array( 'group' => 'validate', 'title' => __( 'W3C Validate Page', 'WPMyAdminBar' ), 'url' => 'http://validator.w3.org/check?uri=$siteUrl/&charset=%28detect+automatically%29&doctype=Inline&group=0' ),
            array( 'group' => 'validate', 'title' => __( 'W3C Validate CSS', 'WPMyAdminBar' ), 'url' => 'http://jigsaw.w3.org/css-validator/validator?uri={$css_url}&profile=css21&usermedium=all&warning=1&vextwarning=&lang=en' ),
            array( 'group' => 'validate', 'title' => __( 'W3C Mobile Checker', 'WPMyAdminBar' ), 'url' => 'http://validator.w3.org/mobile/check?docAddr={$website}&async=true' ),
            array( 'group' => 'validate', 'title' => __( 'W3C Validate Feed', 'WPMyAdminBar' ), 'url' => 'http://validator.w3.org/feed/check.cgi?url={$feed_url}' ),
            array( 'group' => 'validate', 'title' => __( 'W3C Link Checker', 'WPMyAdminBar' ), 'url' => 'http://validator.w3.org/checklink?uri={$website}&hide_type=all&depth=&check=Check' )
        );
    }


    /**
     * My Tools Menu Group - Web Health Tools
     * 
     * @return array
     */
    final public static function toolsMonitor() {
        return array(
            array( 'group' => 'monitor', 'title' => __( 'Internet Conditions', 'WPMyAdminBar' ), 'url' => 'http://www.akamai.com/html/technology/dataviz1.html' ),
            array( 'group' => 'monitor', 'title' => __( 'Internet Health', 'WPMyAdminBar' ), 'url' => 'http://www.internetpulse.net/' ),
            array( 'group' => 'monitor', 'title' => __( 'Internet Health Map', 'WPMyAdminBar' ), 'url' => 'http://www.gomez.com/internet-health-map/' ),
            array( 'group' => 'monitor', 'title' => __( 'Traffic Report', 'WPMyAdminBar' ), 'url' => 'http://www.internettrafficreport.com/' ),
            array( 'group' => 'monitor', 'title' => __( 'Google Servers', 'WPMyAdminBar' ), 'url' => 'http://www.google.com/transparencyreport/traffic/' )
        );
    }

    
    /**
     * My Tools Menu Group - Web Tools
     * 
     * @return array
     */
    final public static function toolsWeb() {
        return array(
            array( 'group' => 'web', 'title' => __( 'Domain Whois', 'WPMyAdminBar' ), 'url' => 'http://whois.domaintools.com/' ),
            array( 'group' => 'web', 'title' => __( 'Down For Me?', 'WPMyAdminBar' ), 'url' => 'http://www.downforeveryoneorjustme.com/' ),
            array( 'group' => 'web', 'title' => __( 'iWeb Tools', 'WPMyAdminBar' ), 'url' => 'http://www.iwebtool.com/tools/' ),
            array( 'group' => 'web', 'title' => __( 'Pingler Ping Tool', 'WPMyAdminBar' ), 'url' => 'http://pingler.com/' ),
            array( 'group' => 'web', 'title' => __( 'Pingler Web Tools', 'WPMyAdminBar' ), 'url' => 'http://pingler.com/seo-tools/' ),
            array( 'group' => 'web', 'title' => __( 'Qbase Site Data', 'WPMyAdminBar' ), 'url' => 'http://www.quarkbase.com/{$website}' ),
            array( 'group' => 'web', 'title' => __( 'WayBackMachine', 'WPMyAdminBar' ), 'url' => 'http://www.archive.org/' )
        );
    }

    
    /**
     * My Tools Menu Group - Word/Text Tools
     * 
     * @return array
     */
    final public static function toolsWords() {
        return array(
            array( 'group' => 'words', 'title' => __( 'Combine Words', 'WPMyAdminBar' ), 'url' => 'http://www.combinewords.com/' ),
            array( 'group' => 'words', 'title' => __( 'Keyword Density', 'WPMyAdminBar' ), 'url' => 'http://tools.davidnaylor.co.uk/keyworddensity/' ),
            array( 'group' => 'words', 'title' => __( 'Keyword Mixer', 'WPMyAdminBar' ), 'url' => 'http://keywordmixer.com/' ),
            array( 'group' => 'words', 'title' => __( 'Readability Index', 'WPMyAdminBar' ), 'url' => 'http://www.standards-schmandards.com/exhibits/rix/index.php' ),
            array( 'group' => 'words', 'title' => __( 'Typo Generator', 'WPMyAdminBar' ), 'url' => 'http://tools.seobook.com/spelling/keywords-typos.cgi' )
        );
    }
}