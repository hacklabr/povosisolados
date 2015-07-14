<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
<!-- cookie conset latest version -->
<script type="text/javascript" src="https://s3-eu-west-1.amazonaws.com/assets.cookieconsent.silktide.com/current/plugin.min.js"></script>

<script type="text/javascript">
// <![CDATA[
cc.initialise({
	cookies: {
		social: {}
	},
	settings: {
	    bannerPosition: <?php echo '"'.get_theme_mod('quark_cookie_banner_placement','bottom').'"'; ?>,
	    consenttype: <?php echo '"'.get_theme_mod('quark_cookie_mode','explicit').'"'; ?>,
	    onlyshowbanneronce: false,
	    style: <?php echo '"light"'; ?>,
	    refreshOnConsent: <?php if(get_theme_mod('quark_cookie_refresh', 0) == 1) : ?>true<?php else : ?>false<?php endif; ?>,
	    useSSL: <?php if(get_theme_mod('quark_cookie_ssl', 1) == 1) : ?>true<?php else : ?>false<?php endif; ?>,
	    tagPosition: <?php echo '"'.get_theme_mod('quark_cookie_tag_placement','bottom-right').'"'; ?>
	},
	strings: {
                socialDefaultTitle: '<?php echo __('Social Media', 'quark'); ?>',
                socialDefaultDescription: '<?php echo __('Facebook, Twitter and other social websites need to know who you are to work properly.', 'quark'); ?>',
                analyticsDefaultTitle: '<?php echo __('Analytics'); ?>',
                analyticsDefaultDescription: '<?php echo __('We anonymously measure your use of this website to improve your experience.', 'quark'); ?>',
                advertisingDefaultTitle: '<?php echo __('Advertising', 'quark'); ?>',
                advertisingDefaultDescription: '<?php echo __('Adverts will be chosen for you automatically based on your past behaviour and interests.', 'quark'); ?>',
                defaultTitle: '<?php echo __('Default cookie title', 'quark'); ?>',
                defaultDescription: '<?php echo __('Default cookie description', 'quark'); ?>',
                learnMore: '<?php echo __('Learn More', 'quark'); ?>',
                closeWindow: '<?php echo __('Close window', 'quark'); ?>',
                notificationTitle: '<?php echo __('Your experience on this site will be improved by allowing cookies', 'quark'); ?>',
                notificationTitleImplicit: '<?php echo __('We use cookies to ensure you get the best experience on our website', 'quark'); ?>',
                customCookie: '<?php echo __('This website uses a custom type of cookie which needs specific approval', 'quark'); ?>',
                seeDetails: '<?php echo __('see details', 'quark'); ?>',
                seeDetailsImplicit: '<?php echo __('change your settings', 'quark'); ?>',
                hideDetails: '<?php echo __('hide details', 'quark'); ?>',
                allowCookies: '<?php echo __('Allow cookies', 'quark'); ?>',
                allowCookiesImplicit: '<?php echo __('Close', 'quark'); ?>',
                allowForAllSites: '<?php echo __('Allow for all sites', 'quark'); ?>',
                savePreference: '<?php echo __('Save preference', 'quark'); ?>',
                saveForAllSites: '<?php echo __('Save for all sites', 'quark'); ?>',
                privacySettings: '<?php echo __('Privacy settings', 'quark'); ?>',
                privacySettingsDialogTitleA: '<?php echo __('Privacy settings', 'quark'); ?>',
                privacySettingsDialogTitleB: '<?php echo __('for this website', 'quark'); ?>',
                privacySettingsDialogSubtitle: '<?php echo __('Some features of this website need your consent to remember who you are.', 'quark'); ?>',
                changeForAllSitesLink: '<?php echo __('Change settings for all websites', 'quark'); ?>',
                preferenceUseGlobal: '<?php echo __('Use global setting', 'quark'); ?>',
                preferenceConsent: '<?php echo __('I consent', 'quark'); ?>',
                preferenceDecline: '<?php echo __('I decline', 'quark'); ?>',
                notUsingCookies: '<?php echo __('This website does not use any cookies.', 'quark'); ?>.',
                allSitesSettingsDialogTitleA: '<?php echo __('Privacy settings', 'quark'); ?>',
                allSitesSettingsDialogTitleB: '<?php echo __('for all websites', 'quark'); ?>',
                allSitesSettingsDialogSubtitle: '<?php echo __('You may consent to these cookies for all websites that use this plugin.', 'quark'); ?>',
                backToSiteSettings: '<?php echo __('Back to website settings', 'quark'); ?>',
                preferenceAsk: '<?php echo __('Ask me each time', 'quark'); ?>',
                preferenceAlways: '<?php echo __('Always allow', 'quark'); ?>',
                preferenceNever: '<?php echo __('Never allow', 'quark'); ?>'
 	}
});
// ]]>
</script>
<!-- End Cookie Consent plugin -->