<?php

if ( !function_exists( 'efbl_time_ago' ) ) {
    function efbl_time_ago(  $date, $granularity = 2  ) {
        $retval = '';
        //Preparing strings to translate
        $date_time_strings = array(
            'second'  => __( 'second', 'easy-facebook-likebox' ),
            'seconds' => __( 'seconds', 'easy-facebook-likebox' ),
            'minute'  => __( 'minute', 'easy-facebook-likebox' ),
            'minutes' => __( 'minutes', 'easy-facebook-likebox' ),
            'hour'    => __( 'hour', 'easy-facebook-likebox' ),
            'hours'   => __( 'hours', 'easy-facebook-likebox' ),
            'day'     => __( 'day', 'easy-facebook-likebox' ),
            'days'    => __( 'days', 'easy-facebook-likebox' ),
            'week'    => __( 'week', 'easy-facebook-likebox' ),
            'weeks'   => __( 'weeks', 'easy-facebook-likebox' ),
            'month'   => __( 'month', 'easy-facebook-likebox' ),
            'months'  => __( 'months', 'easy-facebook-likebox' ),
            'year'    => __( 'year', 'easy-facebook-likebox' ),
            'years'   => __( 'years', 'easy-facebook-likebox' ),
            'decade'  => __( 'decade', 'easy-facebook-likebox' ),
        );
        $ago_text = __( 'ago', 'easy-facebook-likebox' );
        $date = strtotime( $date );
        $difference = time() - $date;
        $periods = array(
            'decade' => 315360000,
            'year'   => 31536000,
            'month'  => 2628000,
            'week'   => 604800,
            'day'    => 86400,
            'hour'   => 3600,
            'minute' => 60,
            'second' => 1,
        );
        foreach ( $periods as $key => $value ) {
            if ( $difference >= $value ) {
                $time = floor( $difference / $value );
                $difference %= $value;
                $retval .= (( $retval ? ' ' : '' )) . $time . ' ';
                $retval .= ( $time > 1 ? $date_time_strings[$key . 's'] : $date_time_strings[$key] );
                $granularity--;
            }
            if ( $granularity == '0' ) {
                break;
            }
        }
        return '' . $retval . ' ' . $ago_text;
    }

}
if ( !function_exists( 'ecff_stripos_arr' ) ) {
    function ecff_stripos_arr(  $haystack, $needle  ) {
        if ( !is_array( $needle ) ) {
            $needle = array($needle);
        }
        foreach ( $needle as $what ) {
            if ( ($pos = stripos( $haystack, ltrim( $what ) )) !== false ) {
                return $pos;
            }
        }
        return false;
    }

}
if ( !function_exists( 'ecff_hastags_to_link' ) ) {
    function ecff_hastags_to_link(  $text  ) {
        return preg_replace( '/(^|\\s)#(\\w*[a-zA-Z_]+\\w*)/', '\\1#<a href="https://www.facebook.com/hashtag/\\2" class="eflb-hash" target="_blank">\\2</a>', $text );
    }

}
if ( !function_exists( 'efbl_parse_url' ) ) {
    function efbl_parse_url(  $url  ) {
        $fb_url = parse_url( $url );
        $fanpage_url = str_replace( '/', '', $fb_url['path'] );
        return $fanpage_url;
    }

}
if ( !function_exists( 'efbl_get_locales' ) ) {
    /**
     * Compile and filter the list of locales.
     *
     *
     * @return return the list of locales.
     */
    function efbl_get_locales() {
        $locales = array(
            'af_ZA' => 'Afrikaans',
            'ar_AR' => 'Arabic',
            'az_AZ' => 'Azeri',
            'be_BY' => 'Belarusian',
            'bg_BG' => 'Bulgarian',
            'bn_IN' => 'Bengali',
            'bs_BA' => 'Bosnian',
            'ca_ES' => 'Catalan',
            'cs_CZ' => 'Czech',
            'cy_GB' => 'Welsh',
            'da_DK' => 'Danish',
            'de_DE' => 'German',
            'el_GR' => 'Greek',
            'en_US' => 'English (US)',
            'en_GB' => 'English (UK)',
            'eo_EO' => 'Esperanto',
            'es_ES' => 'Spanish (Spain)',
            'es_LA' => 'Spanish',
            'et_EE' => 'Estonian',
            'eu_ES' => 'Basque',
            'fa_IR' => 'Persian',
            'fb_LT' => 'Leet Speak',
            'fi_FI' => 'Finnish',
            'fo_FO' => 'Faroese',
            'fr_FR' => 'French (France)',
            'fr_CA' => 'French (Canada)',
            'fy_NL' => 'NETHERLANDS (NL)',
            'ga_IE' => 'Irish',
            'gl_ES' => 'Galician',
            'hi_IN' => 'Hindi',
            'hr_HR' => 'Croatian',
            'hu_HU' => 'Hungarian',
            'hy_AM' => 'Armenian',
            'id_ID' => 'Indonesian',
            'is_IS' => 'Icelandic',
            'it_IT' => 'Italian',
            'ja_JP' => 'Japanese',
            'ka_GE' => 'Georgian',
            'km_KH' => 'Khmer',
            'ko_KR' => 'Korean',
            'ku_TR' => 'Kurdish',
            'la_VA' => 'Latin',
            'lt_LT' => 'Lithuanian',
            'lv_LV' => 'Latvian',
            'mk_MK' => 'Macedonian',
            'ml_IN' => 'Malayalam',
            'ms_MY' => 'Malay',
            'nb_NO' => 'Norwegian (bokmal)',
            'ne_NP' => 'Nepali',
            'nl_NL' => 'Dutch',
            'nn_NO' => 'Norwegian (nynorsk)',
            'pa_IN' => 'Punjabi',
            'pl_PL' => 'Polish',
            'ps_AF' => 'Pashto',
            'pt_PT' => 'Portuguese (Portugal)',
            'pt_BR' => 'Portuguese (Brazil)',
            'ro_RO' => 'Romanian',
            'ru_RU' => 'Russian',
            'sk_SK' => 'Slovak',
            'sl_SI' => 'Slovenian',
            'sq_AL' => 'Albanian',
            'sr_RS' => 'Serbian',
            'sv_SE' => 'Swedish',
            'sw_KE' => 'Swahili',
            'ta_IN' => 'Tamil',
            'te_IN' => 'Telugu',
            'th_TH' => 'Thai',
            'tl_PH' => 'Filipino',
            'tr_TR' => 'Turkish',
            'uk_UA' => 'Ukrainian',
            'ur_PK' => 'Urdu',
            'vi_VN' => 'Vietnamese',
            'zh_CN' => 'Simplified Chinese (China)',
            'zh_HK' => 'Traditional Chinese (Hong Kong)',
            'zh_TW' => 'Traditional Chinese (Taiwan)',
        );
        return apply_filters( 'efbl_locale_names', $locales );
    }

}
if ( !function_exists( 'efbl_check_reaction' ) ) {
    function efbl_check_reaction(  $needle, $array, $filter = null  ) {
        $efbl_reaction_count = null;
        $efbl_reaction_array = array();
        if ( $array ) {
            foreach ( $array as $efbl_reaction ) {
                $efbl_reaction = (array) $efbl_reaction;
                if ( $needle == $efbl_reaction['type'] ) {
                    $efbl_reaction_count++;
                    $efbl_reaction_array['data'][] = $efbl_reaction;
                }
            }
        }
        if ( !empty( $efbl_reaction_array ) ) {
            $efbl_reaction_array['total_count'] = $efbl_reaction_count;
        }
        return $efbl_reaction_array;
    }

}
if ( !function_exists( 'efbl_get_page_bio' ) ) {
    function efbl_get_page_bio(  $id, $cache_seconds  ) {
        $efbl_bio_data = array();
        $accesstoken = '';
        $efbl_bio_slug = "efbl_page_bio-{$id}";
        $efbl_bio_data = get_transient( $efbl_bio_slug );
        if ( !$efbl_bio_data || '' == $efbl_bio_data ) {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
                $pages = $fta_settings['plugins']['facebook']['approved_pages'];
                if ( isset( $pages[$id] ) ) {
                    $page_exists = $pages[$id];
                } else {
                    $page_exists = '';
                }
                if ( $page_exists ) {
                    $accesstoken = $pages[$id]['access_token'];
                } else {
                    $accesstoken = $fta_settings['plugins']['facebook']['access_token'];
                }
            }
            $efbl_bio_url = "https://graph.facebook.com/{$id}?fields=access_token,username,id,name,fan_count,category,about,verification_status&access_token=" . $accesstoken;
            $efbl_bio_data_api = wp_remote_get( $efbl_bio_url );
            if ( isset( $efbl_bio_data_api ) && !empty( $efbl_bio_data_api ) ) {
                if ( isset( $efbl_bio_data_api['body'] ) ) {
                    $efbl_bio_data = json_decode( $efbl_bio_data_api['body'] );
                }
            }
            if ( 200 == $efbl_bio_data_api['response']['code'] && !empty( $efbl_bio_data ) ) {
                set_transient( $efbl_bio_slug, $efbl_bio_data, $cache_seconds );
            }
        }
        return $efbl_bio_data;
    }

}
if ( !function_exists( 'efbl_readable_count' ) ) {
    function efbl_readable_count(  $input  ) {
        if ( !$input ) {
            $input = 0;
        }
        $input = number_format( $input );
        $input_count = substr_count( $input, ',' );
        if ( $input_count != '0' ) {
            if ( $input_count == '1' ) {
                return substr( $input, 0, -4 ) . 'K';
            } elseif ( $input_count == '2' ) {
                return substr( $input, 0, -8 ) . 'M';
            } elseif ( $input_count == '3' ) {
                return substr( $input, 0, -12 ) . 'B';
            } else {
                return;
            }
        } else {
            if ( !$input ) {
                $input = '';
            }
            return $input;
        }
    }

}
if ( !function_exists( 'ecff_makeClickableLinks' ) ) {
    function ecff_makeClickableLinks(  $value, $protocols = array('http', 'mail', 'https'), array $attributes = array()  ) {
        // Ensure $value is a string
        if ( is_null( $value ) ) {
            $value = '';
        }
        // Link attributes
        $attr = '';
        foreach ( $attributes as $key => $val ) {
            $attr .= ' ' . $key . '="' . htmlentities( $val ) . '"';
        }
        $links = array();
        // Extract existing links and tags
        $value = preg_replace_callback( '~(<a .*?>.*?</a>|<.*?>)~i', function ( $match ) use(&$links) {
            return '<' . array_push( $links, $match[1] ) . '>';
        }, $value );
        // Extract text links for each protocol
        foreach ( (array) $protocols as $protocol ) {
            switch ( $protocol ) {
                case 'http':
                case 'https':
                    $value = preg_replace_callback( '~(?:(https?)://([^\\s<]+)|(www\\.[^\\s<]+?\\.[^\\s<]+))(?<![\\.,:])~i', function ( $match ) use($protocol, &$links, $attr) {
                        if ( $match[1] ) {
                            $protocol = $match[1];
                        }
                        $link = ( $match[2] ?: $match[3] );
                        return '<' . array_push( $links, "<a {$attr} href=\"{$protocol}://{$link}\">{$link}</a>" ) . '>';
                    }, $value );
                    break;
                case 'mail':
                    $value = preg_replace_callback( '~([^\\s<]+?@[^\\s<]+?\\.[^\\s<]+)(?<![\\.,:])~', function ( $match ) use(&$links, $attr) {
                        return '<' . array_push( $links, "<a {$attr} href=\"mailto:{$match[1]}\">{$match[1]}</a>" ) . '>';
                    }, $value );
                    break;
                case 'twitter':
                    $value = preg_replace_callback( '~(?<!\\w)[@#](\\w++)~', function ( $match ) use(&$links, $attr) {
                        return '<' . array_push( $links, "<a {$attr} href=\"https://twitter.com/" . (( $match[0][0] == '@' ? '' : 'search/%23' )) . $match[1] . "\">{$match[0]}</a>" ) . '>';
                    }, $value );
                    break;
                default:
                    $value = preg_replace_callback( '~' . preg_quote( $protocol, '~' ) . '://([^\\s<]+?)(?<![\\.,:])~i', function ( $match ) use($protocol, &$links, $attr) {
                        return '<' . array_push( $links, "<a {$attr} href=\"{$protocol}://{$match[1]}\">{$match[1]}</a>" ) . '>';
                    }, $value );
                    break;
            }
        }
        // Insert all link
        return preg_replace_callback( '/<(\\d+)>/', function ( $match ) use(&$links) {
            return $links[$match[1] - 1];
        }, $value );
    }

}
if ( !function_exists( 'efbl_get_page_logo' ) ) {
    function efbl_get_page_logo(  $page_id = null  ) {
        if ( $page_id ) {
            $page_logo_trasneint_name = 'esf_logo_' . $page_id;
            $auth_img_src = get_transient( $page_logo_trasneint_name );
            $check_status = wp_remote_retrieve_body( wp_remote_get( $auth_img_src ) );
            if ( $check_status == 'URL signature expired' ) {
                $auth_img_src = '';
            }
            if ( $auth_img_src && !empty( $auth_img_src ) && !isset( $auth_img_src->error ) ) {
                return $auth_img_src;
            } else {
                $FTA = new Feed_Them_All();
                $fta_settings = $FTA->fta_get_settings();
                if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) || isset( $fta_settings['plugins']['facebook']['approved_groups'] ) ) {
                    $pages = $fta_settings['plugins']['facebook']['approved_pages'];
                    if ( isset( $pages[$page_id] ) ) {
                        $page_exists = $pages[$page_id];
                    } else {
                        $page_exists = '';
                    }
                    if ( $page_exists ) {
                        $accesstoken = $pages[$page_id]['access_token'];
                    } else {
                        $accesstoken = $fta_settings['plugins']['facebook']['access_token'];
                    }
                    $auth_img_src = 'https://graph.facebook.com/' . $page_id . '/picture?type=large&redirect=0&access_token=' . $accesstoken;
                    $auth_img_src = json_decode( jws_fetchUrl( $auth_img_src ) );
                    if ( isset( $auth_img_src->data->url ) && !isset( $auth_img_src->error ) ) {
                        $auth_img_src = $auth_img_src->data->url;
                        //Store in a transient for 1 month
                        set_transient( $page_logo_trasneint_name, $auth_img_src, 30 * 60 * 60 * 24 );
                        return $auth_img_src;
                    }
                }
            }
        } else {
            return __( 'Invalid page ID', 'easy-facebook-likebox' );
        }
    }

}
/*
* Return Default page ID
*/
if ( !function_exists( 'efbl_default_page_id' ) ) {
    function efbl_default_page_id() {
        $efbl_default_page_id = '';
        $FTA = new Feed_Them_All();
        $fta_settings = $FTA->fta_get_settings();
        if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
            $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
            if ( $approved_pages ) {
                foreach ( $approved_pages as $approved_page ) {
                    if ( isset( $approved_page['username'] ) ) {
                        $efbl_default_page_id = $approved_page['username'];
                    } else {
                        $efbl_default_page_id = $approved_page['id'];
                    }
                }
            }
        }
        return $efbl_default_page_id;
    }

}
/*
* Return Default skin ID
*/
if ( !function_exists( 'efbl_default_skin_id' ) ) {
    function efbl_default_skin_id() {
        $efbl_default_skin_id = '';
        $FTA = new Feed_Them_All();
        $fta_settings = $FTA->fta_get_settings();
        if ( isset( $fta_settings['plugins']['facebook']['default_skin_id'] ) && !empty( $fta_settings['plugins']['facebook']['default_skin_id'] ) ) {
            $efbl_default_skin_id = $fta_settings['plugins']['facebook']['default_skin_id'];
        }
        return $efbl_default_skin_id;
    }

}
if ( !function_exists( 'efbl_demo_page_id' ) ) {
    /**
     * Get Customizer demo page ID
     *
     * @return mixed|string
     * @since 6.2.0
     */
    function efbl_demo_page_id() {
        $efbl_demo_page_id = '';
        $FTA = new Feed_Them_All();
        $fta_settings = $FTA->fta_get_settings();
        if ( isset( $fta_settings['plugins']['facebook']['default_page_id'] ) && !empty( $fta_settings['plugins']['facebook']['default_page_id'] ) ) {
            $efbl_demo_page_id = $fta_settings['plugins']['facebook']['default_page_id'];
        }
        return $efbl_demo_page_id;
    }

}
if ( !function_exists( 'efbl_get_cache_seconds' ) ) {
    /**
     * Convert cache time span into seconds
     * @param $instance
     *
     * @since 6.2.0
     *
     * @return false|float|int
     */
    function efbl_get_cache_seconds(  $instance  ) {
        if ( !isset( $instance ) && !is_array( $instance ) ) {
            return false;
        }
        if ( !isset( $instance['cache_unit'] ) || $instance['cache_unit'] < 1 ) {
            $cache_unit = 1;
        } else {
            $cache_unit = $instance['cache_unit'];
        }
        $cache_duration = 60 * 60 * 24;
        //Calculate the cache time in seconds
        if ( $instance['cache_duration'] == 'minutes' || $instance['cache_duration'] == 'minute' ) {
            $cache_duration = 60;
        }
        if ( $instance['cache_duration'] == 'hours' || $instance['cache_duration'] == 'hour' ) {
            $cache_duration = 60 * 60;
        }
        if ( $instance['cache_duration'] == 'days' || $instance['cache_duration'] == 'day' ) {
            $cache_duration = 60 * 60 * 24;
        }
        $cache_seconds = $cache_duration * $cache_unit;
        return $cache_seconds;
    }

}
if ( !function_exists( 'efbl_get_page_username' ) ) {
    /**
     * Get username of the page if it's numeric
     * @param $page_id
     *
     *  @since 6.2.0
     *
     * @return false|float|int
     */
    function efbl_get_page_username(  $page_id  ) {
        if ( !isset( $page_id ) && empty( $page_id ) ) {
            return false;
        }
        $FTA = new Feed_Them_All();
        $fta_settings = $FTA->fta_get_settings();
        if ( !isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
            return false;
        }
        $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
        if ( isset( $approved_pages[$page_id]['username'] ) && !empty( $approved_pages[$page_id]['username'] ) ) {
            $page_username = $approved_pages[$page_id]['username'];
        } else {
            $page_username = $page_id;
        }
        return $page_username;
    }

}
if ( !function_exists( 'efbl_get_page_id' ) ) {
    /**
     * Get page ID of the page
     * @param $page_id
     *
     *  @since 6.2.0
     *
     * @return false|float|int
     */
    function efbl_get_page_id(  $page_id  ) {
        if ( !isset( $page_id ) && empty( $page_id ) ) {
            return false;
        }
        $FTA = new Feed_Them_All();
        $fta_settings = $FTA->fta_get_settings();
        if ( !isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && empty( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
            return false;
        }
        $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
        foreach ( $approved_pages as $key => $value ) {
            if ( $value['username'] == $page_id ) {
                $page_id = $key;
                break;
            }
        }
        return $page_id;
    }

}
if ( !function_exists( 'efbl_array_push_assoc' ) ) {
    /**
     * Push items in associative array
     * @param $array
     * @param $key
     * @param $value
     *
     * @since 6.2.0
     * @return mixed
     */
    function efbl_array_push_assoc(  $array, $key, $value  ) {
        $array[$key] = $value;
        return $array;
    }

}
if ( !function_exists( 'efbl_eventdate' ) ) {
    /**
     * Convert into real event date
     *
     * @param $original
     * @param $date_format
     * @param $custom_date
     *
     * @since 6.2.0
     *
     * @return string
     */
    function efbl_eventdate(  $original, $date_format, $custom_date  ) {
        switch ( $date_format ) {
            case '2':
                $print = date_i18n( '<k>F jS, </k>g:ia', $original );
                break;
            case '3':
                $print = date_i18n( 'g:ia<k> - F jS</k>', $original );
                break;
            case '4':
                $print = date_i18n( 'g:ia<k>, F jS</k>', $original );
                break;
            case '5':
                $print = date_i18n( '<k>l F jS - </k> g:ia', $original );
                break;
            case '6':
                $print = date_i18n( '<k>D M jS, Y, </k>g:iA', $original );
                break;
            case '7':
                $print = date_i18n( '<k>l F jS, Y, </k>g:iA', $original );
                break;
            case '8':
                $print = date_i18n( '<k>l F jS, Y - </k>g:ia', $original );
                break;
            case '9':
                $print = date_i18n( "<k>l M jS, 'y</k>", $original );
                break;
            case '10':
                $print = date_i18n( '<k>m.d.y - </k>g:iA', $original );
                break;
            case '11':
                $print = date_i18n( '<k>m/d/y, </k>g:ia', $original );
                break;
            case '12':
                $print = date_i18n( '<k>d.m.y - </k>g:iA', $original );
                break;
            case '13':
                $print = date_i18n( '<k>d/m/y, </k>g:ia', $original );
                break;
            case '14':
                $print = date_i18n( '<k>M j, </k>g:ia', $original );
                break;
            case '15':
                $print = date_i18n( '<k>M j, </k>G:i', $original );
                break;
            case '16':
                $print = date_i18n( '<k>d-m-Y, </k>G:i', $original );
                break;
            case '17':
                $print = date_i18n( '<k>jS F Y, </k>G:i', $original );
                break;
            case '18':
                $print = date_i18n( '<k>d M Y, </k>G:i', $original );
                break;
            case '19':
                $print = date_i18n( '<k>l jS F Y, </k>G:i', $original );
                break;
            case '20':
                $print = date_i18n( '<k>m.d.y - </k>G:i', $original );
                break;
            case '21':
                $print = date_i18n( '<k>d.m.y - </k>G:i', $original );
                break;
            default:
                $print = date_i18n( '<k>F j, Y, </k>g:ia', $original );
                break;
        }
        if ( !empty( $custom_date ) ) {
            $print = date_i18n( $custom_date, $original );
        }
        return $print;
    }

}
if ( !function_exists( 'efbl_get_albums_list' ) ) {
    function efbl_get_albums_list(  $page_id = ''  ) {
        if ( !$page_id ) {
            return false;
        }
    }

}
if ( !function_exists( 'efbl_get_group_bio' ) ) {
    /**
     * Get group bio
     * @param $id
     * @param $cache_seconds
     *
     * @return mixed
     */
    function efbl_get_group_bio(  $id, $cache_seconds  ) {
        $efbl_bio_data = array();
        $accesstoken = '';
        $efbl_bio_slug = "efbl_group_bio-{$id}";
        $efbl_bio_data = get_transient( $efbl_bio_slug );
        if ( !$efbl_bio_data || '' == $efbl_bio_data ) {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
                $pages = $fta_settings['plugins']['facebook']['approved_pages'];
                $accesstoken = $fta_settings['plugins']['facebook']['access_token'];
            }
            $efbl_bio_url = "https://graph.facebook.com/{$id}?fields=member_count,description,name,link,picture&access_token=" . $accesstoken;
            $efbl_bio_data_api = wp_remote_get( $efbl_bio_url );
            if ( isset( $efbl_bio_data_api ) && !empty( $efbl_bio_data_api ) ) {
                if ( isset( $efbl_bio_data_api['body'] ) ) {
                    $efbl_bio_data = json_decode( $efbl_bio_data_api['body'] );
                }
            }
            if ( 200 == $efbl_bio_data_api['response']['code'] && !empty( $efbl_bio_data ) ) {
                set_transient( $efbl_bio_slug, $efbl_bio_data, $cache_seconds );
            }
        }
        return $efbl_bio_data;
    }

}