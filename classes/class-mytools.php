<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }

/**
 * @about My Tools Menu
 * @location classes/class-core.php
 * @call WpMyAdminBar_MyTools::instance();
 * 
 * @method init()           Init Menus
 * @method render()         Render Menu Parts
 * @method keywordTools()   Menu Item | Keyword Tools
 * @method rankingTools()   Menu Item | Ranking Tools
 * @method seoTools()       Menu Item | SEO Tools
 * @method validateTools()  Menu Item | Validation Tools
 * @method monitorTools()   Menu Item | Monitoring Tools
 * @method webTools()       Menu Item | Web Tools
 * @method wordTools()      Menu Item | Woord Tools
 * @method rebuildLinks()   Strip/Replace {$website} within links
 * @method websiteUrl()     Parse URL to domain.com
 * @method instance()       Create Instance
 */
if( ! class_exists( 'WpMyAdminBar_MyTools' ) )
{
    class WpMyAdminBar_MyTools extends WpMyAdminBar_Extended
    {
        // Holds Instance Object
        protected static $instance = NULL;


        /**
         * @about Init Menus
         */
        final public function init()
        {
            add_action( 'admin_bar_menu', array( $this, 'render' ), 35, 0 );
        }


        /**
         * @about Render Menu Parts
         */
        final public function render()
        {
            global $wp_admin_bar;

            // Menu Title - My Tools
            $wp_admin_bar->add_menu( array(
                'id'    => 'my-tools',
                'title' => __( 'My Tools', 'wp-my-admin-bar' ),
                'href'  => false,
            ) );

            // Group - My Tools
            $wp_admin_bar->add_group( array(
                'parent'    => 'my-tools',
                'id'        => 'my-tools-group',
                'meta'      => array( 'class' => 'ab-sub-secondary' )
            ) );

            // Menu Item | Keyword Tools
            $this->keywordTools( $wp_admin_bar );

            // Menu Item | Ranking Tools
            $this->rankingTools( $wp_admin_bar );

            // Menu Item | SEO Tools
            $this->seoTools( $wp_admin_bar );

            // Menu Item | Validation Tools
            $this->validateTools( $wp_admin_bar );

            // Menu Item | Monitoring Tools
            $this->monitorTools( $wp_admin_bar );

            // Menu Item | Web Tools
            $this->webTools( $wp_admin_bar );

            // Menu Item | Woord Tools
            $this->wordTools( $wp_admin_bar );
        }


        /**
         * @about Menu Item | Keyword Tools
         */
        final private function keywordTools( $wp_admin_bar )
        {
            // Sub Menu - Keywords
            $wp_admin_bar->add_menu( array(
                'title'     => __( 'Keyword Tools', 'wp-my-admin-bar' ),
                'id'        => 'keywords',
                'parent'    => 'my-tools-group',
                'href'      => false
            ) );

            // Menu Items - Keywords
            $i=0;
            foreach ( array(
                __( 'Google KeyTool', 'wp-my-admin-bar' )   => 'https://adwords.google.com/select/KeywordToolExternal',
                __( 'Google Insights', 'wp-my-admin-bar' )  => 'http://www.google.com/insights/search/',
                __( 'Google Trends', 'wp-my-admin-bar' )    => 'http://www.google.com/trends/',
                __( 'Keyword Map', 'wp-my-admin-bar' )      => 'http://www.kwmap.net/',
                __( 'Keyword Spy', 'wp-my-admin-bar' )      => 'http://www.keywordspy.com/research/search.aspx?q={$website}&tab=domain-overview',
                __( 'Meta Glossary', 'wp-my-admin-bar' )    => 'http://www.metaglossary.com/',
                __( 'SEO Digger', 'wp-my-admin-bar' )       => 'http://analyticsdigger.org/search.php?q={$website}',
                __( 'Thesaurus', 'wp-my-admin-bar' )        => 'http://thesaurus.com/',
                __( 'Uber Suggest', 'wp-my-admin-bar' )     => 'http://ubersuggest.org/',
                __( 'Urban Dictionary', 'wp-my-admin-bar' ) => 'http://www.urbandictionary.com/',
                __( 'Wordtracker', 'wp-my-admin-bar' )      => 'https://freekeywords.wordtracker.com/'
            ) as $title => $url ) {
                $i++;

                $wp_admin_bar->add_menu( array(
                    'parent'    => 'keywords',
                    'id'        => 'keywords-' . $i,
                    'title'     => '&bull; ' . $title,
                    'href'      => $this->rebuildLinks( $url ),
                ) );
            }
        }


        /**
         * @about Menu Item | Ranking Tools
         */
        final private function RankingTools( $wp_admin_bar )
        {
            // Sub Menu
            $wp_admin_bar->add_menu( array(
                'title'     => __( 'Ranking Tools', 'wp-my-admin-bar' ),
                'id'        => 'rankings',
                'parent'    => 'my-tools-group',
                'href'      => false
            ) );

            // Menu Item
            $i=0;
            foreach ( array(
                __( 'Compete Rank', 'wp-my-admin-bar' ) => 'http://siteanalytics.compete.com/{$website}/',
                __( 'Alexa Rank', 'wp-my-admin-bar' )   => 'http://www.alexa.com/siteinfo/{$website}'
            ) as $title => $url ) {
                $i++;

                $wp_admin_bar->add_menu( array(
                    'parent'    => 'rankings',
                    'id'        => 'rankings-' . $i,
                    'title'     => '&bull; ' . $title,
                    'href'      => $this->rebuildLinks( $url ),
                ) );
            }
        }


        /**
         * @about Menu Item | SEO Tools
         */
        final private function seoTools( $wp_admin_bar )
        {
            // Sub Menu
            $wp_admin_bar->add_menu( array(
                'title'     => __( 'SEO Tools', 'wp-my-admin-bar' ),
                'id'        => 'seo',
                'parent'    => 'my-tools-group',
                'href'      => false
            ) );

            // Menu Item
            $i=0;
            foreach ( array(
                __( 'Ahrefs Explorer', 'wp-my-admin-bar' )  => 'https://ahrefs.com/site-explorer/backlinks/subdomains/{$website}',
                __( 'Majestic SEO', 'wp-my-admin-bar' )     => 'http://www.majesticseo.com/reports/site-explorer/summary/{$website}?IndexDataSource=F',
                __( 'SEO Moz', 'wp-my-admin-bar' )          => 'http://www.opensiteexplorer.org/links?site={$website}',
                __( 'SEO Profiler', 'wp-my-admin-bar' )     => 'http://www.seoprofiler.com/analyze/{$website}',
                __( 'SE Rush', 'wp-my-admin-bar' )          => 'http://www.semrush.com/info/{$website}'
            ) as $title => $url ) {
                $i++;

                $wp_admin_bar->add_menu( array(
                    'parent'    => 'seo',
                    'id'        => 'seo-' . $i,
                    'title'     => '&bull; ' . $title,
                    'href'      => $this->rebuildLinks( $url ),
                ) );
            }
        }


        /**
         * @about Menu Item | Validation Tools
         */
        final private function validateTools( $wp_admin_bar )
        {
            // Sub Menu
            $wp_admin_bar->add_menu( array(
                'title'     => __( 'Validation Tools', 'wp-my-admin-bar' ),
                'id'        => 'validate',
                'parent'    => 'my-tools-group',
                'href'      => false
            ) );

            // Menu Item
            $i=0;
            foreach ( array(
                __( 'W3C Validate Page', 'wp-my-admin-bar' )    => 'http://validator.w3.org/check?uri=$siteUrl/&charset=%28detect+automatically%29&doctype=Inline&group=0',
                __( 'W3C Validate CSS', 'wp-my-admin-bar' )     => 'http://jigsaw.w3.org/css-validator/validator?uri={$css_url}&profile=css21&usermedium=all&warning=1&vextwarning=&lang=en',
                __( 'W3C Mobile Checker', 'wp-my-admin-bar' )   => 'http://validator.w3.org/mobile/check?docAddr={$website}&async=true',
                __( 'W3C Validate Feed', 'wp-my-admin-bar' )    => 'http://validator.w3.org/feed/check.cgi?url={$feed_url}',
                __( 'W3C Link Checker', 'wp-my-admin-bar' )     => 'http://validator.w3.org/checklink?uri={$website}&hide_type=all&depth=&check=Check'
            ) as $title => $url ) {
                $i++;

                $wp_admin_bar->add_menu( array(
                    'parent'    => 'validate',
                    'id'        => 'validate-' . $i,
                    'title'     => '&bull; ' . $title,
                    'href'      => $this->rebuildLinks( $url ),
                ) );
            }
        }


        /**
         * @about Menu Item | Monitoring Tools
         */
        final private function monitorTools( $wp_admin_bar )
        {
            // Sub Menu
            $wp_admin_bar->add_menu( array(
                'title'     => __( 'Monitoring Tools', 'wp-my-admin-bar' ),
                'id'        => 'monitor',
                'parent'    => 'my-tools-group',
                'href'      => false
            ) );

            // Menu Item
            $i=0;
            foreach ( array(
                __( 'Internet Conditions', 'wp-my-admin-bar' )  => 'http://www.akamai.com/html/technology/dataviz1.html',
                __( 'Internet Health', 'wp-my-admin-bar' )      => 'http://www.internetpulse.net/',
                __( 'Internet Health Map', 'wp-my-admin-bar' )  => 'http://www.gomez.com/internet-health-map/',
                __( 'Traffic Report', 'wp-my-admin-bar' )       => 'http://www.internettrafficreport.com/',
                __( 'Google Servers', 'wp-my-admin-bar' )       => 'http://www.google.com/transparencyreport/traffic/'
            ) as $title => $url ) {
                $i++;

                $wp_admin_bar->add_menu( array(
                    'parent'    => 'monitor',
                    'id'        => 'monitor-' . $i,
                    'title'     => '&bull; ' . $title,
                    'href'      => $this->rebuildLinks( $url ),
                ) );
            }
        }


        /**
         * @about Menu Item | Web Tools
         */
        final private function webTools( $wp_admin_bar )
        {
            // Sub Menu
            $wp_admin_bar->add_menu( array(
                'title'     => __( 'Web Tools', 'wp-my-admin-bar' ),
                'id'        => 'web',
                'parent'    => 'my-tools-group',
                'href'      => false
            ) );

            // Menu Item
            $i=0;
            foreach ( array(
                __( 'Domain Whois', 'wp-my-admin-bar' )         => 'http://whois.domaintools.com/',
                __( 'Down For Me?', 'wp-my-admin-bar' )         => 'http://www.downforeveryoneorjustme.com/',
                __( 'iWeb Tools', 'wp-my-admin-bar' )           => 'http://www.iwebtool.com/tools/',
                __( 'Pingler Ping Tool', 'wp-my-admin-bar' )    => 'http://pingler.com/',
                __( 'Pingler Web Tools', 'wp-my-admin-bar' )    => 'http://pingler.com/seo-tools/',
                __( 'Qbase Site Data', 'wp-my-admin-bar' )      => 'http://www.quarkbase.com/{$website}',
                __( 'WayBackMachine', 'wp-my-admin-bar' )       => 'http://www.archive.org/'
            ) as $title => $url ) {
                $i++;

                $wp_admin_bar->add_menu( array(
                    'parent'    => 'web',
                    'id'        => 'web-' . $i,
                    'title'     => '&bull; ' . $title,
                    'href'      => $this->rebuildLinks( $url ),
                ) );
            }
        }


        /**
         * @about Menu Item | Word Tools
         */
        final private function wordTools( $wp_admin_bar )
        {
            // Sub Menu
            $wp_admin_bar->add_menu( array(
                'title'     => __( 'Word Tools', 'wp-my-admin-bar' ),
                'id'        => 'word',
                'parent'    => 'my-tools-group',
                'href'      => false
            ) );

            // Menu Item
            $i=0;
            foreach ( array(
                __( 'Combine Words', 'wp-my-admin-bar' )        => 'http://www.combinewords.com/',
                __( 'Keyword Density', 'wp-my-admin-bar' )      => 'http://tools.davidnaylor.co.uk/keyworddensity/',
                __( 'Keyword Mixer', 'wp-my-admin-bar' )        => 'http://keywordmixer.com/',
                __( 'Readability Index', 'wp-my-admin-bar' )    => 'http://www.standards-schmandards.com/exhibits/rix/index.php',
                __( 'Typo Generator', 'wp-my-admin-bar' )       => 'http://tools.seobook.com/spelling/keywords-typos.cgi'
            ) as $title => $url ) {
                $i++;

                $wp_admin_bar->add_menu( array(
                    'parent'    => 'word',
                    'id'        => 'word-' . $i,
                    'title'     => '&bull; ' . $title,
                    'href'      => $this->rebuildLinks( $url ),
                ) );
            }
        }
    

        /**
         * @about Strip/Replace {$var} within Tools links
         * @param string $link Link to filter
         * @return string $link Filtered link
         */
        final private function rebuildLinks( $link )
        {
            // Localize Vars
            $website = $this->websiteUrl();
            $css_url = get_bloginfo( 'template_url' ) .'/style.css';
            $feed_url = get_bloginfo( 'rss2_url' );

            // Match all {$var}
            $matches = array();
            preg_match_all( '~\{\$(.*?)\}~si', $link, $matches );

            // If first array value found
            if ( isset( $matches[0][0] ) ) {
                // Assign vars to values
                $item = compact( $matches[1][0] );

                // Loop through the items
                foreach ( $item as $var => $value ) {
                    // Replace {$website} from the $item key, with the $value directly
                    $link = str_replace( '{$'.$var.'}', $value, $link );
                }
            }
            
            return $link;
        }


        /**
         * @about Parse URL to domain.com
         * @return string Host Name
         */
        final private function websiteUrl()
        {
            $parsed_url = parse_url( site_url() );
            return $parsed_url['host'];
        }


        /**
         * @about Create Instance
         */
        public static function instance()
        {
            if ( ! self::$instance ) {
                self::$instance = new self();
                self::$instance->init();
            }

            return self::$instance;
        }
    }
}
