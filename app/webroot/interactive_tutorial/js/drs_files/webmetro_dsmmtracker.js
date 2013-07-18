// ROITracking Code *********************************************

var client = "bcc";

// Client Specific Information *****************************************
var wm_DSMM_client = "Wellpoint2";
var wm_DSMM_is1PCCookieEnabled = false;
var wm_DSMM_is3PCCookieEnabled = true;
var wm_DSMM_isTrackingEnabled = true;
var wm_DSMM_isPPCTrackingEnabled = true;
var wm_DSMM_isSEOTrackingEnabled = true;
var wm_DSMM_TrackAllConversions = false;
var wm_DSMM_CookieTypeUsed = "3";
var wm_DSMM_DSMMTracker_Path = "//tracking.dsmmadvantage.com/DBScripts/";
var wm_DSMM_1PCCookie = "1";
var wm_DSMM_3PCCookie = "3";
var wm_DSMM_SEM_PPC = "1";
var wm_DSMM_SEM_SEO = "2";
var wm_DSMM_Click = "1";
var wm_DSMM_Conversion = "2";
var wm_DSMM_1PCCookieExpirationPeriod = 90;
var wm_DSMM_3PCCookieExpirationPeriod = 90;
// Client Specific Information *****************************************


function IncludeJavaScript(jsFile) {
    document.write('<scr' + 'ipt type="text/javascript" src="' + jsFile + '"></scr' + 'ipt>');
}

IncludeJavaScript('//tracking.dsmmadvantage.com/Clients/WellPoint2/Webmetro_DSMMTracker_Functions.js');
IncludeJavaScript('//tracking.dsmmadvantage.com/Clients/WellPoint2/Webmetro_DSMMTracker_Code.js');

// Conversion ID Format: PLATFORM-GROUP-PRODUCTLINE-CONVERSIONSTEP-BRAND-STATE
var conversionType = 1;
var URL = (location.href).toLowerCase();
var path = window.location.pathname.toLowerCase();
var host = window.location.host.toLowerCase();

var state = "";
if (!window.dsmmState) {
    state = getURLParam("state");
}
else {
    state = window.dsmmState;
}

var brand = "";
if (!window.dsmmBrand) {
    brand = getURLParam("brand");
}
else {
    brand = window.dsmmBrand;
}

var revenue = 0;
if (window.dsmmRevenue) {
    window.wm_dsmm_conversion_revenue = window.dsmmRevenue;
}
else if (window.wm_dsmm_conversion_revenue) {
}
else {
    wm_dsmm_conversion_revenue = 0;
}

// SECA URL parameter
var screenidtextfield = getURLParam("screenidtextfield");

//Connecture URL Parameters
var productline = getURLParam("productline");
var displayaction = getURLParam("displayaction");
var saveaction = getURLParam("saveaction");
var flow = getURLParam("flow");
var productlineid = getURLParam("productlineid");
var issenior = getURLParam("issenior");


var Match = 0;
var addEvent;

if (document.addEventListener) {
    addEvent = function (element, type, handler) {
        element.addEventListener(type, handler, false);
    };
} else if (document.attachEvent) {
    addEvent = function (element, type, handler) {
        element.attachEvent("on" + type, handler);
    };
} else {
    addEvent = new Function;
}

function getURLParam(strParamName) {
    var strReturn = "";
    var strHref = window.location.href;
    if (strHref.indexOf("?") > -1) {
        var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
        var aQueryString = strQueryString.split("&");
        for (var iParam = 0; iParam < aQueryString.length; iParam++) {
            if (aQueryString[iParam].indexOf(strParamName + "=") > -1) {
                var aParam = aQueryString[iParam].split("=");
                strReturn = aParam[1];
                break;
            }
        }
    }

    return strReturn;

}

function getConversionID(platform, group, productline, conversionstep, brand, state) {
    return platform + '-' + group + '-' + productline + '-' + conversionstep + '-' + brand + '-' + state;
    //return 'seca-test2';
}

function CallTrackingFunction() {
    wm_DSMM_TrackConversion(window.wm_dsmm_conversion_id, window.wm_dsmm_conversion_revenue, conversionType);
}

function LoadDSMMConversionScript(conversionID) {
    window.wm_dsmm_conversion_id = conversionID;
    addEvent(window, 'load', CallTrackingFunction);
}


// Added on 04/01/2011 for DART Tag 
// for Tonik Only
function CallDARTTag() {
    var iframe = document.createElement("iframe");
    iframe.width = "1";
    iframe.height = "1";
    iframe.scrolling = "no";
    iframe.style.marginheight = "0";
    iframe.style.marginwidth = "0";
    iframe.frameborder = "0";
    document.body.appendChild(iframe);
    iframe.src = window.wm_dsmm_dartscript;
}

function LoadDARTTag(statesDARTscript) {
    window.wm_dsmm_dartscript = statesDARTscript;
    addEvent(window, 'load', CallDARTTag);
}

//Added on 8/23 for Google PlanSaleConversion 
function CallGooglePlanSaleTag() {

    var image = new Image(1, 1);

    //image.src = "//www.googleadservices.com/pagead/conversion/1069530986/?value=500&amp;label=1uBCCK6yqQIQ6v7-_QM&amp;guid=ON&amp;script=0";
    image.src = "//www.googleadservices.com/pagead/conversion/1069530986/?value=500&label=1uBCCK6yqQIQ6v7-_QM&script=0";
    return;

}

function CallGooglePlanDirectAPPSaleTag() {

    var image = new Image(1, 1);

    //image.src = "//www.googleadservices.com/pagead/conversion/1020758503/?value=500&amp;label=5ijFCOGBoAIQ55Pe5gM&amp;guid=ON&amp;script=0";
    image.src = "//www.googleadservices.com/pagead/conversion/1020758503/?value=500&label=5ijFCOGBoAIQ55Pe5gM&script=0";
    return;

}

function CallMSNPlanDirectAPPSaleTag() {

    var image = new Image(1, 1);

    image.src = "//flex.atdmt.com/mstag/tag/5ba03bef-8cc0-443b-bff2-5513cb7555ab/conversion.html?cp=5050&dedup=1";
    return;

}



function LoadGooglePlanSaleTag() {
    addEvent(window, 'load', CallGooglePlanSaleTag);
}

function LoadGooglePlanDirectAPPSaleTag() {
    addEvent(window, 'load', CallGooglePlanDirectAPPSaleTag);
}

function LoadMSNPlanDirectAPPSaleTag() {
    addEvent(window, 'load', CallMSNPlanDirectAPPSaleTag);
}

//Added on 8/23 for Google Retargeting on PlanFinder (1-start) 
function CallGoogleRemarketingTag() {

    var image = new Image(1, 1);

    //image.src = "//www.googleadservices.com/pagead/conversion/1069530986/?label=Ck9NCLaxqQIQ6v7-_QM&amp;guid=ON&amp;script=0";
    image.src = "//www.googleadservices.com/pagead/conversion/1069530986/?label=Ck9NCLaxqQIQ6v7-_QM&script=0";
    return;

}

function LoadGoogleRemarketingTag() {
    addEvent(window, 'load', CallGoogleRemarketingTag);
}


if ((host == "seca.anthem.com") && (path == "/ratequote/app") && (screenidtextfield != "")) {
    LoadDSMMConversionScript(getConversionID('SECA', 'Individual', '', 'StartVisit', '', state.toUpperCase()));
}
else if ((host == "seca.anthem.com") && (path == "/ratequote/app") && (screenidtextfield == "")) {
    LoadDSMMConversionScript(getConversionID('SECA', 'Individual', '', 'Quote', '', state.toUpperCase()));
}
else if ((host == "seca.anthem.com") && (path == "/individualapp/integration/app")) {
    LoadDSMMConversionScript(getConversionID('SECA', 'Individual', '', 'StartBuyCycle', '', state.toUpperCase()));
}
else if ((host == "seca.anthem.com") && (path == "/reg/applicantreg.jsp")) {
    LoadDSMMConversionScript(getConversionID('SECA', 'Individual', '', 'Lead', '', state.toUpperCase()));
}
else if ((host == "seca.anthem.com") && (path == "/individualapp/app")) {
    conversionType = 2;
    LoadDSMMConversionScript(getConversionID('SECA', 'Individual', '', 'Purchase', '', state.toUpperCase()));
}


else if ((host == "express.rwsol.com")  && (path == "/roi/getdemographics.do")) {
    LoadGoogleRemarketingTag();

    // Load DART Tag for Application Page 1 for WP IND Direct Application
    var SubmitDARTscript = "";

    var axel = Math.random() + "";
    var a = axel * 10000000000000;

    SubmitDARTscript = 'https://fls.doubleclick.net/activityi;src=3315918;type=appli099;cat=appli460;ord=' + a + '?';
    LoadDARTTag(SubmitDARTscript);
}

// Match Type 6 -12 Medical Planform on Staging Server .  HOST need to be changed
//StartVisit: Anthem, AnthemWest, Bcc, BCBSGA, Unicare
else if (((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/getintroduction.do")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', '', 'StartVisit', brand, ''));
}

//Medical-Quote: Anthem, Bcc
else if (((host == "express.rwsol.com") || (host == "wlpat.rwsol.com"))&& (path == "/roi/getccrecommendationscart.do") && (productline == "medical")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'Medical', 'Quote', brand, ''));
}

//Dental-Quote: Anthem, Bcc
else if (((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/getsidebysiderecommendations.do") && (productline == "dental")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'Dental', 'Quote', brand, ''));
}

//TermLife-Quote: Anthem, Bcc
else if (((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/getsidebysiderecommendations.do") && (productline == "term_life")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'TermLife', 'Quote', brand, ''));
}


//Medical-Quote: Anthemwest , BCBSGA, Unicare
else if (((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/getrecommendations.do") && (productline == "medical")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'Medical', 'Quote', brand, ''));
}

//Dental-Quote: Anthemwest , BCBSGA, Unicare
else if (((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/getrecommendations.do") && (productline == "dental")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'Dental', 'Quote', brand, ''));
}

//TermLife-Quote: Anthemwest , BCBSGA, Unicare
else if ((host == "express.rwsol.com") && (path == "/roi/getrecommendations.do") && (productline == "term_life")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'TermLife', 'Quote', brand, ''));
}

//Medical-Quote  : Not Used
else if ((host == "express.rwsol.com") && (path == "/roi/getsidebysiderecommendations.do") && (productline == "medical")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'Medical', 'Quote', brand, ''));
}
//Dental-Quote  : Not Used
else if ((host == "express.rwsol.com") && (path == "/roi/getccrecommendations.do") && (productline == "dental")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'Dental', 'Quote', brand, ''));
}
//TermLife-Quote  : Not Used
else if ((host == "express.rwsol.com") && (path == "/roi/getccrecommendations.do") && (productline == "term_life")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', 'TermLife', 'Quote', brand, ''));
}


//StartBuyCycle: Anthem, AnthemWest,Bcc, BCBSGA, Unicare
else if (((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/servlets/express") && (displayaction.indexOf("registrationwizard") > -1) && (flow == "forward") && (issenior == "") && (saveaction == "createuser")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', '', 'StartBuyCycle', brand, ''));
}

//Lead: Anthem, AnthemWest, Bcc, BCBSGA, Unicare
else if ( ((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/servlets/express") && (saveaction.indexOf(".saveapplicantinfo") > -1) && (flow == "forward") && (saveaction.indexOf(".senior.saveapplicantinfo") < 0)) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', '', 'Lead', brand, ''));

    // Load DART Tag for Partial for TONIKstate.anthem.com
    var PartialDARTscript = "";

    var axel = Math.random() + "";
    var a = axel * 10000000000000;

    PartialDARTscript = 'https://fls.doubleclick.net/activityi;src=3037769;type=parti777;cat=parti016;ord=' + a + '?';
    LoadDARTTag(PartialDARTscript);


}

//Purchase: Anthem, AnthemWest, Bcc, BCBSGA, Unicare
else if ( ((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/servlets/express") && (saveaction.indexOf(".saveesignature") > -1) && (flow == "forward") && (saveaction.indexOf(".senior.saveesignature") < 0)) {
//else if ( ((host == "express.rwsol.com") || (host == "wlpat.rwsol.com")) && (path == "/roi/servlets/express") && (window.dsmmRevenue) ) {
    conversionType = 2;
    LoadDSMMConversionScript(getConversionID('Connecture', 'Individual', '', 'Purchase', brand, ''));

    LoadGooglePlanSaleTag();
	LoadGooglePlanDirectAPPSaleTag();
	LoadMSNPlanDirectAPPSaleTag();

    // Load DART Tag for Application Submitted for WP IND Direct Application
   
}


// Match Type 15 - for Tracking Connecture Senior: Anthem, BCC, BCBSGA, Unicare
else if ((host == "express.rwsol.com") && (path == "/roi/getseniorintroduction.do")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Senior', '', 'StartVisit', brand, ''));
}
else if ((host == "express.rwsol.com") && (path == "/roi/getseniorsbsrecommendations.do")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Senior', '', 'Quote', brand, ''));
}
else if ((host == "express.rwsol.com") && (path == "/roi/servlets/express") && (displayaction == "home") && (issenior == "1") && (saveaction == "") && (flow == "forward")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Senior', '', 'StartBuyCycle', brand, ''));
}
else if ((host == "express.rwsol.com") && (path == "/roi/servlets/express") && (saveaction.indexOf(".senior.saveapplicantinfo") > -1) && (displayaction == "enrollmentwizard") && (flow == "forward")) {
    LoadDSMMConversionScript(getConversionID('Connecture', 'Senior', '', 'Lead', brand, ''));
}
else if ((host == "express.rwsol.com") && (path == "/roi/servlets/express") && (saveaction.indexOf(".senior.saveesignature") > -1) && (flow == "forward")) {
    conversionType = 2;

    LoadDSMMConversionScript(getConversionID('Connecture', 'Senior', '', 'Purchase', brand, ''));
}


//if all above URLs patten don't match, see if wm_dsmm_conversion_id exists.  Use for tracking "OrderID"/"SEM-BCBG"
//Track for Tonik Leads on https://express.rwsol.com/roi/tonikconnect.do
else if ((host == "express.rwsol.com") && (path == "/roi/tonikconnect.do")) {
    conversionType = 1;
    LoadDSMMConversionScript("Tonik-" + brand);

    // Load DART Tag for Get Quote for TONIKstate.anthem.com
    var statesDARTscript = "";

    var axel = Math.random() + "";
    var a = axel * 10000000000000;

    if (state.toUpperCase() == "CA") {
        statesDARTscript = 'https://fls.doubleclick.net/activityi;src=3037769;type=getaq246;cat=getaq539;ord=' + a + '?';
        LoadDARTTag(statesDARTscript);
    }

    if (state.toUpperCase() == "CO") {
        statesDARTscript = 'https://fls.doubleclick.net/activityi;src=3037769;type=getaq246;cat=getaq171;ord=' + a + '?';
        LoadDARTTag(statesDARTscript);
    }

    if (state.toUpperCase() == "GA") {
        statesDARTscript = 'https://fls.doubleclick.net/activityi;src=3037769;type=getaq246;cat=getaq450;ord=' + a + '?';
        LoadDARTTag(statesDARTscript);
    }

    if (state.toUpperCase() == "NV") {
        statesDARTscript = 'https://fls.doubleclick.net/activityi;src=3037769;type=getaq246;cat=getaq032;ord=' + a + '?';
        LoadDARTTag(statesDARTscript);
    }


}
else if (window.wm_dsmm_conversion_id) {
    if (window.wm_dsmm_conversion_id != "applicationID") {
        LoadDSMMConversionScript(window.wm_dsmm_conversion_id);
    }
}
else {
    //IncludeJavaScript('//client.roiadtracker.com/adtracker/utilities.js');
    //IncludeJavaScript('//client.roiadtracker.com/adtracker/trackppc.js');
}


// Added on 01/18/2011 for 3rd party script for WellpointMember 
// for Anthem Only

function CallFetchbackTag() {
    var iframe = document.createElement("iframe");
    iframe.width = "1";
    iframe.height = "1";
    iframe.scrolling = "no";
    iframe.style.marginheight = "0";
    iframe.style.marginwidth = "0";
    iframe.frameborder = "0";
    document.body.appendChild(iframe);
    iframe.src = "//pixel.fetchback.com/serve/fb/pdc?cat=&name=landing&sid=3262";
}

function LoadFetchBackTag() {
    addEvent(window, 'load', CallFetchbackTag);
}

function CallGoogleTag() {

    var image = new Image(1, 1);

    image.src = "//www.googleadservices.com/pagead/conversion/1006046449/?label=NxXvCOeYjQIQ8Znc3wM&amp;guid=ON&amp;script=0";
    return;

}


function LoadGoogleTag() {
    addEvent(window, 'load', CallGoogleTag);
}

if ((host == "www.anthem.com") && ((path == "/ca/health-insurance/login/registration") || (path == "/ca/health-insurance/customer-care/faq") || (path == "/ca/health-insurance/plans-and-benefits/findprovider"))) {
    LoadGoogleTag();
    LoadFetchBackTag();

}

if ((host == "www.anthem.com") && ((path == "/health-insurance/login/registration") || (path == "/health-insurance/customer-care/faq"))) {
    LoadGoogleTag();
    LoadFetchBackTag();

}

if ((host == "www.anthem.com") && (path == "/home-providers.html")) {
    LoadGoogleTag();
}

if ((host == "www.bcbsga.com") && ((path == "/health-insurance/login/registration") || (path == "/health-insurance/customer-care/faq") || (path == "/health-insurance/plans-and-benefits/findprovider"))) {
    LoadGoogleTag();
    LoadFetchBackTag();

}





