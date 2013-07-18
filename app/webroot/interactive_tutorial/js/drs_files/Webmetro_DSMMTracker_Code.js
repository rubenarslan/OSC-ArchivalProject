
	var wm_NoInsertTimeDuration = 30;
	var dt = new Date("January 01, 1970 00:00:00");
	var wm_DSMM_lastClickTimeStamp = dt.getTime(); 
	var wm_DSMM_lastClickReferrer = "";
	var wm_DSMM_ClickReferrer = document.referrer;
	var wm_DSMM_ClickTimeStamp = wm_DSMM_GetTimeInMillisec();
	var wm_DSMM_NoTrack=false;


	if ((wm_DSMM_is1PCCookieEnabled) && (wm_DSMM_isTrackingEnabled))
	{
	

		if (document.referrer != null)
		{
					if (wm_DSMM_getCookie("wm_DSMM_TimeStamp_PPC") != null)
					{
						if (wm_DSMM_getCookie("wm_DSMM_TimeStamp_SEO") != null)
						{
							if ((wm_DSMM_getCookie("wm_DSMM_TimeStamp_PPC") - wm_DSMM_getCookie("wm_DSMM_TimeStamp_SEO"))>0)
							{
								wm_DSMM_lastClickTimeStamp = wm_DSMM_getCookie("wm_DSMM_TimeStamp_PPC");
								wm_DSMM_lastClickReferrer = wm_DSMM_getCookie("wm_DSMM_referrer_PPC");
							}
							else
							{
								wm_DSMM_lastClickTimeStamp = wm_DSMM_getCookie("wm_DSMM_TimeStamp_SEO");
								wm_DSMM_lastClickReferrer = wm_DSMM_getCookie("wm_DSMM_referrer_SEO");
								}
						}
						else
						{
								wm_DSMM_lastClickTimeStamp = wm_DSMM_getCookie("wm_DSMM_TimeStamp_PPC");
								wm_DSMM_lastClickReferrer = wm_DSMM_getCookie("wm_DSMM_referrer_PPC");
						}
					
					}
					else
					{
						if (wm_DSMM_getCookie("wm_DSMM_TimeStamp_SEO") != null)
						{
							   wm_DSMM_lastClickTimeStamp = wm_DSMM_getCookie("wm_DSMM_TimeStamp_SEO"); 
							   wm_DSMM_lastClickReferrer = wm_DSMM_getCookie("wm_DSMM_referrer_SEO");
						}
					}

				
				if (wm_DSMM_lastClickTimeStamp == null)
				{
					wm_DSMM_lastClickTimeStamp = 0;
				}

				if (wm_DSMM_lastClickReferrer == null)
				{
					wm_DSMM_lastClickReferrer = "";
				}
					
				if ((((wm_DSMM_ClickTimeStamp - wm_DSMM_lastClickTimeStamp)/1000) < wm_NoInsertTimeDuration) && (wm_DSMM_lastClickReferrer.replace(/\+/g, " ") == wm_DSMM_ClickReferrer.replace(/\+/g, " ")) )
				{
						wm_DSMM_NoTrack=true;

				}
		}
		


	}
	

	
if (!wm_DSMM_NoTrack)
{

	var wm_DSMM_ckid = wm_DSMM_GetTimeInMillisec();
		

// PPC Variables Initialization ******************
	var wm_DSMM_uri = location.search;
	var wm_DSMM_start = wm_DSMM_uri.indexOf("?");
	var wm_DSMM_param = wm_DSMM_uri.substring(wm_DSMM_start+1,wm_DSMM_uri.length);
	wm_DSMM_param = wm_DSMM_param.toLowerCase();
	var wm_DSMM_qs = new wm_DSMM_Querystring(wm_DSMM_param);
	var wm_DSMM_ctid = wm_DSMM_qs.get("wm_ctid");
	var wm_DSMM_kwid = wm_DSMM_qs.get("wm_kwid");
	var wm_DSMM_lpid = wm_DSMM_qs.get("wm_lpid");
	var wm_DSMM_crid = wm_DSMM_qs.get("wm_crid");

	var wm_DSMM_defaultURL = wm_DSMM_qs.get("wm_defaulturl");
    var wm_DSMM_serverredirect = wm_DSMM_qs.get("wm_sd");

    if (wm_DSMM_serverredirect != null)
    {
	    wm_DSMM_isPPCTrackingEnabled = false;
    }
	


	var wm_DSMM_mtid = wm_DSMM_qs.get("wm_mtid");
	var wm_DSMM_content = wm_DSMM_qs.get("wm_content");
	var wm_DSMM_landingPage_PPC = location;
	var wm_DSMM_referrer_PPC=document.referrer;
	var wm_DSMM_referrerDomain_PPC=wm_DSMM_getReferrerDomain(document.referrer);

	var wm_DSMM_venue_crid = '';
	var wm_DSMM_venue_id='';

	if (wm_DSMM_qs.get("wm_g_crid") != null)
	{
		wm_DSMM_venue_crid = wm_DSMM_qs.get("wm_g_crid")
		wm_DSMM_venue_id=1
	}
	else
	{
		if (wm_DSMM_qs.get("wm_m_crid") != null)
		{
			wm_DSMM_venue_crid = wm_DSMM_qs.get("wm_m_crid")
			wm_DSMM_venue_id=14
		}
	 	else
		{
			if (wm_DSMM_qs.get("wm_y_crid") != null)
			{
				wm_DSMM_venue_crid = wm_DSMM_qs.get("wm_y_crid")
				wm_DSMM_venue_id=25
			}
		}
	}

	

// PPC Variables Initialization ******************


//	if ((wm_DSMM_is1PCCookieEnabled) || (wm_DSMM_isTrackingEnabled))
//	{
//		if (wm_DSMM_getCookie("wm_" + wm_DSMM_client) == null)
//		{
//		    wm_DSMM_setCookie("wm_" + wm_DSMM_client, wm_DSMM_ckid, wm_DSMM_1PCCookieExpirationPeriod);
			
//			if (wm_DSMM_getCookie("wm_" + wm_DSMM_client) == null)
//			{
//				wm_DSMM_ckid = null;
//			}
//		}
//		else
//		{
//			wm_DSMM_ckid = wm_DSMM_getCookie("wm_" + wm_DSMM_client);
			
//		}
//	}



	if ((wm_DSMM_isPPCTrackingEnabled) && (wm_DSMM_isTrackingEnabled)) 
	{
		if (wm_DSMM_ctid > 0) 
		{
			
			if (wm_DSMM_content == 1)
			{
				wm_DSMM_mtid = 4;
			}
		
            		var wm_DSMM_src_PPC = wm_DSMM_DSMMTracker_Path + "click.asp?wm_DSMM_client="+wm_DSMM_client+"&wm_DSMM_ckid="+wm_DSMM_ckid+"&wm_DSMM_ctid_PPC="+wm_DSMM_ctid+"&wm_DSMM_kwid_PPC="+wm_DSMM_kwid+"&wm_DSMM_referrer_PPC="+escape(wm_DSMM_referrer_PPC)+"&wm_DSMM_referrerDomain_PPC="+wm_DSMM_referrerDomain_PPC+"&wm_DSMM_lpid_PPC="+wm_DSMM_lpid+"&wm_DSMM_crid_PPC="+wm_DSMM_crid+"&wm_DSMM_venue_crid_PPC="+wm_DSMM_venue_crid+"&wm_DSMM_venue_id_PPC="+wm_DSMM_venue_id+"&wm_DSMM_defaultURL_PPC="+escape(wm_DSMM_defaultURL)+"&wm_DSMM_serverredirect_PPC="+wm_DSMM_serverredirect+"&wm_DSMM_mtid_PPC="+wm_DSMM_mtid+"&wm_DSMM_content_PPC="+wm_DSMM_content+"&wm_DSMM_landingPage_PPC="+escape(wm_DSMM_landingPage_PPC)+"&wm_DSMM_SEMType="+wm_DSMM_SEM_PPC+"&wm_DSMM_CookieTypeUsed="+wm_DSMM_CookieTypeUsed+"&wm_DSMM_CookieExpirationPeriod="+wm_DSMM_3PCCookieExpirationPeriod;

			// 1st Party Cookie - PPC Tracking *************************************
	
			if (wm_DSMM_is1PCCookieEnabled)
			{
			    wm_DSMM_setCookie("wm_DSMM_ctid_PPC", wm_DSMM_ctid, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_kwid_PPC", wm_DSMM_kwid, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_crid_PPC", wm_DSMM_crid, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_venue_crid_PPC", wm_DSMM_venue_crid, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_venue_id_PPC", wm_DSMM_venue_id, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_defaultURL_PPC", wm_DSMM_defaultURL, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_serverredirect_PPC", wm_DSMM_serverredirect, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_lpid_PPC", wm_DSMM_lpid, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_mtid_PPC", wm_DSMM_mtid, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_referrer_PPC", wm_DSMM_referrer_PPC, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_referrerDomain_PPC", wm_DSMM_referrerDomain_PPC, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_landingPage_PPC", wm_DSMM_landingPage_PPC, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_cookieType_PPC", wm_DSMM_1PCCookie, wm_DSMM_1PCCookieExpirationPeriod);
			    wm_DSMM_setCookie("wm_DSMM_TimeStamp_PPC", wm_DSMM_ClickTimeStamp, wm_DSMM_1PCCookieExpirationPeriod);


				//	wm_DSMM_setCookie("wm_DSMM_FirstClicked_PPC",wm_DSMM_FirstClicked_PPC);
				wm_DSMM_src_PPC = wm_DSMM_src_PPC + "&wm_DSMM_is1PCCookieEnabled="+wm_DSMM_is1PCCookieEnabled;
			}
		// 1st Party Cookie - PPC Tracking *************************************

		// 3rd Party Cookie - PPC Tracking *************************************
			if (wm_DSMM_is3PCCookieEnabled)
			{
				wm_DSMM_src_PPC = wm_DSMM_src_PPC + "&wm_DSMM_is3PCCookieEnabled="+wm_DSMM_is3PCCookieEnabled;
				
			}
		// 3rd Party Cookie - PPC Tracking *************************************
			if ((wm_DSMM_is1PCCookieEnabled) || (wm_DSMM_is3PCCookieEnabled))
			{
				if (location.search.indexOf("wm_debug=true") > -1)
				{		
					window.open(wm_DSMM_src_PPC,'PPC_DSMM','location=yes'); 
				}
				else
				{
					var wm_TrackingPixel_Click_PPC= new Image();
					wm_TrackingPixel_Click_PPC.src= wm_DSMM_src_PPC;
				}
			}			
		}
	}	
 

// SEO Variables Initialization ******************		
	var wm_DSMM_referrerDomain_SEO=wm_DSMM_getReferrerDomain(document.referrer);
	wm_DSMM_referrerDomain_SEO=wm_DSMM_referrerDomain_SEO.toLowerCase();
	var wm_DSMM_google = wm_DSMM_referrerDomain_SEO.match(/google./g);
	var wm_DSMM_yahoo = wm_DSMM_referrerDomain_SEO.match(/search.yahoo.com/g);
	var wm_DSMM_msn = wm_DSMM_referrerDomain_SEO.match(/bing./g);
	var wm_DSMM_aol = wm_DSMM_referrerDomain_SEO.match(/aol.com/g);
	var wm_DSMM_ask = wm_DSMM_referrerDomain_SEO.match(/askjeeves.com/g);
	var wm_DSMM_net = wm_DSMM_referrerDomain_SEO.match(/netscape.com/g);
	var wm_DSMM_search = wm_DSMM_referrerDomain_SEO.match(/search.com/g);
	var wm_DSMM_url=location.search;
	wm_DSMM_url = wm_DSMM_url.toLowerCase();
	var wm_DSMM_match=wm_DSMM_url.match(/wm_ctid=/g);
	var wm_DSMM_seodebug = wm_DSMM_url.match(/wm_dsmm_seodebug=/g); 
	var wm_DSMM_landingPage_SEO = location;
	var wm_DSMM_referrer_SEO=document.referrer;
// SEO Variables Initialization ******************

	var ar_wm_DSMM_excluded_SEODomains = new Array("mail.google.com", "webmail.aol.com");
	var IsExcludedDomain = false;

	for (var i = 0; i < ar_wm_DSMM_excluded_SEODomains.length; i++) 
	{
	    if (wm_DSMM_referrerDomain_SEO.indexOf(ar_wm_DSMM_excluded_SEODomains[i]) > -1) 
	    {
	        IsExcludedDomain = true;
	    }
	}

	if (!IsExcludedDomain)
	{
	

		if ((wm_DSMM_isSEOTrackingEnabled) && (wm_DSMM_isTrackingEnabled)) 
		{
    		
		    if ((wm_DSMM_seodebug || wm_DSMM_google || wm_DSMM_yahoo || wm_DSMM_msn || wm_DSMM_aol || wm_DSMM_ask || wm_DSMM_net || wm_DSMM_search) && (!wm_DSMM_match))
		    {
    			

			    var wm_DSMM_src_SEO=wm_DSMM_DSMMTracker_Path + "click.asp?wm_DSMM_client="+ wm_DSMM_client+"&wm_DSMM_ckid="+wm_DSMM_ckid+"&wm_DSMM_landingPage_SEO="+escape(wm_DSMM_landingPage_SEO)+"&wm_DSMM_referrer_SEO="+escape(wm_DSMM_referrer_SEO)+"&wm_DSMM_referrerDomain_SEO="+wm_DSMM_referrerDomain_SEO+"&wm_DSMM_SEMType="+wm_DSMM_SEM_SEO+"&wm_DSMM_CookieTypeUsed="+wm_DSMM_CookieTypeUsed+"&wm_DSMM_CookieExpirationPeriod="+wm_DSMM_3PCCookieExpirationPeriod;
    			
			    // 1st Party Cookie - SEO Tracking *************************************

			    if (wm_DSMM_is1PCCookieEnabled)
			    {
			        wm_DSMM_setCookie("wm_DSMM_referrer_SEO", wm_DSMM_referrer_SEO, wm_DSMM_1PCCookieExpirationPeriod);
			        wm_DSMM_setCookie("wm_DSMM_referrerDomain_SEO", wm_DSMM_referrerDomain_SEO, wm_DSMM_1PCCookieExpirationPeriod);
			        wm_DSMM_setCookie("wm_DSMM_landingPage_SEO", wm_DSMM_landingPage_SEO, wm_DSMM_1PCCookieExpirationPeriod);
			        wm_DSMM_setCookie("wm_DSMM_cookieType_SEO", wm_DSMM_1PCCookie, wm_DSMM_1PCCookieExpirationPeriod);
			        wm_DSMM_setCookie("wm_DSMM_TimeStamp_SEO", wm_DSMM_ClickTimeStamp, wm_DSMM_1PCCookieExpirationPeriod);


				    //	wm_DSMM_setCookie("wm_DSMM_FirstClicked_PPC",wm_DSMM_FirstClicked_PPC);
				    wm_DSMM_src_SEO = wm_DSMM_src_SEO + "&wm_DSMM_is1PCCookieEnabled="+wm_DSMM_is1PCCookieEnabled;
			    }
			    // 1st Party Cookie - SEO Tracking *************************************

			    // 3rd Party Cookie - SEO Tracking *************************************
			    if (wm_DSMM_is3PCCookieEnabled)
			    {
				    wm_DSMM_src_SEO = wm_DSMM_src_SEO + "&wm_DSMM_is3PCCookieEnabled="+wm_DSMM_is3PCCookieEnabled;
			    }
			    // 3rd Party Cookie - SEO Tracking *************************************

			    if ((wm_DSMM_is1PCCookieEnabled) || (wm_DSMM_is3PCCookieEnabled))
			    {


    			


				    if (location.search.indexOf("wm_debug=true") > -1)
				    {		
					    window.open(wm_DSMM_src_SEO,'SEO_DSMM','location=yes'); 
				    }
				    else
				    {
					    var wm_TrackingPixel_Click_SEO= new Image();
					    wm_TrackingPixel_Click_SEO.src= wm_DSMM_src_SEO;
				    }
			    }
    			
		    }
        }

	}
}