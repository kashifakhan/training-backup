//<script>
    var maxt = maxt || {};
    (function(undefined) {
        !function(n){"use strict";function t(n,t){var r=(65535&n)+(65535&t),e=(n>>16)+(t>>16)+(r>>16);return e<<16|65535&r}function r(n,t){return n<<t|n>>>32-t}function e(n,e,o,u,c,f){return t(r(t(t(e,n),t(u,f)),c),o)}function o(n,t,r,o,u,c,f){return e(t&r|~t&o,n,t,u,c,f)}function u(n,t,r,o,u,c,f){return e(t&o|r&~o,n,t,u,c,f)}function c(n,t,r,o,u,c,f){return e(t^r^o,n,t,u,c,f)}function f(n,t,r,o,u,c,f){return e(r^(t|~o),n,t,u,c,f)}function i(n,r){n[r>>5]|=128<<r%32,n[(r+64>>>9<<4)+14]=r;var e,i,a,h,d,l=1732584193,g=-271733879,v=-1732584194,m=271733878;for(e=0;e<n.length;e+=16)i=l,a=g,h=v,d=m,l=o(l,g,v,m,n[e],7,-680876936),m=o(m,l,g,v,n[e+1],12,-389564586),v=o(v,m,l,g,n[e+2],17,606105819),g=o(g,v,m,l,n[e+3],22,-1044525330),l=o(l,g,v,m,n[e+4],7,-176418897),m=o(m,l,g,v,n[e+5],12,1200080426),v=o(v,m,l,g,n[e+6],17,-1473231341),g=o(g,v,m,l,n[e+7],22,-45705983),l=o(l,g,v,m,n[e+8],7,1770035416),m=o(m,l,g,v,n[e+9],12,-1958414417),v=o(v,m,l,g,n[e+10],17,-42063),g=o(g,v,m,l,n[e+11],22,-1990404162),l=o(l,g,v,m,n[e+12],7,1804603682),m=o(m,l,g,v,n[e+13],12,-40341101),v=o(v,m,l,g,n[e+14],17,-1502002290),g=o(g,v,m,l,n[e+15],22,1236535329),l=u(l,g,v,m,n[e+1],5,-165796510),m=u(m,l,g,v,n[e+6],9,-1069501632),v=u(v,m,l,g,n[e+11],14,643717713),g=u(g,v,m,l,n[e],20,-373897302),l=u(l,g,v,m,n[e+5],5,-701558691),m=u(m,l,g,v,n[e+10],9,38016083),v=u(v,m,l,g,n[e+15],14,-660478335),g=u(g,v,m,l,n[e+4],20,-405537848),l=u(l,g,v,m,n[e+9],5,568446438),m=u(m,l,g,v,n[e+14],9,-1019803690),v=u(v,m,l,g,n[e+3],14,-187363961),g=u(g,v,m,l,n[e+8],20,1163531501),l=u(l,g,v,m,n[e+13],5,-1444681467),m=u(m,l,g,v,n[e+2],9,-51403784),v=u(v,m,l,g,n[e+7],14,1735328473),g=u(g,v,m,l,n[e+12],20,-1926607734),l=c(l,g,v,m,n[e+5],4,-378558),m=c(m,l,g,v,n[e+8],11,-2022574463),v=c(v,m,l,g,n[e+11],16,1839030562),g=c(g,v,m,l,n[e+14],23,-35309556),l=c(l,g,v,m,n[e+1],4,-1530992060),m=c(m,l,g,v,n[e+4],11,1272893353),v=c(v,m,l,g,n[e+7],16,-155497632),g=c(g,v,m,l,n[e+10],23,-1094730640),l=c(l,g,v,m,n[e+13],4,681279174),m=c(m,l,g,v,n[e],11,-358537222),v=c(v,m,l,g,n[e+3],16,-722521979),g=c(g,v,m,l,n[e+6],23,76029189),l=c(l,g,v,m,n[e+9],4,-640364487),m=c(m,l,g,v,n[e+12],11,-421815835),v=c(v,m,l,g,n[e+15],16,530742520),g=c(g,v,m,l,n[e+2],23,-995338651),l=f(l,g,v,m,n[e],6,-198630844),m=f(m,l,g,v,n[e+7],10,1126891415),v=f(v,m,l,g,n[e+14],15,-1416354905),g=f(g,v,m,l,n[e+5],21,-57434055),l=f(l,g,v,m,n[e+12],6,1700485571),m=f(m,l,g,v,n[e+3],10,-1894986606),v=f(v,m,l,g,n[e+10],15,-1051523),g=f(g,v,m,l,n[e+1],21,-2054922799),l=f(l,g,v,m,n[e+8],6,1873313359),m=f(m,l,g,v,n[e+15],10,-30611744),v=f(v,m,l,g,n[e+6],15,-1560198380),g=f(g,v,m,l,n[e+13],21,1309151649),l=f(l,g,v,m,n[e+4],6,-145523070),m=f(m,l,g,v,n[e+11],10,-1120210379),v=f(v,m,l,g,n[e+2],15,718787259),g=f(g,v,m,l,n[e+9],21,-343485551),l=t(l,i),g=t(g,a),v=t(v,h),m=t(m,d);return[l,g,v,m]}function a(n){var t,r="";for(t=0;t<32*n.length;t+=8)r+=String.fromCharCode(n[t>>5]>>>t%32&255);return r}function h(n){var t,r=[];for(r[(n.length>>2)-1]=void 0,t=0;t<r.length;t+=1)r[t]=0;for(t=0;t<8*n.length;t+=8)r[t>>5]|=(255&n.charCodeAt(t/8))<<t%32;return r}function d(n){return a(i(h(n),8*n.length))}function l(n,t){var r,e,o=h(n),u=[],c=[];for(u[15]=c[15]=void 0,o.length>16&&(o=i(o,8*n.length)),r=0;16>r;r+=1)u[r]=909522486^o[r],c[r]=1549556828^o[r];return e=i(u.concat(h(t)),512+8*t.length),a(i(c.concat(e),640))}function g(n){var t,r,e="0123456789abcdef",o="";for(r=0;r<n.length;r+=1)t=n.charCodeAt(r),o+=e.charAt(t>>>4&15)+e.charAt(15&t);return o}function v(n){return unescape(encodeURIComponent(n))}function m(n){return d(v(n))}function p(n){return g(m(n))}function s(n,t){return l(v(n),v(t))}function C(n,t){return g(s(n,t))}function A(n,t,r){return t?r?s(t,n):C(t,n):r?m(n):p(n)}n.md5=A;return A}(maxt);

        Array.prototype.forEach||(Array.prototype.forEach=function(r,t){var o,n;if(null==this)throw new TypeError(" this is null or not defined");var e=Object(this),i=e.length>>>0;if("function"!=typeof r)throw new TypeError(r+" is not a function");for(arguments.length>1&&(o=t),n=0;i>n;){var a;n in e&&(a=e[n],r.call(o,a,n,e)),n++}});

        if (!String.prototype.includes) {
            String.prototype.includes = function(search, start) {
                'use strict';
                if (typeof start !== 'number') {
                    start = 0;
                }

                if (start + search.length > this.length) {
                    return false;{}
                } else {
                    return this.indexOf(search, start) !== -1;
                }
            };
        }

        if (!String.prototype.startsWith) {
            String.prototype.startsWith = function(searchString, position){
                position = position || 0;
                return this.substr(position, searchString.length) === searchString;
            };
        }

        if (!String.prototype.endsWith) {
            String.prototype.endsWith = function(searchString, position) {
                var subjectString = this.toString();
                if (typeof position !== 'number' || !isFinite(position) || Math.floor(position) !== position || position > subjectString.length) {
                    position = subjectString.length;
                }
                position -= searchString.length;
                var lastIndex = subjectString.indexOf(searchString, position);
                return lastIndex !== -1 && lastIndex === position;
            };
        }

        var currentScriptSrc = '//e.maxtraffic.com:443/serve/public/index.php?id=1129&d=colorlib.com/wp';
        /*
         * Maxtraffic library
         */
        maxt.arrayContains = function(haystack, needle) {
            for(var p in haystack)
                if(haystack[p] === needle)
                    return true;
            return false;
        };

        maxt.parseJSON = function(data) {
            if(JSON && typeof JSON.parse === 'function') return JSON.parse(data);
            else return eval('(' + data + ')');
        };

        maxt.implementJsonStringify  = function() {

            JSON.stringify = JSON.stringify || function (obj) {
                    var t = typeof (obj);
                    if (t != "object" || obj === null) {
                        // simple data type
                        if (t == "string") obj = '"'+obj+'"';
                        return String(obj);
                    } else {
                        // recurse array or object
                        var n, v, json = [], arr = (obj && obj.constructor == Array);
                        for (n in obj) {
                            v = obj[n]; t = typeof(v);

                            if (t == "string") v = '"'+v+'"';
                            else if (t == "object" && v !== null) v = JSON.stringify(v);

                            json.push((arr ? "" : '"' + n + '":') + String(v));
                        }
                        return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
                    }
                };
        };

        maxt.getHostname = function (url) {
            var a = document.createElement('a');
            a.href = url;
            return a.hostname;
        };

        maxt.getDomainName = function () {
            var i=0,domain=document.domain,p=domain.split('.'),s='_gd'+(new Date()).getTime();
            while(i<(p.length-1) && document.cookie.indexOf(s+'='+s)==-1){
                domain = p.slice(-1-(++i)).join('.');
                document.cookie = s+"="+s+";domain="+domain+";";
            }
            document.cookie = s+"=;expires=Thu, 01 Jan 1970 00:00:01 GMT;domain="+domain+";";
            return domain;
        };

        maxt.addEvent = function(obj, evt, fn, useCapture) {
            if (obj.addEventListener) {
                obj.addEventListener(evt, fn, typeof useCapture !== 'undefined' ? false : useCapture);
            }
            else if (obj.attachEvent) {
                obj.attachEvent("on" + evt, fn);
            }
        };

        maxt.getBrowser = function() {
            var ua = navigator.userAgent,
                tem,
                M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
            if (/trident/i.test(M[1])) {
                tem =/\brv[ :]+(\d+)/g.exec(ua) || [];
                return 'IE';
            }
            if (M[1] === 'Chrome') {
                tem = ua.match(/\bOPR\/(\d+)/)
                if (tem != null) {
                    return 'Opera'
                }
            }
            M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
            if ((tem = ua.match(/version\/(\d+)/i)) !=null) {
                M.splice(1,1,tem[1]);
            }
            return M[0];
        }

        maxt.getWindowSize = function() {
            var e = 0, n = 0;
            return window.innerWidth ? (e = window.innerWidth, n = window.innerHeight) : 0 != document.documentElement.clientWidth ? (e = document.documentElement.clientWidth, n = document.documentElement.clientHeight) : (e = document.body.clientWidth, n = document.body.clientHeight), {
                width: e,
                height: n
            }
        };

        maxt.getScrollTop = function() {
            if(typeof pageYOffset!= 'undefined'){
                //most browsers except IE before #9
                return pageYOffset;
            } else {
                var B= document.body; //IE 'quirks'
                var D= document.documentElement; //IE with doctype
                D= (D.clientHeight)? D: B;
                return D.scrollTop;
            }
        };

        maxt.getHeight = function() {
            var body = document.body,
                html = document.documentElement;

            return Math.max( body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight );
        };

        maxt.getViewport = function() {
            var viewport = document.querySelector('meta[name="viewport"]');

            if(viewport) {
                return viewport.content;
            }

            var scale = 1 / (document.body.getBoundingClientRect().width / screen.width);

            return 'width=device-width, minimum-scale='+scale+', maximum-scale=5.0, initial-scale='+scale;
        };

        maxt.setViewport = function(content) {
            var viewport = document.querySelector('meta[name="viewport"]');

            if(!content) {
                if(viewport) {
                    viewport.parentNode.removeChild(viewport);
                }
                return;
            }

            if(viewport) {
                viewport.content = content;
            } else {
                viewport=document.createElement('meta');
                viewport.id="viewport";
                viewport.name = "viewport";
                viewport.content = content;
                document.getElementsByTagName('head')[0].appendChild(viewport);
            }
        };

        maxt.params = {};
        (function(){
            var a = document.createElement('a');
            a.href = currentScriptSrc;
            return a.search;
        })().substr(1).split("&").forEach(function(item) {maxt.params[item.split("=")[0]] = item.split("=")[1]});

        maxt.website_id = maxt.params.id;
        maxt.tabId = Math.floor((Math.random() * 1e15) + 1e5);
        maxt.activeTabs = 1;
        maxt.segments = maxt.segments || [];
        maxt.onShow = maxt.onShow || false;
        maxt.campaigns = {};
        maxt.cappingCookie = false;
        maxt.uid = false;
        maxt.visit = Math.round(+new Date()/1000);
        maxt.isExitIntent = false;
        maxt.visitCount = 1;
        maxt.hasScrolled = false;
        maxt.seconds = 0;
        maxt.visitTime = 0;
        maxt.pageview = 1;
        maxt.activeCampaigns = {};
        maxt.mouseMovement = [];
        maxt.verticalScroll = maxt.getScrollTop();
        maxt.horizontalScroll = window.pageXOffset;
        maxt.preview =  false;
        maxt.isBounce = false;
        maxt.device = false;
        maxt.highestScrollreached = false;
        maxt.scrollTimer = null;
        maxt.scroll2Timer = null;
        maxt.window = maxt.getWindowSize();
        maxt.originalViewport = maxt.getViewport();
        maxt.aggression_level = 0;

        var serve_domain = maxt.getHostname(currentScriptSrc);
        var cdn_domain = 'cdn.mxapis.com';
        var serve_path = '//' + serve_domain + '/serve';

        maxt.options = {
            'serve_domain'      : serve_domain,
            'url_bt4'           : serve_path + '/bt4?website_id=' + maxt.website_id,
            'url_bt1'           : serve_path + '/bt1?website_id=' + maxt.website_id,
            'url_init'          : serve_path + '/public/init.php?website_id=' + maxt.website_id,
            'url_close'         : serve_path + '/log/close?website_id=' + maxt.website_id,
            'url_serve'         : '//' + cdn_domain + '/serve/display',
            'url_leads'         : serve_path + '/log/lead?website_id=' + maxt.website_id,
            'url_set_lead'      : serve_path + '/log/set-lead?website_id=' + maxt.website_id,
            'url_cart'          : serve_path + '/log/cart?website_id=' + maxt.website_id,
            'url_pageview'      : serve_path + '/log/pageview?website_id=' + maxt.website_id,
            'url_impression'    : serve_path + '/log/view?website_id=' + maxt.website_id,
            'url_exit_intent'   : serve_path + '/log/exit?website_id=' + maxt.website_id,
            'url_document'      : window.location.href,
            'website_domain'    : maxt.getDomainName(),
            'cookie_domain'     : maxt.getDomainName(),
            'is_shopify'        : maxt.params.shop ? true : false
        };

        maxt.domHash = function(name, id) {
            return 'maxt-' + maxt.md5(name + '-' + maxt.website_id + (typeof id !== 'undefined' ? '-' + id : '')).substr(0, 16);
        };

        maxt.setUID = function() {

            Cookies.expire('maxti', { expires: -1, domain: maxt.options.cookie_domain });

            var visit_cookie = Cookies.get('maxtv');
            var fv_cookie = Cookies.get('maxtf');
            var uid_cookie = Cookies.get('maxtu');

            // Check if first visit else increment visit counter
            if(fv_cookie) {
                maxt.visitCount = visit_cookie ? parseFloat(fv_cookie) : parseFloat(fv_cookie) + 1;
            }

            Cookies.set('maxtf', maxt.visitCount, { expires: 60 * 30, domain: maxt.options.cookie_domain });

            // Get/Set user UID
            if(uid_cookie) {
                maxt.uid = uid_cookie;
            } else {
                maxt.uid = maxt.generateUid();
                Cookies.set('maxtu', maxt.uid, { expires: 60 * 60 * 24 * 1000, domain: maxt.options.cookie_domain });
            }

            // Define visit time cookie
            if(visit_cookie) {
                maxt.visit = visit_cookie;
            } else {
                Cookies.set('maxtp', '0:0', { expires: 60 * 60 * 24 * 1000, domain: maxt.options.cookie_domain });
                Cookies.set('maxtv', maxt.visit, { expires: 60 * 30, domain: maxt.options.cookie_domain });
            }

            if(maxt.params.d == 'demo.maxtraffic.eu') {
                maxt.visit = 0;
            }
        };

        maxt.generateUid = function () {
            var gaCookie = Cookies.get('_ga');
            if(gaCookie) {
                var uid = maxt.md5(gaCookie.split('.')[2]);
            } else {
                var S4 = function() {
                    return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
                };
                var uid = (S4()+S4()+S4()+S4()+S4()+S4()+S4()+S4());
            }
            return uid;
        };

        maxt.setVisit = function() {

            Cookies.expire('maxtc', { expires: -1, domain: maxt.options.cookie_domain });

            // Get pageview/visit time cookie
            var page_cookie = Cookies.get('maxtp') ? Cookies.get('maxtp') : '0:0';
            var page_arr = page_cookie.split(":");

            // On bounce dont add pageview
            maxt.visitTime = page_arr[1];

            // Update pageview/visit time cookie
            Cookies.set('maxtp', maxt.pageview + ':' + maxt.visitTime, { expires: 60 * 60 * 24 * 1000, domain: maxt.options.cookie_domain });
        };


        maxt.updateTabs = function() {
            var timestamp = Math.round(+new Date()/1000);

            localStorage.setItem('maxtraffic_tab_' + maxt.tabId, timestamp);

            maxt.activeTabs = 1;

            for (var i = 0; i < localStorage.length; i++){

                var key = localStorage.key(i);

                // Tab key
                if(key.indexOf('maxtraffic_tab_') == 0 && key !== 'maxtraffic_tab_' + maxt.tabId) {
                    var tabTimestamp = localStorage.getItem(key);

                    if(timestamp - tabTimestamp > 5) {
                        localStorage.removeItem(key);
                    } else {
                        maxt.activeTabs = maxt.activeTabs + 1;
                    }
                }
            }
        };

        maxt.setImpression = function(campaign) {

            localStorage.setItem('maxtraffic_impression_' + Math.round(+new Date()/1000), campaign.id);

            maxt.logPixel(maxt.options.url_impression + "&campaign_id=" + campaign.id + "&creative_id=" + campaign.creative_id + '&pageview=' + maxt.pageview + '&url=' + encodeURIComponent(maxt.options.url_document));

            try {
                if(typeof(maxt.onShow) === typeof(Function)) {
                    maxt.onShow();
                }
            } catch(e) {
                console.log('maxt.onShow error : ' + e.message);
            }

            try {
                if (window.ga) {
                    window.ga( ga.getAll()[0].get('name') + '.send', {
                        'hitType': 'event',
                        'eventCategory': 'MaxTraffic',
                        'eventAction': 'Impression',
                        'eventLabel': campaign.name
                    });
                } else if (window._gaq) {
                    _gaq.push(['_trackEvent', 'MaxTraffic', 'Impression', campaign.name]);
                }
            } catch (e) {
                console.log('ga error : ' + e.message);
            }

        };

        maxt.crossTabImpression = function(key, campaignId) {

            setTimeout(function() {
                localStorage.removeItem(key);
            }, 2000);

            maxt.campaigns.forEach(function(campaign, index) {
                if(campaign.id == campaignId) {
                    delete maxt.campaigns[index];
                }
            });
        };

        maxt.setLead = function(campaign) {
            maxt.logPixel(maxt.options.url_leads + '&campaign_id=' + campaign.id + '&creative_id=' + campaign.creative_id);
        };

        maxt.logLead = function(campaign_id, creative_id) {
            maxt.logPixel(maxt.options.url_set_lead + '&campaign_id=' + campaign_id + '&creative_id=' + creative_id);
        };

        maxt.updateShopifyCart = function() {
            var cart = Cookies.get('cart');

            if(cart) {
                maxt.logPixel(maxt.options.url_cart + '&cart_token=' + cart);
            }
        };

        maxt.getReferrer = function() {
            var ref = document.referrer;
            var ref_hostname = maxt.getHostname(ref);
            return ref_hostname.indexOf(maxt.options.serve_domain) == -1 ? ref : '';
        };

        maxt.getCampaigns = function() {

            var url_init = maxt.options.url_init;

            url_init += '&segments=' + maxt.segments.join(',');
            url_init += '&maxtv=' + maxt.visit;
            url_init += '&visit=' + maxt.visitCount;
            url_init += '&url=' + encodeURIComponent(maxt.options.url_document);
            url_init += '&ref=' + encodeURIComponent(maxt.getReferrer());

            maxt.callScript(url_init);
        };

        maxt.cookieFilterPassed = function(campaign) {

            if(campaign.cookie_rules.length == 0) {
                return true;
            }

            var passed = true;

            campaign.cookie_rules.forEach(function(rule) {

                if( ! maxt.compare(Cookies.get(rule.name) || '', rule.value, rule.type)) {
                    passed = false;
                }
            });

            return passed;
        };

        maxt.compare = function(string, value, method) {

            switch(method) {
                case 'EQUALS':
                    return string == value;
                    break;
                case 'CONTAINS':
                    return string.includes(value);
                    break;
                case 'STARTS_WITH':
                    return string.startsWith(value);
                    break;
                case 'ENDS_WITH':
                    return string.endsWith(value);
                    break;
                case 'NOT_EQUALS':
                    return string != value;
                    break;
                case 'NOT_CONTAINS':
                    return ! string.includes(value);
                    break;
                case 'NOT_STARTS_WITH':
                    return ! string.startsWith(value);
                    break;
                case 'NOT_ENDS_WITH':
                    return ! string.endsWith(value);
                    break;
                case 'LESS_THAN':
                    return maxt.toNumberOrLength(string) < maxt.toNumberOrLength(value);
                    break;
                case 'LESS_EQUALS':
                    return maxt.toNumberOrLength(string) <= maxt.toNumberOrLength(value);
                    break;
                case 'GREATER_THAN':
                    return maxt.toNumberOrLength(string) > maxt.toNumberOrLength(value);
                    break;
                case 'GREATER_EQUALS':
                    return maxt.toNumberOrLength(string) >= maxt.toNumberOrLength(value);
                    break;
            }

            return false;
        };

        maxt.toNumberOrLength = function(value) {
            return maxt.isNumber(value) ? parseFloat(value) : value.length;
        };

        maxt.isNumber = function(value) {
            return !isNaN(parseFloat(value)) && isFinite(value);
        };

        maxt.filterCampaigns = function(campaigns) {

            var filteredCampaigns = [];

            for(var index in campaigns) {
                if (campaigns.hasOwnProperty(index)) {

                    var campaign = campaigns[index];

                    if(! maxt.cookieFilterPassed(campaign)) {
                        continue;
                    }

                    filteredCampaigns.push(campaign);
                }
            }


            return filteredCampaigns;
        };

        maxt.initCampaigns = function(data) {

            maxt.campaigns = maxt.parseJSON(data);

            maxt.campaigns = maxt.filterCampaigns(maxt.campaigns);

            // Preload and show campaign in preview mode
            if(maxt.preview) {
                var campaign = {
                    id: 0,
                    creative_id: maxt.preview
                }

                maxt.preloadCampaigns([campaign]);

                maxtc.show(campaign);

                return;
            }

            // Load campaign iframe in preload container
            maxt.preloadCampaigns(maxt.campaigns);

            // If bounce trigger show exit campaign
            if(maxt.isBounce) {
                for(var index in maxt.campaigns) {
                    if (maxt.campaigns.hasOwnProperty(index)) {
                        var campaign = maxt.campaigns[index];
                        if(campaign.traffic_source == 'exit') {
                            maxt.show(campaign);
                            return true;
                        }
                    }
                }
                history.back();
            }
        };

        maxt.stopCampaigns = function() {
            maxt.campaigns = {};
        };

        maxt.trigger = function(type) {
            if(type == 'exit') {
                maxt.isExitIntent = true;
            }
        };

        maxt.preloadCampaigns = function(campaigns) {

            var preload_html = '';

            for(var index in campaigns) {
                if (campaigns.hasOwnProperty(index)) {

                    var campaign = campaigns[index];

                    campaign.serving_path = maxt.options.url_serve
                        + '/' + campaign.creative_id
                        + '/' + maxt.device
                        + '/' + maxt.revision
                        + '?campaign_id=' + campaign.id
                        + '&uid=' + maxt.uid;

                    if(campaign.end_seconds) {
                        campaign.serving_path += '&tte=' + campaign.end_seconds;
                    }

                    preload_html += '<div style="overflow:hidden; height: 1px; left: 0; position: fixed; top: -10px; width: 1px;" id="' + maxt.domHash('creative-container', campaign.id) + '"><div style="width: 100%; height: 100%; position: relative;"><iframe id="' + maxt.domHash('creative-iframe', campaign.id) + '" src="' + campaign.serving_path + '" style="display: block; width:100%; height:100%; z-index: 2147483647; background-color: transparent;" allowtransparency="true" frameborder="0" scrolling="no"></iframe></div></div>';
                }
            }

            var preload_container = document.createElement('div');
            preload_container.id = maxt.domHash('preload-container');
            preload_container.innerHTML = preload_html;
            document.body.appendChild(preload_container);
        };

        maxt.logPageTime = function() {
            var visitTime = Math.round(parseFloat(maxt.visitTime) + parseFloat(maxt.seconds));
            Cookies.set('maxtp', maxt.pageview + ':' + visitTime, { expires: 60 * 60 * 24 * 1000, domain: maxt.options.cookie_domain });
        };

        maxt.tryCampaigns = function() {
            var campaigns = maxt.campaigns;
            maxt.seconds = Math.round(parseFloat(maxt.seconds + 0.1) * 100) / 100;

            for(var index in campaigns) {
                if (campaigns.hasOwnProperty(index)) {
                    var campaign = campaigns[index];

                    if(maxt.activeCampaigns[campaign.id]) {
                        continue;
                    }

                    var after_seconds_site = campaign.after_seconds_site - (parseFloat(maxt.visitTime) + parseFloat(maxt.seconds));
                    var after_seconds_page = campaign.after_seconds_page - parseFloat(maxt.seconds);

                    if(after_seconds_site <= 0 && after_seconds_page <= 0) {

                        var exitIntentCheck = campaign.traffic_source == 'exit' ? false : true;
                        var scrollCheck     = campaign.after_scrolled > 0 ? false : true;

                        if(maxt.isExitIntent) {
                            exitIntentCheck = true;
                            maxt.isExitIntent = false;
                        }

                        if(maxt.verticalScroll >= campaign.after_scrolled) {
                            scrollCheck = true;
                        }

                        if(exitIntentCheck && scrollCheck) {
                            maxt.show(campaign);
                            break;
                        }
                    }
                }
            }
        };

        maxt.show = function(campaign) {
            maxt.activeCampaigns[campaign.id] = campaign;

            maxt.campaigns.forEach(function(c, index) {
                if(
                    campaign.id == c.id ||
                    campaign.type == c.type ||
                    campaign.traffic_source == c.traffic_source
                ) {
                    delete maxt.campaigns[index];
                }
            });

            if(campaign.type == 'overlay' && (maxt.device == 'phone' || maxt.device == 'tablet')) {

                maxt.setViewport('width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, shrink-to-fit=no');
                document.body.scrollTop += 1;

                setTimeout(function() {
                    document.body.scrollTop -= 1;
                }, 200);

                setTimeout(function() {
                    maxtc.bootstrap(campaign);
                    maxtc.onResize(true);
                }, 400);

                setTimeout(function() {
                    maxtc.onResize(true);
                }, 600);

            } else {
                maxtc.bootstrap(campaign);
            }
        };

        maxt.logPixel = function(src) {
            var timestamp = Math.round(+new Date()/1000);
            var i = new Image();
            i.src = src +'&t='+ timestamp + '&uid=' + maxt.uid;
        };

        maxt.callScript = function(src) {
            var timestamp = Math.round(+new Date()/1000);

            var script = document.createElement('script');
            script.async = true;
            script.src = src +'&t='+ timestamp + '&uid=' + maxt.uid;
            document.body.appendChild(script);
        };

        maxt.loadPushNotification = function(url1, url2) {
        };


        maxt.logExit = function(event) {

            var coordinates = JSON.stringify(maxt.mouseMovement);
            maxt.mouseMovement = [];
            maxt.logPixel(maxt.options.url_exit_intent + '&mouse='+ coordinates + '&pageview=' + maxt.pageview + '&url=' + encodeURIComponent(maxt.options.url_document));

        };

        maxt.logMousemove = function(event) {
            var mousePos = {
                x: event.clientX,
                y: event.clientY,
                t: +new Date()
            };

            maxt.mouseMovement.unshift(mousePos);

            if(maxt.mouseMovement.length > 10) {
                maxt.mouseMovement.length = 10
            }
        };

        maxt.detectScroll = function() {
            var lastScroll = maxt.verticalScroll;
            maxt.verticalScroll = maxt.getScrollTop();

            if(!maxt.device || maxt.device == 'desktop') {
                return;
            }

            var up, diff, scrolled, pos,
                scrollPct = 70,
                scroll = maxt.verticalScroll,
                triggerPct = 8;

            up = lastScroll > scroll ? true : false;

            //scroll percentage
            pos = ((scroll + maxt.window.height) / maxt.window.height) * 100;
            diff = (pos) + (scrollPct);
            scrolled = (scroll / maxt.window.height) * 100;

            if (up && scroll >= 0 && (diff > 100 || maxt.highestScrollreached)) {
                if (scrolled <= triggerPct) {
                    maxt.isExitIntent = true;
                }
                maxt.highestScrollreached = true;
            }
        };

        maxt.goBounce = function() {

            var bounceCookieKey = 'maxtrafficBounce';
            var bounceOnly = false;
            var isBounce = !Cookies.get(bounceCookieKey);

            Cookies.set(bounceCookieKey, 1);
            if (history.pushState) {
                window.addEventListener('popstate', function (e) {
                    var state = e.state;
                    if (!state || state.s) {
                        return;
                    }
                    if (bounceOnly && !isBounce) {
                        window.history.go(-1);
                        return;
                    }
                    if (state.f && state.next) {
                        Cookies.set(bounceCookieKey, 0);
                        setTimeout(function () {
                            window.location.replace(state.next);
                        }, 10);
                    }
                });
            }
            if (bounceOnly && !isBounce) {
                return;
            }


            var gg_r = document.referrer;
            var ref_hostname = maxt.getHostname(gg_r);

            if (gg_r && ref_hostname.indexOf(maxt.options.website_domain) == - 1 && ref_hostname.indexOf(maxt.options.serve_domain) == -1) {
                var gg_go = ref_hostname;
                if (gg_go) {
                    if (history.pushState) {
                        if (!history.state) {
                            history.replaceState({
                                f: 1,
                                next: maxt.options.url_bt4 + '&f=' + gg_go + "&ref=" + encodeURIComponent(gg_r) + '&redirect=' + encodeURIComponent(window.location.href) + '&uid=' + maxt.uid
                            }, window.title);
                            history.pushState({
                                s: 1
                            }, window.title);
                        }
                    } else {
                        var go = 0;
                        var ch = setInterval(function () {
                            try {
                                go++;
                                if (go > 80) {
                                    clearInterval(ch);
                                    return;
                                }
                                var ej220 = document.getElementsByTagName("body")[0];
                                if (!ej220) {
                                    return;
                                }
                                clearInterval(ch);
                                var ej20 = document.createElement("script");
                                ej20.type = "text/javascript";
                                ej20.src = maxt.options.url_bt1 + '&f=' + gg_go + "&ref=" + encodeURIComponent(gg_r) + '&redirect=' + encodeURIComponent(window.location.href) + '&uid=' + maxt.uid;
                                ej220.insertBefore(ej20, ej220.firstChild);
                            } catch (e20) {}
                        }, 50);
                    }
                }
            }
        }

        maxt.timer = function( obj ) {
            this.isRunning = false; // is timer currently running
            this.interval = 500; // default interval of event calls

            this.funcRef = null; // reference to called function
            this.scope = this;

            this._timerId = 0; // global timer id

            /**
             * @constructor
             * @param {Object} obj - construction parameter
             */
            this.construct = function (obj) {
                this.mixIn(obj, this);
                // find smallest not used timer id
                while (document['myTimer' + this._timerId] != null) this._timerId++;
                document['myTimer' + this._timerId] = this;
            }

            /**
             * mix a given object into this object
             * @param {Object} obj - given object with parameters
             */
            this.mixIn = function (obj, scope) {
                if (!scope) scope = this;
                var item = null;
                for (item in obj) {
                    scope[item] = obj[item];
                }
            }

            /**
             * starts timer
             * @param {Int} interval - time in milliseconds for time interval
             * @param {Node} scope - the execution scope of the reference function
             * @param {Function} funcRef - function reference of function to be called on time event
             */
            this.start = function (funcRef, scope, interval) {
                if (this.isRunning)
                    return false;

                if (interval) this.interval = interval;

                this.scope = scope;
                this.funcRef = funcRef;
                this.isRunning = true;
                this.startTimer();
            }

            /**
             * starts a new time event call with given time interval
             */
            this.startTimer = function () {
                if (!this.isRunning) return;
                window.setTimeout("document['myTimer" + this._timerId + "'].timedHandler()", this.interval);
            }

            /**
             * stopps the timer
             */
            this.stopp = function () {
                this.isRunning = false;
            }

            /**
             * timed event handler. will be called on each time event
             */
            this.timedHandler = function () {
                if (this.isRunning) {
                    if (this.funcRef) {
                        this.funcRef.apply(this.scope);
                    } else this.stopp();

                    // do next timer call
                    this.startTimer();
                }
            }

            // constructor call
            this.construct(obj);
        };



        /*
         * Creative serving
         */
        var maxtc = {};

        maxtc.zoom = 1;

        maxtc.mobileScrollThreshold = 300;

        maxtc.campaign = false;

        maxtc._getCreativeIframe = function(campaignId) {
            return document.getElementById(maxt.domHash('creative-iframe', campaignId === undefined ? maxtc.campaign.id : campaignId));
        };

        maxtc._getCreativeContainer = function(campaignId) {
            return document.getElementById(maxt.domHash('creative-container', campaignId === undefined ? maxtc.campaign.id : campaignId));
        };

        maxtc._bindCampaign = function(campaignId) {
            maxtc.campaign = maxt.activeCampaigns[campaignId] || false;

            return maxtc.campaign;
        };

        maxtc.creativeClose = function () {
            if(maxtc.campaign.type == 'promo-bar') {
                document.body.classList.remove(maxtc.promoReadyClass);
                document.body.classList.remove(maxtc.promoGoClass);
            }

            maxt.logPixel(maxt.options.url_close + '&creative_id='+ maxtc.campaign.creative_id + '&campaign_id='+ maxtc.campaign.id + '&pageview=' + maxt.pageview + '&url=' + encodeURIComponent(maxt.options.url_document));

            maxtc._getCreativeContainer().parentNode.removeChild(maxtc._getCreativeContainer());

            if(maxtc.campaign.type == 'overlay' && (maxt.device == 'phone' || maxt.device == 'tablet')) {
                maxt.setViewport(maxt.originalViewport);
            }

            delete maxt.activeCampaigns[maxtc.campaign.id];

            maxtc.campaign = null;
        };

        maxtc.creativeClick = function () {
            maxt.setLead(maxtc.campaign);
            try {
                if (window.ga) {
                    window.ga( ga.getAll()[0].get('name') + '.send', {
                        'hitType': 'event',
                        'eventCategory': 'MaxTraffic',
                        'eventAction': 'Click',
                        'eventLabel': maxtc.campaign.name
                    });
                } else if (window._gaq) {
                    _gaq.push(['_trackEvent', 'MaxTraffic', 'Click', maxtc.campaign.name]);
                }
            } catch (e) {
                console.log('ga error : ' + e.message);
            }

        };

        maxtc.creativeLead = function () {
            try {
                if (window.ga) {
                    window.ga( ga.getAll()[0].get('name') + '.send', {
                        'hitType': 'event',
                        'eventCategory': 'MaxTraffic',
                        'eventAction': 'Lead',
                        'eventLabel': maxtc.campaign.name
                    });
                } else if (window._gaq) {
                    _gaq.push(['_trackEvent', 'MaxTraffic', 'Lead', maxtc.campaign.name]);
                }
            } catch (e) {
                console.log('ga error : ' + e.message);
            }
        };

        /**
         * Adjusts the creative properties on expand.
         */
        maxtc.creativeResize = function (options) {

            var container = maxtc._getCreativeContainer();

            container.style.removeProperty('left');
            container.style.removeProperty('right');
            container.style.removeProperty('top');
            container.style.removeProperty('bottom');

            container.style.width = options.width;
            container.style.height = options.height;
            container.style.marginTop = options.marginTop;
            container.style.marginLeft = options.marginLeft;
            container.style[options.vAlign] = options.vAlignValue;
            container.style[options.hAlign] = options.hAlignValue;

            if(!container.getAttribute('data-modal-open')) {
                maxtc._getCreativeIframe().focus();
            }

            container.setAttribute('data-modal-open',1);
            container.setAttribute('data-bootstraped',1);
            maxtc.onResize(true);
        };

        maxtc.promoBarResize = function (options) {
            var container = maxtc._getCreativeContainer();

            var bootstraped = container.getAttribute("data-bootstraped") ? true : false;

            container.setAttribute('data-position', options.position);
            container.setAttribute('data-modal-open', options.modal_open);

            if(!bootstraped) {

                if(maxt.device == 'desktop') {
                    container.style.removeProperty('top');

                    container.style[options.position] = '-42px';
                    container.style['width'] = '100%';
                    container.style['height'] = '42px';
                } else {
                    maxtc.onResize();
                }

                container.setAttribute('data-bootstraped', 1);

                setTimeout(function() {

                    if(maxt.device == 'desktop') {
                        container.style['transition'] = /Edge/i.test(navigator.userAgent) ? '' : options.position+' 500ms cubic-bezier(.455,.03,.515,.955)';
                        container.style[options.position] = '0px';
                    } else {
                        container.style['transition'] = 'top 500ms cubic-bezier(.455,.03,.515,.955)';
                        maxtc.onResize();
                    }

                    if (/Edge/i.test(navigator.userAgent) && options.position == 'bottom' && maxt.device == 'desktop') {

                        var iframe = maxtc._getCreativeIframe();
                        var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
                        var divs = iframeDocument.getElementsByTagName("div");
                        var redraws = 0;

                        var forceRedraw = function (element) {

                            if (!element) {
                                return;
                            }

                            var n = document.createTextNode(' ');
                            var disp = element.style.display;  // don't worry about previous display style

                            element.appendChild(n);
                            element.style.display = 'none';
                            var redraw = this.offsetHeight;
                            element.style.display = disp;

                            setTimeout(function () {
                                element.style.display = disp;
                                n.parentNode.removeChild(n);
                            }, 1); // you can play with this timeout to make it as short as possible
                        };

                        var redraw = function() {
                            for (var i = 0; i < divs.length; i++) {
                                forceRedraw(divs[i]);
                            }
                            redraws++;
                        };

                        redraw();
                        setInterval(redraw, 100);
                    }

                    setTimeout(function() {
                        container.style.removeProperty('transition');
                    }, 1000);

                    if(options.position == 'top') {
                        document.body.classList.add(maxtc.promoGoClass);
                    }
                }, 100);

            } else {
                maxtc.onResize();
            }

        };

        maxtc.onResize = function(force) {

            if(maxt.device == 'desktop') {
                return;
            }

            for(var index in maxt.activeCampaigns) {
                if (maxt.activeCampaigns.hasOwnProperty(index)) {
                    var campaign = maxt.activeCampaigns[index];

                    if(campaign.type == 'overlay' && maxt.getBrowser() == 'Chrome') {
                        //continue;
                    }

                    var container = maxtc._getCreativeContainer(campaign.id),
                        //zoomFactor = window.innerWidth/document.documentElement.clientWidth,
                        zoomFactor = maxtc.zoomLevel(),
                        position = container.getAttribute('data-position'),
                        modalOpen = container.getAttribute('data-modal-open') == 1 ? true : false,
                        bootstraped = container.getAttribute('data-bootstraped') == 1 ? true : false,
                        height = modalOpen ? window.innerHeight : 42 * zoomFactor,
                        posLeft = [window.pageXOffset,( position == 'top' ? window.pageYOffset+height : window.pageYOffset+window.innerHeight )],
                        posRight = [(posLeft[0] + window.innerWidth),posLeft[1]];

                    var resetPosition = true;

                    if(campaign.type == 'overlay' && (maxt.device == 'phone' || maxt.device == 'tablet')) {

                        if(typeof campaign.originalTop == 'undefined' || Math.abs(campaign.originalTop - window.pageYOffset) > maxtc.mobileScrollThreshold) {
                            campaign.originalTop = window.pageYOffset;
                        } else if(!force) {
                            resetPosition = false;
                        }

                        height += 2 * maxtc.mobileScrollThreshold;
                        posLeft[1] = campaign.originalTop + height - maxtc.mobileScrollThreshold;
                    }

                    container.style.position = 'absolute';
                    container.style.boxSizing = 'border-box';
                    container.style.width = posRight[0] - posLeft[0] + 'px';
                    container.style.left = posLeft[0] + 'px';

                    if(resetPosition)
                        container.style.height = height + 'px';

                    var top = posLeft[1] - container.offsetHeight;

                    if (campaign.type == 'promo-bar' && !bootstraped) {
                        top = position == 'top' ? top - height : top + height;
                    }

                    if(resetPosition)
                        container.style.top = top + 'px';

                    if (campaign.type == 'promo-bar' && position == 'top') {
                        var stylesheet = document.getElementById(maxt.domHash('promo-stylesheet'));
                        stylesheet.sheet.cssRules[1].style.height = 42 * zoomFactor;
                    }

                    var frame = maxtc._getCreativeIframe(campaign.id);

                    frame.style.width = ((posRight[0] - posLeft[0])) + 'px';

                    if(resetPosition)
                        frame.style.height = height + 'px';

                    if(resetPosition)
                        maxtc._getCreativeIframe(campaign.id).contentWindow.postMessage(JSON.stringify({
                            action: 'zoom',
                            options: {
                                zoom: zoomFactor,
                                width: (posRight[0] - posLeft[0]) / zoomFactor,
                                height: height / zoomFactor
                            }
                        }), '*');
                }
            }
        };

        maxtc.zoomLevel = function () {
            var ua = navigator.userAgent;

            var deviceWidth = (Math.abs(window.orientation) == 90) ? screen.height : screen.width;

            if(ua.indexOf('Mozilla/5.0') > -1 && ua.indexOf('Android ') > -1 && ua.indexOf('AppleWebKit') > -1 && ua.indexOf('Chrome') > -1) {
                deviceWidth = screen.width;
            }

            if((ua.indexOf('Mozilla/5.0') > -1 && ua.indexOf('Android ') > -1 && ua.indexOf('AppleWebKit') > -1) && !(ua.indexOf('Chrome') > -1)) {
                deviceWidth = deviceWidth / window.devicePixelRatio;
            }

            var zoom = window.innerWidth / deviceWidth;

            return zoom;
        };

        maxtc.scrollStart = function() {
            if(maxt.device == 'desktop') {
                return;
            }

            for(var index in maxt.activeCampaigns) {
                if (maxt.activeCampaigns.hasOwnProperty(index)) {
                    var campaign = maxt.activeCampaigns[index];
                    if(campaign.type != 'promo-bar') {
                        return;
                    }

                    var container = maxtc._getCreativeContainer(campaign.id);

                    container.style['display'] = 'none';
                    //container.style['visibility'] = 'hidden';
                }
            }
        };

        maxtc.scrollStop = function() {

            maxt.scroll2Timer = null;

            if(maxt.device == 'desktop') {
                return;
            }

            for(var index in maxt.activeCampaigns) {
                if (maxt.activeCampaigns.hasOwnProperty(index)) {
                    var campaign = maxt.activeCampaigns[index];
                    if(campaign.type != 'promo-bar') {
                        return;
                    }

                    var container = maxtc._getCreativeContainer(campaign.id);

                    container.style['display'] = 'block';
                    //container.style['visibility'] = 'visible';
                }
            }

        };


        maxtc.bootstrap = function (campaign) {
            maxtc.campaign = campaign;
            var zIndex = '2147483647';

            if(maxtc.campaign.type == 'promo-bar') {
                maxtc.promoGoClass = maxt.domHash('promo-go');
                maxtc.promoReadyClass = maxt.domHash('promo-ready');

                var css = 'body.' + maxtc.promoReadyClass + ':before{transition:height 500ms cubic-bezier(.455,.03,.515,.955);content: " ";display:block;visibility: hidden;height:0;padding:0;margin:0;} body.' + maxtc.promoGoClass + ':before{height: 42px;}';
                var style = document.createElement('style');
                style.type = 'text/css';
                style.id = maxt.domHash('promo-stylesheet');
                if (style.styleSheet) {
                    style.styleSheet.cssText = css;
                } else {
                    style.appendChild(document.createTextNode(css));
                }
                document.body.appendChild(style);

                document.body.classList.add(maxtc.promoReadyClass);

                zIndex = '2147483646';

            }

            var container = maxtc._getCreativeContainer();

            container.style.width = '1px';
            container.style.height = '1px';
            container.style.zIndex = zIndex;
            container.style.left = 0;
            container.style.top = 0;
            container.style.display = 'block';
            container.style.position = 'fixed';
            container.style.webkitTransform = 'translateZ(1px)';

            var jsonMessage = {
                action: 'bootstrap',
                options: {}
            };

            var iframe =  maxtc._getCreativeIframe();

            iframe.onload = function () {
                iframe.contentWindow.postMessage(JSON.stringify(jsonMessage), '*');
            };

            iframe.contentWindow.postMessage(JSON.stringify(jsonMessage), '*');
            /*if(maxtc.campaign.type == 'promo-bar') {
                iframe.onload = function () {
                    iframe.contentWindow.postMessage(JSON.stringify(jsonMessage), '*');
                };

                iframe.contentWindow.postMessage(JSON.stringify(jsonMessage), '*');

            } else {
                iframe.contentWindow.postMessage(JSON.stringify(jsonMessage), '*');
            }*/

            if(!maxt.preview) {
                maxt.setImpression(maxtc.campaign);
                if(maxtc.campaign.type != 'promo-bar') {
                    maxt.setLead(maxtc.campaign);
                }
            }
        };

        maxtc.messageHandler = function (event) {

            var message;

            try {
                message = maxt.parseJSON(event.data);
            } catch (e) {
                return;
            }

            if(!maxtc._bindCampaign(message.campaignId)) {
                return;
            }

            switch (message.action) {
                case 'resize':
                    maxtc.creativeResize(message.options);
                    break;
                case 'promo-bar-update':
                    maxtc.promoBarResize(message.options);
                    break;
                case 'close':
                    maxtc.creativeClose();
                    break;
                case 'click':
                    maxtc.creativeClick();
                    break;
                case 'redirect':
                    window.location.href = message.options.url;
                    break;
                case 'lead':
                    maxtc.creativeLead();
                    break;
            }
        };

        /*!
         * Cookies.js - 0.3.1
         * Wednesday, April 24 2013 @ 2:28 AM EST
         *
         * Copyright (c) 2013, Scott Hamper
         * Licensed under the MIT license,
         * http://www.opensource.org/licenses/MIT
         */

        var Cookies = function (key, value, options) {
            return arguments.length === 1 ?
                Cookies.get(key) : Cookies.set(key, value, options);
        };

        // Allows for setter injection in unit tests
        Cookies._document = document;
        Cookies._navigator = navigator;

        Cookies.defaults = {
            path: '/'
        };

        Cookies.get = function (key) {
            if (Cookies._cachedDocumentCookie !== Cookies._document.cookie) {
                Cookies._renewCache();
            }

            return Cookies._cache[key];
        };

        Cookies.set = function (key, value, options) {
            options = Cookies._getExtendedOptions(options);
            options.expires = Cookies._getExpiresDate(value === undefined ? -1 : options.expires);

            Cookies._document.cookie = Cookies._generateCookieString(key, value, options);

            /* Wizardry */
            var myCookie = Cookies.get(key);
            if(maxt.getBrowser() == 'IE' && myCookie !== value) {
                options.domain = false;
                Cookies._document.cookie = Cookies._generateCookieString(key, value, options);
            }

            /* Wizardry */
            return Cookies;
        };

        Cookies.expire = function (key, options) {
            return Cookies.set(key, undefined, options);
        };

        Cookies._getExtendedOptions = function (options) {
            return {
                path: options && options.path || Cookies.defaults.path,
                domain: options && options.domain || Cookies.defaults.domain,
                expires: options && options.expires || Cookies.defaults.expires,
                secure: options && options.secure !== undefined ?  options.secure : Cookies.defaults.secure
            };
        };

        Cookies._isValidDate = function (date) {
            return Object.prototype.toString.call(date) === '[object Date]' && !isNaN(date.getTime());
        };

        Cookies._getExpiresDate = function (expires, now) {
            now = now || new Date();
            switch (typeof expires) {
                case 'number': expires = new Date(now.getTime() + expires * 1000); break;
                case 'string': expires = new Date(expires); break;
            }

            if (expires && !Cookies._isValidDate(expires)) {
                throw new Error('`expires` parameter cannot be converted to a valid Date instance');
            }

            return expires;
        };

        Cookies._generateCookieString = function (key, value, options) {
            key = encodeURIComponent(key);
            value = (value + '').replace(/[^!#$&-+\--:<-\[\]-~]/g, encodeURIComponent);
            options = options || {};

            var cookieString = key + '=' + value;
            cookieString += options.path ? ';path=' + options.path : '';
            cookieString += options.domain ? ';domain=' + options.domain : '';
            cookieString += options.expires ? ';expires=' + options.expires.toUTCString() : '';
            cookieString += options.secure ? ';secure' : '';

            return cookieString;
        };

        Cookies._getCookieObjectFromString = function (documentCookie) {
            var cookieObject = {};
            var cookiesArray = documentCookie ? documentCookie.split('; ') : [];

            for (var i = 0; i < cookiesArray.length; i++) {
                try {
                    var cookieKvp = Cookies._getKeyValuePairFromCookieString(cookiesArray[i]);

                    if (cookieObject[cookieKvp.key] === undefined) {
                        cookieObject[cookieKvp.key] = cookieKvp.value;
                    }
                }
                catch(err) {
                    //console.log(err.message);
                }
            }

            return cookieObject;
        };

        Cookies._getKeyValuePairFromCookieString = function (cookieString) {
            // "=" is a valid character in a cookie value according to RFC6265, so cannot `split('=')`
            var separatorIndex = cookieString.indexOf('=');

            // IE omits the "=" when the cookie value is an empty string
            separatorIndex = separatorIndex < 0 ? cookieString.length : separatorIndex;

            return {
                key: decodeURIComponent(cookieString.substr(0, separatorIndex)),
                //value: decodeURIComponent(cookieString.substr(separatorIndex + 1))
                value: decodeURIComponent(cookieString.substr(separatorIndex + 1).replace(/%uFFFD/gi, ''))
            };
        };

        Cookies._renewCache = function () {
            Cookies._cache = Cookies._getCookieObjectFromString(Cookies._document.cookie);
            Cookies._cachedDocumentCookie = Cookies._document.cookie;
        };

        Cookies._areEnabled = function () {
            return Cookies.set('cookies.js', 1).get('cookies.js') === '1';
        };

        maxt.implementJsonStringify();
        maxt.setUID();
        maxt.updateTabs();

        if(maxt.options.is_shopify) {
            try {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function()
                {
                    if (xmlHttp.readyState==4 && xmlHttp.status==200)
                    {
                        var cart = maxt.parseJSON(xmlHttp.responseText);
                        if(cart.item_count > 0) {
                            maxt.segments.push('has products in cart');
                        }
                        maxt.getCampaigns();
                    }
                }
                xmlHttp.open('GET', '/cart.js', true);
                xmlHttp.send(null);
            } catch (e) {}
            maxt.updateShopifyCart();
        } else {
            maxt.getCampaigns();
        }

        var timer = new maxt.timer( {'interval':100} );

        timer.start( maxt.tryCampaigns );


        window.setInterval(maxt.updateTabs, 3000);

        // Set events
        maxt.addEvent(window, 'message', maxtc.messageHandler, false);

        maxt.addEvent(window, 'storage', function(e) {

            if(e.key.startsWith('maxtraffic_impression_')) {
                maxt.crossTabImpression(e.key, e.newValue);
            }

            if(e.key == 'maxtraffic_tab_' + maxt.tabId || (e.newValue !== null && e.oldValue !== null)) {
                return false;
            }

            maxt.updateTabs();
        });

        maxt.addEvent(window, 'focus', function(e) {
            timer.start( maxt.tryCampaigns );
        });

        maxt.addEvent(window, 'blur', function(e) {
            timer.stopp();
            maxt.logPageTime();
        });

        maxt.addEvent(window, 'beforeunload', function(e) {
            localStorage.removeItem('maxtraffic_tab_' + maxt.tabId);
            maxt.logPageTime();
        });

        maxt.addEvent(document, 'beforeunload', function(e) {
            timer.stopp();
            maxt.logPageTime();
        });

        maxt.addEvent(document, 'mouseover', function(e) {
            maxt.isExitIntent = false;
            timer.start( maxt.tryCampaigns );
        });

        maxt.addEvent(document, 'mouseenter', function(e) {
            maxt.isExitIntent = false;
        });

        maxt.addEvent(document, 'mouseout', function(e) {
            e = e ? e : window.event;
            var from = e.relatedTarget || e.toElement;

            if( (!from || from.nodeName == "HTML") &&
                (e.clientY <= 100 || (maxt.aggression_level == 2)) &&
                maxt.mouseMovement.length == 10 &&
                (maxt.mouseMovement[0].y < maxt.mouseMovement[9].y || (maxt.aggression_level == 2)) &&
                (maxt.mouseMovement[9].y - maxt.mouseMovement[0].y > 15 || (maxt.aggression_level == 2)) &&
                (maxt.activeTabs == 1 || (maxt.aggression_level > 0))
            ) {
                maxt.isExitIntent = true;
            }

            maxt.logPageTime();
        });

        maxt.addEvent(document, 'mousemove', function(e) {
            maxt.logMousemove(e);
        });

        maxt.addEvent(window, 'resize', function() {

            maxtc.scrollStart();

            clearTimeout(maxt.scroll2Timer);
            maxt.scroll2Timer = setTimeout(function() {
                maxtc.scrollStop();
                maxtc.onResize();
            }, 300);
        });

        maxt.addEvent(window, 'orientationchange', function() {

            maxtc.scrollStart();

            clearTimeout(maxt.scroll2Timer);
            maxt.scroll2Timer = setTimeout(function() {
                maxtc.scrollStop();
                maxtc.onResize();
            }, 300);
        });

        maxt.addEvent(document, 'touchmove', function() {

            maxtc.scrollStart();

            clearTimeout(maxt.scroll2Timer);
            maxt.scroll2Timer = setTimeout(function() {
                maxtc.scrollStop();
                maxtc.onResize();
            }, 300);
        });

        maxt.addEvent(document, 'scroll', function() {

            maxtc.scrollStart();

            clearTimeout(maxt.scroll2Timer);
            maxt.scroll2Timer = setTimeout(function() {
                maxtc.scrollStop();
                maxtc.onResize();
            }, 300);

            if(maxt.horizontalScroll != window.pageXOffset) {
                maxt.horizontalScroll = window.pageXOffset;
            }

            clearTimeout(maxt.scrollTimer);
            maxt.scrollTimer = setTimeout(maxt.detectScroll, 150);
        });
    })();