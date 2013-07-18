


// Utlities ************************************************************


function wm_DSMM_setCookie(name, value, expires, path, domain, secure)
{
	var exdate=new Date();
	
	if (expires == null)
	{
		exdate.setTime(exdate.getTime()+(90*24*3600*1000));
	}
	else
	{
		exdate.setTime(exdate.getTime()+(expires*24*3600*1000))
	}
    document.cookie= name + "=" + escape(value) +
        "; expires=" + exdate +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function wm_DSMM_getCookie(name)
{
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1)
    {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
    }
    var end = document.cookie.indexOf(";", begin);
    if (end == -1)
    {
        end = dc.length;
    }
    return unescape(dc.substring(begin + prefix.length, end));
}

function wm_DSMM_deleteCookie(name, path, domain)
{
    if (wm_DSMM_getCookie(name))
    {
        document.cookie = name + "=" + 
            ((path) ? "; path=" + path : "") +
            ((domain) ? "; domain=" + domain : "") +
            "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}

function wm_DSMM_GetTimeInMillisec()
{
    var wm_DSMM_Now = new Date();
    var wm_DSMM_TimeStamp = wm_DSMM_Now.getTime();
	return wm_DSMM_TimeStamp;
}

function wm_DSMM_Querystring(wm_DSMM_qs_local) { // optionally pass a querystring to parse
	this.wm_DSMM_params = new Object()
	this.get=wm_DSMM_Querystring_get

	if (wm_DSMM_qs_local == null)
		wm_DSMM_qs_local=location.search.substring(1,location.search.length)

	if (wm_DSMM_qs_local.length == 0) return

// Turn <plus> back to <space>
// See: http://www.w3.org/TR/REC-html40/interact/forms.html#h-17.13.4.1
	wm_DSMM_qs_local = wm_DSMM_qs_local.replace(/\+/i, ' ')
	var wm_DSMM_args = wm_DSMM_qs_local.split('&') // parse out name/value pairs separated via &

// split out each name=value pair
	for (var wm_DSMM_i=0;wm_DSMM_i<wm_DSMM_args.length;wm_DSMM_i++) {
		var wm_DSMM_value;
		var wm_DSMM_pair = wm_DSMM_args[wm_DSMM_i].split('=')
		var wm_DSMM_name = unescape(wm_DSMM_pair[0])
		if (wm_DSMM_pair.length == 2)
			wm_DSMM_value = unescape(wm_DSMM_pair[1])
		else
			wm_DSMM_value = wm_DSMM_name
		
		this.wm_DSMM_params[wm_DSMM_name] = wm_DSMM_value
	}
}

function wm_DSMM_Querystring_get(wm_DSMM_key, wm_DSMM_default_) {
	// This silly looking line changes UNDEFINED to NULL
	if (wm_DSMM_default_ == null) wm_DSMM_default_ = null;
	
	var wm_DSMM_value=this.wm_DSMM_params[wm_DSMM_key]
	if (wm_DSMM_value==null) wm_DSMM_value=wm_DSMM_default_;
	
	return wm_DSMM_value
}

function wm_DSMM_getReferrerDomain(wm_DSMM_strUrl) {
	if (wm_DSMM_strUrl == "")
	{
		return "";
	}
	var wm_DSMM_domain = wm_DSMM_strUrl.match( /:\/\/(www\.)?([^\/:]+)/ ); 
	
	if ((wm_DSMM_domain == null) || (wm_DSMM_domain == ""))
	{
		return "";
	}
	
	if ((wm_DSMM_domain[2] == null) || (wm_DSMM_domain[2] == ""))
	{
		return "";
	}
	
	return wm_DSMM_domain[2];
}

function wm_DSMM_getReferrerDomain_NotUsed(wm_DSMM_strUrl) {
	if (wm_DSMM_strUrl.indexOf("?") > -1)
	{
		wm_DSMM_strUrl = wm_DSMM_strUrl.substring(0,wm_DSMM_strUrl.indexOf("?"));	
	}
    var wm_DSMM_e=/^((http|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+\.[^#?\s]+)(#[\w\-]+)?$/;
    if (wm_DSMM_strUrl.match(wm_DSMM_e)) 
    {
		return RegExp.$3;
    }
	else
	{
		return "";
	}
}

function wm_DSMM_TrackConversion(wm_DSMM_OrderID, wm_DSMM_Revenue, wm_DSMM_ConversionType)
{

    var wm_ConversionURL = window.location.href;
    var wm_ConversionReferrerURL = document.referrer;

    var wm_DSMM_src_Conversion = wm_DSMM_DSMMTracker_Path + "conversion.asp?wm_DSMM_client=" + wm_DSMM_client + "&wm_DSMM_ckid=" + wm_DSMM_getCookie("wm_" + wm_DSMM_client) + "&wm_DSMM_ctid_PPC=" + wm_DSMM_getCookie("wm_DSMM_ctid_PPC") + "&wm_DSMM_kwid_PPC=" + wm_DSMM_getCookie("wm_DSMM_kwid_PPC") + "&wm_DSMM_referrer_PPC=" + escape(wm_DSMM_getCookie("wm_DSMM_referrer_PPC")) + "&wm_DSMM_referrerDomain_PPC=" + wm_DSMM_getCookie("wm_DSMM_referrerDomain_PPC") + "&wm_DSMM_lpid_PPC=" + wm_DSMM_getCookie("wm_DSMM_lpid_PPC") + "&wm_DSMM_crid_PPC=" + wm_DSMM_getCookie("wm_DSMM_crid_PPC") + "&wm_DSMM_venue_crid_PPC=" + wm_DSMM_getCookie("wm_DSMM_venue_crid_PPC") + "&wm_DSMM_venue_id_PPC=" + wm_DSMM_getCookie("wm_DSMM_venue_id_PPC") + "&wm_DSMM_defaultURL_PPC=" + wm_DSMM_getCookie("wm_DSMM_defaultURL_PPC") + "&wm_DSMM_serverredirect_PPC=" + wm_DSMM_getCookie("wm_DSMM_serverredirect_PPC") + "&wm_DSMM_mtid_PPC=" + wm_DSMM_getCookie("wm_DSMM_mtid_PPC") + "&wm_DSMM_landingPage_PPC=" + escape(wm_DSMM_getCookie("wm_DSMM_landingPage_PPC")) + "&wm_DSMM_landingPage_SEO=" + escape(wm_DSMM_getCookie("wm_DSMM_landingPage_SEO")) + "&wm_DSMM_referrer_SEO=" + wm_DSMM_getCookie("wm_DSMM_referrer_SEO") + "&wm_DSMM_referrerDomain_SEO=" + wm_DSMM_getCookie("wm_DSMM_referrerDomain_SEO") + "&wm_DSMM_orderID=" + wm_DSMM_OrderID + "&wm_DSMM_Revenue=" + wm_DSMM_Revenue + "&wm_DSMM_ConversionType=" + wm_DSMM_ConversionType + "&wm_DSMM_TrackAllConversions=" + wm_DSMM_TrackAllConversions + "&wm_DSMM_CookieTypeUsed=" + wm_DSMM_CookieTypeUsed + "&wm_DSMM_ConversionPage=" + escape(wm_ConversionURL) + "&wm_DSMM_ConversionReferrerPage=" + escape(wm_ConversionReferrerURL);

	if (location.search.indexOf("wm_debug=true") > -1)
	{		
		window.open(wm_DSMM_src_Conversion,'Conversion_DSMM','location=yes'); 
	}
	else
	{
		//var scriptBlock = wm_DSMM_GetTrackConversionScriptBlock();
		//if (scriptBlock != null)
		//{
		//	var p = document.createElement("script");
	
		//	p.setAttribute("type","text/javascript");
	
		//	p.setAttribute("src",wm_DSMM_src_Conversion);
	
		//	if (scriptBlock.parentNode != null)
		//	{
	    //		scriptBlock.parentNode.appendChild(p);	
		//		return;					
		//	}	
		//}
	
		//document.write('<img src="' + wm_DSMM_src_Conversion + '" height=1 width=1 ' + ' >');


		var wm_TrackingPixel_Conversion= new Image();
		wm_TrackingPixel_Conversion.src = wm_DSMM_src_Conversion;

		
		
	}
	
}

// Utlities ************************************************************

// finds the script block in the document which contains the call to
// the wm_DSMM_TrackConversion function and returns that script block
function wm_DSMM_GetTrackConversionScriptBlock()
{
	var scriptBlocks;
	// note that getElementsByTagName is NOT case sensitive
	scriptBlocks = document.getElementsByTagName("script");
	if (scriptBlocks != null)
	{
		if (scriptBlocks.length > 0)
		{
			var blockCounter = 0;
			
			for (blockCounter=0; blockCounter < scriptBlocks.length; blockCounter++)
			{
				if (scriptBlocks[blockCounter].text.indexOf("wm_DSMM_TrackConversion") > 0)
				{
					return scriptBlocks[blockCounter];
				}
			}
		}
	}
	
	return null;
}
