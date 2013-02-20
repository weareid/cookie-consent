<?php
/**
 * @package Entries
 */
/*
Plugin Name: Cookie Consent
Plugin URI: http://interactivedimension.com
Description: Cookie Consent
Version: 0.9
Author: @weareid
Author URI: http://interactivedimension.com
*/

//first things first lets fix badly executed Jquery script enqueing
function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
add_action('wp_enqueue_scripts', 'my_scripts_method');

function cookie_consent_head() { 
?>
<script src="/wp-content/plugins/cookie-consent/js/jquery.cookie.js"></script>
<script type="text/javascript">
$(document).ready(function() {

if ($.cookie("cookie_consent") == "1") 
    {
        $('#cookie').hide();
    }else {
		
		//transition effect		
		$('#cookie').slideDown(1000);			
	
	//if close button is clicked
	$('.accept').click(function (e) {

		//Cancel the link behavior
		e.preventDefault();
		
		$('#cookie').hide();
	});		
	
    //if settings button is clicked
	$('.edit').click(function (e) {

		//Cancel the link behavior
		e.preventDefault();
		
		$('.cookie_settings').slideDown(1000);

	});	
	
	//if settings button is clicked
	$('.store').click(function (e) {

		//Cancel the link behavior
		e.preventDefault();
		
		$('#cookie').hide();
	});	
	
	
	//settings
	
	if($.cookie('social_cookies') == 'disabled') {
		var addthis_config = {
            	data_track_clickback: false,
            	data_use_cookies:false,
            	data_use_flash:false
            }
	
	
		//click disabled
		$('input:radio[name=social_cookies]')[1].checked = true;
	} else {
		//click enabled
		$('input:radio[name=social_cookies]')[0].checked = true;
	}
	if($.cookie('google_cookies') == 'disabled') {
		//click disabled
		$('input:radio[name=google_cookies]')[1].checked = true;
	} else {
		//click enabled
		$('input:radio[name=google_cookies]')[0].checked = true;
	}
	
	$("input:radio").click(function() {
		//alert('you clicked a radio button');
		
		
		var socialCookies = $('input[name=social_cookies]');
        var state = socialCookies.filter(':checked').val(); 
        
        if(state == 'enabled') {
        	$.cookie('social_cookies', 'enabled', { expires: 365, path: "/"});
        } else {
        	$.cookie('social_cookies', 'disabled', { expires: 365, path: "/"});
        	
        	
        }
        
        var googleCookies = $('input[name=google_cookies]');
        var state = googleCookies.filter(':checked').val(); 
        
        if(state == 'enabled') {
        	$.cookie('google_cookies', 'enabled', { expires: 365, path: "/"});
        } else {
        	$.cookie('google_cookies', 'disabled', { expires: 365, path: "/"});
        }
		
	});
			
}
		
	//Only show the cookie banner once on initial site visit regardless.
	//Set the Cookie
      $.cookie('cookie_consent', '1', { expires: 365, path: "/"});
    //initial cookie settings
    if($.cookie('social_cookies') === null) { 
    	$.cookie('social_cookies', 'enabled', {expires:365, path:'/'});
    }
    if($.cookie('google_cookies') === null) { 
    	$.cookie('google_cookies', 'enabled', {expires:365, path:'/'});
    }
	
});
</script>

<style type="text/css">
#cookie {
    width:100%;
    z-index:9000;
    background-color:#efefef;
    margin: 0 0 20px 0;
}

.cookie_content {
    width: 1000px;
    margin: 0 auto;
    padding: 20px 0 0 0;
}

.cookie_content p {
    float:left;
}

.cookie_content p.cookie_controls {
    float:right;
}

.cookie_content p.cookie_controls a {
    margin-left: 20px;
}

.cookie_settings {
    width: 1000px;
    margin: 0px auto;
    padding: 20px 0 20px 0;
    border-top: 1px dotted #666666;
    display:none;
}

.cookie_settings p.cookie_settings_more {
    float:left;
}

.cookie_settings p.cookie_settings_controls {
    float:right;
}

.cookie_settings p.cookie_setting_controls a {
    margin-left: 20px;
}

.close {
    background: #ffffff;
    margin: 0 auto;
    width: 1024px;
    padding: 20px 0 50px 0;
    text-align:left;
}

.close a {
    padding: 0 0 0 270px;
    text-decoration:none;
    color:#00AEDB;
    text-transform:uppercase;
}

.close a:hover {
    text-decoration:underline;
}
	
</style>

<?php }
add_action('wp_head', 'cookie_consent_head');

function cookie_consent_display() {
?>
<div id="cookie" class="clearfix">
    <div class="cookie_content clearfix">
        <p>This website uses cookies. By navigating around this site you concent to cookies being stored on your machine</p>
        <p class="cookie_controls"><a href="#" class="accept">Accept</a><a href="#" class="edit">Edit your cookies settings</a></p>
    </div>
    <div class="cookie_settings clearfix">
        <p>Cookies are small text files that are stored on your computer when visiting our website. We use two types of cookies on this website; Strictly necessary and performance cookies. We offer the user the ability to disable and performance (non-essential) cookie as described below.
        <h2>Strictly necessary <span>: Cookies that we believe are essential for the operation of the website.</span></h2>
        <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <th width="10%">Cookie</th>
                <th width="90%">Purpose</th>
            </tr>
            <tr>
                <td>Cookie Settings</td>
                <td>This cookie stores your cookie settings for your next visit to the website.</td>
            </tr>
            </tbody>
        </table>
        <h2>Performance cookies <span>: These cookies collect information to allow us to improve the website.</span></h2>
        <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <th width="10%">Cookie</th>
                <th width="25%">Description</th>
                <th width="35%">Purpose</th>
                <th width="30%">Enable/Disable</th>
            </tr>
            <tr>
                <td>loc<br>di/dt<br>uid/uit<br>ssc/uvc<br>__atuvc</td>
                <td>Add This cookies - these are only activated if you are logged into your social networks.</td>
                <td>These cookies are used to implement the Add This social media links. The cookie are used in recording user sharing and social activity including location information and updating media counts.</td>
                <td>
                	Enabled <input type="radio" name="social_cookies" value="enabled">
                    Disabled <input type="radio" name="social_cookies" value="disabled">
                </td>
            </tr>
            <tr>
                <td>__utma<br>__utmb<br>__utmc<br>__utmz<br>__utmv</td>
                <td>Google analytics cookies, visitor session, traffic sources &amp; navigation</td>
                <td>These cookies allow Us to record visitor trends over time. Google Analytics uses a cookie to help track which pages are accessed. The cookie contains no personally-identifiable information, but it does use Your computer's IP address to determine from where in the world You are accessing the Website and to track Your page visits within the Website.<p></p>
                    <p>Google stores the information collected by the cookie on servers in the United States. Google may also transfer this information to third-parties where required to do so by law, or where such third-parties process the information on Google's behalf</p></td>
                <td>
                	Enabled <input type="radio" name="google_cookies" value="enabled">
                    Disabled <input type="radio" name="google_cookies" value="disabled">
                </td>
            </tr>
            </tbody>
        </table>
        <p class="cookie_settings_more">For more information on how we use Cookies see our <a href="/cookies">Cookies Statement</a></p>
        <p class="cookie_settings_controls"> <a href="#" class="store">Accept and store my cookies settings</a></p>
    </div>
</div>

<?php }