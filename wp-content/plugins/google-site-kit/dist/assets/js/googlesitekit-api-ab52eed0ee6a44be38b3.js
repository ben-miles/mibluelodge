(window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[]).push([[5],{100:function(t,e,n){"use strict";(function(t){n.d(e,"a",(function(){return o}));var r=n(58),i=n(36),a=n(51);function o(e,n){var o,c=Object(r.a)(n),u=e.activeModules,s=e.referenceSiteURL,f=e.userIDHash,l=e.userRoles,d=void 0===l?[]:l,g=e.isAuthenticated,p=e.pluginVersion;return function(){var n=t.document;if(void 0===o&&(o=!!n.querySelector("script[".concat(i.b,"]"))),!o){o=!0;var r=(null==d?void 0:d.length)?d.join(","):"";c("js",new Date),c("config",e.trackingID,{groups:"site_kit",send_page_view:e.isSiteKitScreen,domain:s,plugin_version:p||"",enabled_features:Array.from(a.a).join(","),active_modules:u.join(","),authenticated:g?"1":"0",user_properties:{user_roles:r,user_identifier:f}});var l=n.createElement("script");return l.setAttribute(i.b,""),l.async=!0,l.src="https://www.googletagmanager.com/gtag/js?id=".concat(e.trackingID,"&l=").concat(i.a),n.head.appendChild(l),{scriptTagSrc:"https://www.googletagmanager.com/gtag/js?id=".concat(e.trackingID,"&l=").concat(i.a)}}}}}).call(this,n(26))},101:function(t,e,n){"use strict";n.d(e,"a",(function(){return d}));var r=n(5),i=n.n(r),a=n(6),o=n.n(a),c=n(17),u=n.n(c),s=n(58);function f(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function l(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?f(Object(n),!0).forEach((function(e){o()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):f(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function d(t,e,n,r){var a=Object(s.a)(e);return function(){var e=u()(i.a.mark((function e(o,c,u,s){var f;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(t.trackingEnabled){e.next=3;break}return e.abrupt("return");case 3:return n(),f={send_to:"site_kit",event_category:o,event_label:u,value:s},e.abrupt("return",new Promise((function(t){var e,n,i=setTimeout((function(){r.console.warn('Tracking event "'.concat(c,'" (category "').concat(o,'") took too long to fire.')),t()}),1e3),u=function(){clearTimeout(i),t()};a("event",c,l(l({},f),{},{event_callback:u})),(null===(e=r._gaUserPrefs)||void 0===e||null===(n=e.ioo)||void 0===n?void 0:n.call(e))&&u()})));case 6:case"end":return e.stop()}}),e)})));return function(t,n,r,i){return e.apply(this,arguments)}}()}},1098:function(t,e,n){"use strict";n.r(e),function(t){var r=n(766);void 0===t.googlesitekit&&(t.googlesitekit={}),void 0===t.googlesitekit.api&&(t.googlesitekit.api=r.a),e.default=r.a}.call(this,n(26))},2:function(t,e){t.exports=googlesitekit.i18n},323:function(t,e,n){"use strict";(function(t){var r=n(65),i=n.n(r),a=n(324),o=t._googlesitekitAPIFetchData||{},c=o.nonce,u=o.nonceEndpoint,s=o.preloadedData,f=o.rootURL;i.a.nonceEndpoint=u,i.a.nonceMiddleware=i.a.createNonceMiddleware(c),i.a.rootURLMiddleware=i.a.createRootURLMiddleware(f),i.a.preloadingMiddleware=Object(a.a)(s),i.a.use(i.a.nonceMiddleware),i.a.use(i.a.mediaUploadMiddleware),i.a.use(i.a.rootURLMiddleware),i.a.use(i.a.preloadingMiddleware),e.default=i.a}).call(this,n(26))},324:function(t,e,n){"use strict";var r=n(313);e.a=function(t){var e=Object.keys(t).reduce((function(e,n){return e[Object(r.getStablePath)(n)]=t[n],e}),{}),n=!1;return function(t,i){if(n)return i(t);setTimeout((function(){n=!0}),1e3);var a=t.parse,o=void 0===a||a,c=t.path;if("string"==typeof t.path){var u,s=(null===(u=t.method)||void 0===u?void 0:u.toUpperCase())||"GET",f=Object(r.getStablePath)(c);if(o&&"GET"===s&&e[f]){var l=Promise.resolve(e[f].body);return delete e[f],l}if("OPTIONS"===s&&e[s]&&e[s][f]){var d=Promise.resolve(e[s][f]);return delete e[s][f],d}}return i(t)}}},35:function(t,e,n){"use strict";(function(t){n.d(e,"a",(function(){return k})),n.d(e,"b",(function(){return m})),n.d(e,"c",(function(){return y}));var r=n(99),i=t._googlesitekitTrackingData||{},a=i.activeModules,o=void 0===a?[]:a,c=i.isSiteKitScreen,u=i.trackingEnabled,s=i.trackingID,f=i.referenceSiteURL,l=i.userIDHash,d=i.isAuthenticated,g={activeModules:o,trackingEnabled:u,trackingID:s,referenceSiteURL:f,userIDHash:l,isSiteKitScreen:c,userRoles:i.userRoles,isAuthenticated:d,pluginVersion:"1.134.0"},p=Object(r.a)(g),v=p.enableTracking,b=p.disableTracking,h=(p.isTrackingEnabled,p.initializeSnippet),m=p.trackEvent,y=p.trackEventOnce;function k(t){t?v():b()}c&&u&&h()}).call(this,n(26))},36:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"b",(function(){return i}));var r="_googlesitekitDataLayer",i="data-googlesitekit-gtag"},37:function(t,e,n){"use strict";n.d(e,"a",(function(){return i})),n.d(e,"f",(function(){return c})),n.d(e,"e",(function(){return u})),n.d(e,"c",(function(){return s})),n.d(e,"d",(function(){return f})),n.d(e,"b",(function(){return l}));n(12);var r=n(2),i="missing_required_scopes",a="insufficientPermissions",o="forbidden";function c(t){return(null==t?void 0:t.code)===i}function u(t){var e;return[a,o].includes(null==t||null===(e=t.data)||void 0===e?void 0:e.reason)}function s(t){var e;return!!(null==t||null===(e=t.data)||void 0===e?void 0:e.reconnectURL)}function f(t,e){return!(!(null==e?void 0:e.storeName)||u(t)||c(t)||s(t))}function l(t){return"internal_server_error"===(null==t?void 0:t.code)?Object(r.__)("There was a critical error on this website while fetching data","google-site-kit"):"invalid_json"===(null==t?void 0:t.code)?Object(r.__)("The server provided an invalid response","google-site-kit"):null==t?void 0:t.message}},39:function(t,e,n){"use strict";(function(t){n.d(e,"a",(function(){return l})),n.d(e,"d",(function(){return m})),n.d(e,"f",(function(){return y})),n.d(e,"c",(function(){return k})),n.d(e,"e",(function(){return w})),n.d(e,"b",(function(){return O}));var r=n(5),i=n.n(r),a=n(17),o=n.n(a),c=(n(27),n(8));function u(t,e){var n="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!n){if(Array.isArray(t)||(n=function(t,e){if(!t)return;if("string"==typeof t)return s(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);"Object"===n&&t.constructor&&(n=t.constructor.name);if("Map"===n||"Set"===n)return Array.from(t);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return s(t,e)}(t))||e&&t&&"number"==typeof t.length){n&&(t=n);var r=0,i=function(){};return{s:i,n:function(){return r>=t.length?{done:!0}:{done:!1,value:t[r++]}},e:function(t){throw t},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,o=!0,c=!1;return{s:function(){n=n.call(t)},n:function(){var t=n.next();return o=t.done,t},e:function(t){c=!0,a=t},f:function(){try{o||null==n.return||n.return()}finally{if(c)throw a}}}}function s(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}var f,l="googlesitekit_",d="".concat(l).concat("1.134.0","_").concat(t._googlesitekitBaseData.storagePrefix,"_"),g=["sessionStorage","localStorage"],p=[].concat(g),v=function(){var e=o()(i.a.mark((function e(n){var r,a;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(r=t[n]){e.next=3;break}return e.abrupt("return",!1);case 3:return e.prev=3,a="__storage_test__",r.setItem(a,a),r.removeItem(a),e.abrupt("return",!0);case 10:return e.prev=10,e.t0=e.catch(3),e.abrupt("return",e.t0 instanceof DOMException&&(22===e.t0.code||1014===e.t0.code||"QuotaExceededError"===e.t0.name||"NS_ERROR_DOM_QUOTA_REACHED"===e.t0.name)&&0!==r.length);case 13:case"end":return e.stop()}}),e,null,[[3,10]])})));return function(t){return e.apply(this,arguments)}}();function b(){return h.apply(this,arguments)}function h(){return(h=o()(i.a.mark((function e(){var n,r,a;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(void 0===f){e.next=2;break}return e.abrupt("return",f);case 2:n=u(p),e.prev=3,n.s();case 5:if((r=n.n()).done){e.next=15;break}if(a=r.value,!f){e.next=9;break}return e.abrupt("continue",13);case 9:return e.next=11,v(a);case 11:if(!e.sent){e.next=13;break}f=t[a];case 13:e.next=5;break;case 15:e.next=20;break;case 17:e.prev=17,e.t0=e.catch(3),n.e(e.t0);case 20:return e.prev=20,n.f(),e.finish(20);case 23:return void 0===f&&(f=null),e.abrupt("return",f);case 25:case"end":return e.stop()}}),e,null,[[3,17,20,23]])})))).apply(this,arguments)}var m=function(){var t=o()(i.a.mark((function t(e){var n,r,a,o,c,u,s;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,b();case 2:if(!(n=t.sent)){t.next=10;break}if(!(r=n.getItem("".concat(d).concat(e)))){t.next=10;break}if(a=JSON.parse(r),o=a.timestamp,c=a.ttl,u=a.value,s=a.isError,!o||c&&!(Math.round(Date.now()/1e3)-o<c)){t.next=10;break}return t.abrupt("return",{cacheHit:!0,value:u,isError:s});case 10:return t.abrupt("return",{cacheHit:!1,value:void 0});case 11:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}(),y=function(){var e=o()(i.a.mark((function e(n,r){var a,o,u,s,f,l,g,p,v=arguments;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return a=v.length>2&&void 0!==v[2]?v[2]:{},o=a.ttl,u=void 0===o?c.b:o,s=a.timestamp,f=void 0===s?Math.round(Date.now()/1e3):s,l=a.isError,g=void 0!==l&&l,e.next=3,b();case 3:if(!(p=e.sent)){e.next=14;break}return e.prev=5,p.setItem("".concat(d).concat(n),JSON.stringify({timestamp:f,ttl:u,value:r,isError:g})),e.abrupt("return",!0);case 10:return e.prev=10,e.t0=e.catch(5),t.console.warn("Encountered an unexpected storage error:",e.t0),e.abrupt("return",!1);case 14:return e.abrupt("return",!1);case 15:case"end":return e.stop()}}),e,null,[[5,10]])})));return function(t,n){return e.apply(this,arguments)}}(),k=function(){var e=o()(i.a.mark((function e(n){var r,a;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,b();case 2:if(!(r=e.sent)){e.next=14;break}return e.prev=4,a=n.startsWith(l)?n:"".concat(d).concat(n),r.removeItem(a),e.abrupt("return",!0);case 10:return e.prev=10,e.t0=e.catch(4),t.console.warn("Encountered an unexpected storage error:",e.t0),e.abrupt("return",!1);case 14:return e.abrupt("return",!1);case 15:case"end":return e.stop()}}),e,null,[[4,10]])})));return function(t){return e.apply(this,arguments)}}(),w=function(){var e=o()(i.a.mark((function e(){var n,r,a,o;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,b();case 2:if(!(n=e.sent)){e.next=14;break}for(e.prev=4,r=[],a=0;a<n.length;a++)0===(o=n.key(a)).indexOf(l)&&r.push(o);return e.abrupt("return",r);case 10:return e.prev=10,e.t0=e.catch(4),t.console.warn("Encountered an unexpected storage error:",e.t0),e.abrupt("return",[]);case 14:return e.abrupt("return",[]);case 15:case"end":return e.stop()}}),e,null,[[4,10]])})));return function(){return e.apply(this,arguments)}}(),O=function(){var t=o()(i.a.mark((function t(){var e,n,r,a;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,b();case 2:if(!t.sent){t.next=25;break}return t.next=6,w();case 6:e=t.sent,n=u(e),t.prev=8,n.s();case 10:if((r=n.n()).done){t.next=16;break}return a=r.value,t.next=14,k(a);case 14:t.next=10;break;case 16:t.next=21;break;case 18:t.prev=18,t.t0=t.catch(8),n.e(t.t0);case 21:return t.prev=21,n.f(),t.finish(21);case 24:return t.abrupt("return",!0);case 25:return t.abrupt("return",!1);case 26:case"end":return t.stop()}}),t,null,[[8,18,21,24]])})));return function(){return t.apply(this,arguments)}}()}).call(this,n(26))},51:function(t,e,n){"use strict";(function(t){var r,i;n.d(e,"a",(function(){return a})),n.d(e,"b",(function(){return o}));var a=new Set((null===(r=t)||void 0===r||null===(i=r._googlesitekitBaseData)||void 0===i?void 0:i.enabledFeatures)||[]),o=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:a;return e instanceof Set&&e.has(t)}}).call(this,n(26))},58:function(t,e,n){"use strict";n.d(e,"a",(function(){return i}));var r=n(36);function i(t){return function(){t[r.a]=t[r.a]||[],t[r.a].push(arguments)}}},7:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"b",(function(){return i})),n.d(e,"e",(function(){return a})),n.d(e,"d",(function(){return o})),n.d(e,"c",(function(){return c})),n.d(e,"z",(function(){return u})),n.d(e,"E",(function(){return s})),n.d(e,"G",(function(){return f})),n.d(e,"C",(function(){return l})),n.d(e,"D",(function(){return d})),n.d(e,"B",(function(){return g})),n.d(e,"A",(function(){return p})),n.d(e,"F",(function(){return v})),n.d(e,"f",(function(){return b})),n.d(e,"g",(function(){return h})),n.d(e,"h",(function(){return m})),n.d(e,"j",(function(){return y})),n.d(e,"l",(function(){return k})),n.d(e,"m",(function(){return w})),n.d(e,"n",(function(){return O})),n.d(e,"o",(function(){return j})),n.d(e,"q",(function(){return _})),n.d(e,"r",(function(){return x})),n.d(e,"s",(function(){return D})),n.d(e,"t",(function(){return S})),n.d(e,"v",(function(){return E})),n.d(e,"k",(function(){return P})),n.d(e,"x",(function(){return N})),n.d(e,"u",(function(){return A})),n.d(e,"y",(function(){return T})),n.d(e,"w",(function(){return L})),n.d(e,"i",(function(){return I})),n.d(e,"p",(function(){return M})),n.d(e,"I",(function(){return R})),n.d(e,"H",(function(){return C}));var r="core/user",i="connected_url_mismatch",a="__global",o="temporary_persist_permission_error",c="adblocker_active",u="googlesitekit_authenticate",s="googlesitekit_setup",f="googlesitekit_view_dashboard",l="googlesitekit_manage_options",d="googlesitekit_read_shared_module_data",g="googlesitekit_manage_module_sharing_options",p="googlesitekit_delegate_module_sharing_management",v="googlesitekit_update_plugins",b="kmAnalyticsAdSenseTopEarningContent",h="kmAnalyticsEngagedTrafficSource",m="kmAnalyticsLeastEngagingPages",y="kmAnalyticsNewVisitors",k="kmAnalyticsPopularAuthors",w="kmAnalyticsPopularContent",O="kmAnalyticsPopularProducts",j="kmAnalyticsReturningVisitors",_="kmAnalyticsTopCities",x="kmAnalyticsTopConvertingTrafficSource",D="kmAnalyticsTopCountries",S="kmAnalyticsTopRecentTrendingPages",E="kmAnalyticsTopTrafficSource",P="kmAnalyticsPagesPerVisit",N="kmAnalyticsVisitLength",A="kmAnalyticsTopReturningVisitorPages",T="kmSearchConsolePopularKeywords",L="kmAnalyticsVisitsPerVisitor",I="kmAnalyticsMostEngagingPages",M="kmAnalyticsTopCategories",R=[b,h,m,y,k,w,O,j,M,_,x,D,S,E,P,N,A,L,I,M],C=[].concat(R,[T])},766:function(t,e,n){"use strict";(function(t){var r=n(5),i=n.n(r),a=n(17),o=n.n(a),c=n(10),u=n.n(c),s=n(323),f=n(176),l=n(39),d=n(8),g=n(37),p=n(866),v=n(7),b=!0,h=function(t,e,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},i=[t,e,n].filter((function(t){return!!t&&t.length}));return 3===i.length&&r&&r.constructor===Object&&Object.keys(r).length&&i.push(Object(d.I)(r)),i.join("::")},m=function(e){var n,r,i,a=null===(n=t.googlesitekit)||void 0===n||null===(r=n.data)||void 0===r||null===(i=r.dispatch)||void 0===i?void 0:i.call(r,v.a);a&&(Object(g.f)(e)?a.setPermissionScopeError(e):Object(g.c)(e)&&a.setAuthError(e))},y=function(){var e=o()(i.a.mark((function e(n,r,a){var o,c,g,v,b,y,k,O,j,_,x,D,S,E,P,N,A,T=arguments;return i.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(o=T.length>3&&void 0!==T[3]?T[3]:{},c=o.bodyParams,g=o.cacheTTL,v=void 0===g?d.b:g,b=o.method,y=void 0===b?"GET":b,k=o.queryParams,O=o.useCache,j=void 0===O?void 0:O,_=o.signal,u()(n,"`type` argument for requests is required."),u()(r,"`identifier` argument for requests is required."),u()(a,"`datapoint` argument for requests is required."),x="GET"===y&&(void 0!==j?j:w()),D=h(n,r,a,k),!x){e.next=18;break}return e.next=9,Object(l.d)(D);case 9:if(S=e.sent,E=S.cacheHit,P=S.value,!S.isError){e.next=16;break}throw m(P),P;case 16:if(!E){e.next=18;break}return e.abrupt("return",P);case 18:return e.prev=18,e.next=21,Object(s.default)({data:c,method:y,signal:_,path:Object(f.a)("/google-site-kit/v1/".concat(n,"/").concat(r,"/data/").concat(a),k)});case 21:if(N=e.sent,!x){e.next=25;break}return e.next=25,Object(l.f)(D,N,{ttl:v});case 25:return e.abrupt("return",N);case 28:if(e.prev=28,e.t0=e.catch(18),!(null==_?void 0:_.aborted)){e.next=32;break}throw e.t0;case 32:if(!(null===e.t0||void 0===e.t0||null===(A=e.t0.data)||void 0===A?void 0:A.cacheTTL)){e.next=35;break}return e.next=35,Object(l.f)(D,e.t0,{ttl:e.t0.data.cacheTTL,isError:!0});case 35:throw Object(p.a)({method:y,datapoint:a,type:n,identifier:r,error:e.t0}),m(e.t0),t.console.error("Google Site Kit API Error","method:".concat(y),"datapoint:".concat(a),"type:".concat(n),"identifier:".concat(r),'error:"'.concat(e.t0.message,'"')),e.t0;case 39:case"end":return e.stop()}}),e,null,[[18,28]])})));return function(t,n,r){return e.apply(this,arguments)}}(),k=function(){var t=o()(i.a.mark((function t(e,n,r,a){var o,c,u,s,f,l,d,g=arguments;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return o=g.length>4&&void 0!==g[4]?g[4]:{},c=o.method,u=void 0===c?"POST":c,s=o.queryParams,f=void 0===s?{}:s,l=o.signal,t.next=3,y(e,n,r,{bodyParams:{data:a},method:u,queryParams:f,useCache:!1,signal:l});case 3:return d=t.sent,t.next=6,O(e,n,r);case 6:return t.abrupt("return",d);case 7:case"end":return t.stop()}}),t)})));return function(e,n,r,i){return t.apply(this,arguments)}}(),w=function(){return b},O=function(){var t=o()(i.a.mark((function t(e,n,r){var a;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return a=h(e,n,r),t.next=3,Object(l.e)();case 3:t.sent.forEach((function(t){new RegExp("^".concat(l.a,"([^_]+_){2}").concat(a)).test(t)&&Object(l.c)(t)}));case 5:case"end":return t.stop()}}),t)})));return function(e,n,r){return t.apply(this,arguments)}}(),j={invalidateCache:O,get:function(t,e,n,r){var i=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{},a=i.cacheTTL,o=void 0===a?d.b:a,c=i.useCache,u=void 0===c?void 0:c,s=i.signal;return y(t,e,n,{cacheTTL:o,queryParams:r,useCache:u,signal:s})},set:k,setUsingCache:function(t){return b=!!t},usingCache:w};e.a=j}).call(this,n(26))},77:function(t,e,n){"use strict";(function(t){n.d(e,"a",(function(){return j})),n.d(e,"d",(function(){return _})),n.d(e,"e",(function(){return D})),n.d(e,"c",(function(){return S})),n.d(e,"b",(function(){return E}));var r=n(15),i=n.n(r),a=n(31),o=n.n(a),c=n(6),u=n.n(c),s=n(22),f=n.n(s),l=n(12),d=n(55),g=n.n(d),p=n(2);function v(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function b(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?v(Object(n),!0).forEach((function(e){u()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):v(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var h=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=k(t,e),r=n.formatUnit,i=n.formatDecimal;try{return r()}catch(t){return i()}},m=function(t){var e=y(t),n=e.hours,r=e.minutes,i=e.seconds;return i=("0"+i).slice(-2),r=("0"+r).slice(-2),"00"===(n=("0"+n).slice(-2))?"".concat(r,":").concat(i):"".concat(n,":").concat(r,":").concat(i)},y=function(t){return t=parseInt(t,10),Number.isNaN(t)&&(t=0),{hours:Math.floor(t/60/60),minutes:Math.floor(t/60%60),seconds:Math.floor(t%60)}},k=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=y(t),r=n.hours,i=n.minutes,a=n.seconds;return{hours:r,minutes:i,seconds:a,formatUnit:function(){var n=e.unitDisplay,o=b(b({unitDisplay:void 0===n?"short":n},f()(e,["unitDisplay"])),{},{style:"unit"});return 0===t?D(a,b(b({},o),{},{unit:"second"})):Object(p.sprintf)(
/* translators: 1: formatted seconds, 2: formatted minutes, 3: formatted hours */
Object(p._x)("%3$s %2$s %1$s","duration of time: hh mm ss","google-site-kit"),a?D(a,b(b({},o),{},{unit:"second"})):"",i?D(i,b(b({},o),{},{unit:"minute"})):"",r?D(r,b(b({},o),{},{unit:"hour"})):"").trim()},formatDecimal:function(){var e=Object(p.sprintf)(// translators: %s: number of seconds with "s" as the abbreviated unit.
Object(p.__)("%ds","google-site-kit"),a);if(0===t)return e;var n=Object(p.sprintf)(// translators: %s: number of minutes with "m" as the abbreviated unit.
Object(p.__)("%dm","google-site-kit"),i),o=Object(p.sprintf)(// translators: %s: number of hours with "h" as the abbreviated unit.
Object(p.__)("%dh","google-site-kit"),r);return Object(p.sprintf)(
/* translators: 1: formatted seconds, 2: formatted minutes, 3: formatted hours */
Object(p._x)("%3$s %2$s %1$s","duration of time: hh mm ss","google-site-kit"),a?e:"",i?n:"",r?o:"").trim()}}},w=function(t){return 1e6<=t?Math.round(t/1e5)/10:1e4<=t?Math.round(t/1e3):1e3<=t?Math.round(t/100)/10:t},O=function(t){var e={minimumFractionDigits:1,maximumFractionDigits:1};return 1e6<=t?Object(p.sprintf)(// translators: %s: an abbreviated number in millions.
Object(p.__)("%sM","google-site-kit"),D(w(t),t%10==0?{}:e)):1e4<=t?Object(p.sprintf)(// translators: %s: an abbreviated number in thousands.
Object(p.__)("%sK","google-site-kit"),D(w(t))):1e3<=t?Object(p.sprintf)(// translators: %s: an abbreviated number in thousands.
Object(p.__)("%sK","google-site-kit"),D(w(t),t%10==0?{}:e)):D(t,{signDisplay:"never",maximumFractionDigits:1})};function j(t){var e={};return"%"===t?e={style:"percent",maximumFractionDigits:2}:"s"===t?e={style:"duration",unitDisplay:"narrow"}:t&&"string"==typeof t?e={style:"currency",currency:t}:Object(l.isPlainObject)(t)&&(e=b({},t)),e}function _(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};t=Object(l.isFinite)(t)?t:Number(t),Object(l.isFinite)(t)||(console.warn("Invalid number",t,o()(t)),t=0);var n=j(e),r=n.style,i=void 0===r?"metric":r;return"metric"===i?O(t):"duration"===i?h(t,n):"durationISO"===i?m(t):D(t,n)}var x=g()(console.warn),D=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=e.locale,r=void 0===n?E():n,a=f()(e,["locale"]);try{return new Intl.NumberFormat(r,a).format(t)}catch(e){x("Site Kit numberFormat error: Intl.NumberFormat( ".concat(JSON.stringify(r),", ").concat(JSON.stringify(a)," ).format( ").concat(o()(t)," )"),e.message)}for(var c={currencyDisplay:"narrow",currencySign:"accounting",style:"unit"},u=["signDisplay","compactDisplay"],s={},l=0,d=Object.entries(a);l<d.length;l++){var g=i()(d[l],2),p=g[0],v=g[1];c[p]&&v===c[p]||(u.includes(p)||(s[p]=v))}try{return new Intl.NumberFormat(r,s).format(t)}catch(e){return new Intl.NumberFormat(r).format(t)}},S=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=e.locale,r=void 0===n?E():n,i=e.style,a=void 0===i?"long":i,o=e.type,c=void 0===o?"conjunction":o;if(Intl.ListFormat){var u=new Intl.ListFormat(r,{style:a,type:c});return u.format(t)}
/* translators: used between list items, there is a space after the comma. */var s=Object(p.__)(", ","google-site-kit");return t.join(s)},E=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:t,n=Object(l.get)(e,["_googlesitekitLegacyData","locale"]);if(n){var r=n.match(/^(\w{2})?(_)?(\w{2})/);if(r&&r[0])return r[0].replace(/_/g,"-")}return e.navigator.language}}).call(this,n(26))},78:function(t,e,n){"use strict";n.d(e,"a",(function(){return o})),n.d(e,"b",(function(){return c}));var r=n(31),i=n.n(r),a=n(79),o=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return{__html:a.a.sanitize(t,e)}};function c(t){var e,n="object"===i()(t)?t.toString():t;return null==n||null===(e=n.replace)||void 0===e?void 0:e.call(n,/\/+$/,"")}},79:function(t,e,n){"use strict";(function(t){n.d(e,"a",(function(){return i}));var r=n(148),i=n.n(r)()(t)}).call(this,n(26))},8:function(t,e,n){"use strict";n.d(e,"J",(function(){return i.b})),n.d(e,"K",(function(){return i.c})),n.d(e,"G",(function(){return a.a})),n.d(e,"L",(function(){return a.b})),n.d(e,"I",(function(){return f})),n.d(e,"n",(function(){return l.a})),n.d(e,"C",(function(){return l.d})),n.d(e,"D",(function(){return l.e})),n.d(e,"z",(function(){return l.c})),n.d(e,"s",(function(){return l.b})),n.d(e,"A",(function(){return v})),n.d(e,"k",(function(){return b})),n.d(e,"j",(function(){return h})),n.d(e,"d",(function(){return j})),n.d(e,"c",(function(){return _})),n.d(e,"e",(function(){return x})),n.d(e,"b",(function(){return D})),n.d(e,"a",(function(){return S})),n.d(e,"g",(function(){return E})),n.d(e,"f",(function(){return P})),n.d(e,"o",(function(){return N})),n.d(e,"x",(function(){return A})),n.d(e,"q",(function(){return T})),n.d(e,"H",(function(){return L})),n.d(e,"t",(function(){return I})),n.d(e,"w",(function(){return M})),n.d(e,"l",(function(){return R})),n.d(e,"p",(function(){return C.b})),n.d(e,"i",(function(){return C.a})),n.d(e,"u",(function(){return U.b})),n.d(e,"r",(function(){return U.a})),n.d(e,"B",(function(){return U.c})),n.d(e,"y",(function(){return F})),n.d(e,"v",(function(){return q})),n.d(e,"F",(function(){return H})),n.d(e,"E",(function(){return K.a})),n.d(e,"h",(function(){return V})),n.d(e,"M",(function(){return G})),n.d(e,"m",(function(){return z}));var r=n(12),i=n(35),a=n(78),o=n(31),c=n.n(o),u=n(94),s=n.n(u),f=function(t){return s()(JSON.stringify(function t(e){var n={};return Object.keys(e).sort().forEach((function(r){var i=e[r];i&&"object"===c()(i)&&!Array.isArray(i)&&(i=t(i)),n[r]=i})),n}(t)))};n(97);var l=n(77);function d(t){return t.replace(new RegExp("\\[([^\\]]+)\\]\\((https?://[^/]+\\.\\w+/?.*?)\\)","gi"),'<a href="$2" target="_blank" rel="noopener noreferrer">$1</a>')}function g(t){return"<p>".concat(t.replace(/\n{2,}/g,"</p><p>"),"</p>")}function p(t){return t.replace(/\n/gi,"<br>")}function v(t){for(var e=t,n=0,r=[d,g,p];n<r.length;n++){e=(0,r[n])(e)}return e}var b=function(t){return t=parseFloat(t),isNaN(t)||0===t?[0,0,0,0]:[Math.floor(t/60/60),Math.floor(t/60%60),Math.floor(t%60),Math.floor(1e3*t)-1e3*Math.floor(t)]},h=function(t){var e=t&&!Number.isInteger(t)?new Date(t).getTime():t;return isNaN(e)||!e?0:e},m=n(15),y=n.n(m),k=n(10),w=n.n(k),O=n(2),j="Invalid dateString parameter, it must be a string.",_='Invalid date range, it must be a string with the format "last-x-days".',x=60,D=60*x,S=24*D,E=7*S,P=30*S;function N(){var t=function(t){return Object(O.sprintf)(
/* translators: %s: number of days */
Object(O._n)("Last %s day","Last %s days",t,"google-site-kit"),t)};return{"last-7-days":{slug:"last-7-days",label:t(7),days:7},"last-14-days":{slug:"last-14-days",label:t(14),days:14},"last-28-days":{slug:"last-28-days",label:t(28),days:28},"last-90-days":{slug:"last-90-days",label:t(90),days:90}}}function A(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";if(!Object(r.isString)(t))return!1;var e=t.split("-");if(3!==e.length)return!1;var n=new Date(t);return Object(r.isDate)(n)&&!isNaN(n)}function T(t){w()(Object(r.isDate)(t)&&!isNaN(t),"Date param must construct to a valid date instance or be a valid date instance itself.");var e="".concat(t.getMonth()+1),n="".concat(t.getDate());return[t.getFullYear(),e.length<2?"0".concat(e):e,n.length<2?"0".concat(n):n].join("-")}function L(t){w()(A(t),j);var e=t.split("-"),n=y()(e,3),r=n[0],i=n[1],a=n[2];return new Date(r,i-1,a)}function I(t,e){return T(R(t,e*S))}function M(t){var e=t.split("-");return 3===e.length&&"last"===e[0]&&!Number.isNaN(e[1])&&!Number.isNaN(parseFloat(e[1]))&&"days"===e[2]}function R(t,e){w()(A(t)||Object(r.isDate)(t)&&!isNaN(t),j);var n=A(t)?Date.parse(t):t.getTime();return new Date(n-1e3*e)}var C=n(98),U=n(83);function F(t){var e=parseFloat(t)||0;return!!Number.isInteger(e)&&e>0}function q(t){if("number"==typeof t)return!0;var e=(t||"").toString();return!!e&&!isNaN(e)}var $=n(27),J=n.n($),H=function(t){return Array.isArray(t)?J()(t).sort():t},K=n(87);function V(t,e){var n=function(t){return"0"===t||0===t};if(n(t)&&n(e))return 0;if(n(t)||Number.isNaN(t))return null;var r=(e-t)/t;return Number.isNaN(r)||!Number.isFinite(r)?null:r}var G=function(t){try{return JSON.parse(t)&&!!t}catch(t){return!1}},z=function(t){if(!t)return"";var e=t.replace(/&#(\d+);/g,(function(t,e){return String.fromCharCode(e)})).replace(/(\\)/g,"");return Object(r.unescape)(e)}},83:function(t,e,n){"use strict";n.d(e,"b",(function(){return i})),n.d(e,"a",(function(){return a})),n.d(e,"c",(function(){return o})),n.d(e,"d",(function(){return c}));var r=n(108);function i(t){try{return new URL(t).pathname}catch(t){}return null}function a(t,e){try{return new URL(e,t).href}catch(t){}return("string"==typeof t?t:"")+("string"==typeof e?e:"")}function o(t){return"string"!=typeof t?t:t.replace(/^https?:\/\/(www\.)?/i,"").replace(/\/$/,"")}function c(t,e){if(!Object(r.a)(t))return t;if(t.length<=e)return t;var n=new URL(t),i=t.replace(n.origin,"");if(i.length<e)return i;var a=i.length-Math.floor(e)+1;return"…"+i.substr(a)}},84:function(t,e,n){"use strict";(function(t){var r=n(1),i=n.n(r),a=n(13),o=n.n(a);function ChangeArrow(e){var n=e.direction,r=e.invertColor,i=e.width,a=e.height;return t.createElement("svg",{className:o()("googlesitekit-change-arrow","googlesitekit-change-arrow--".concat(n),{"googlesitekit-change-arrow--inverted-color":r}),width:i,height:a,viewBox:"0 0 10 10",fill:"none",xmlns:"http://www.w3.org/2000/svg"},t.createElement("path",{d:"M5.625 10L5.625 2.375L9.125 5.875L10 5L5 -1.76555e-07L-2.7055e-07 5L0.875 5.875L4.375 2.375L4.375 10L5.625 10Z",fill:"currentColor"}))}ChangeArrow.propTypes={direction:i.a.string,invertColor:i.a.bool,width:i.a.number,height:i.a.number},ChangeArrow.defaultProps={direction:"up",invertColor:!1,width:9,height:9},e.a=ChangeArrow}).call(this,n(4))},866:function(t,e,n){"use strict";n.d(e,"a",(function(){return f}));var r=n(5),i=n.n(r),a=n(17),o=n.n(a),c=n(8),u=["fetch_error"],s=["core/site/data/connection-check"];function f(t){return l.apply(this,arguments)}function l(){return(l=o()(i.a.mark((function t(e){var n,r,a,o,f,l,d,g,p;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(a=e.method,o=e.type,f=e.identifier,l=e.datapoint,d=e.error,g="".concat(o,"/").concat(f,"/data/").concat(l),!s.includes(g)){t.next=4;break}return t.abrupt("return");case 4:if(d&&!u.includes(null==d?void 0:d.code)){t.next=6;break}return t.abrupt("return");case 6:return p="code: ".concat(d.code),(null===(n=d.data)||void 0===n?void 0:n.reason)&&(p+=", reason: ".concat(d.data.reason)),t.next=10,Object(c.J)("api_error","".concat(a,":").concat(o,"/").concat(f,"/data/").concat(l),"".concat(d.message," (").concat(p,")"),(null===(r=d.data)||void 0===r?void 0:r.status)||d.code);case 10:case"end":return t.stop()}}),t)})))).apply(this,arguments)}},87:function(t,e,n){"use strict";n.d(e,"a",(function(){return a}));var r=n(10),i=n.n(r),a=function(t,e){var n=e.dateRangeLength;i()(Array.isArray(t),"report must be an array to partition."),i()(Number.isInteger(n)&&n>0,"dateRangeLength must be a positive integer.");var r=-1*n;return{currentRange:t.slice(r),compareRange:t.slice(2*r,r)}}},97:function(t,e,n){"use strict";(function(t){n(48),n(49)}).call(this,n(26))},98:function(t,e,n){"use strict";(function(t){n.d(e,"b",(function(){return a})),n.d(e,"a",(function(){return o}));var r=n(226),i=n(84),a=function(e){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};if(Number.isNaN(Number(e)))return"";var a=n.invertColor,o=void 0!==a&&a;return Object(r.a)(t.createElement(i.a,{direction:e>0?"up":"down",invertColor:o}))},o=function(t,e){return t>0&&e>0?t/e-1:t>0?1:e>0?-1:0}}).call(this,n(4))},99:function(t,e,n){"use strict";(function(t){n.d(e,"a",(function(){return l}));var r=n(6),i=n.n(r),a=n(12),o=n(100),c=n(101);function u(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function s(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?u(Object(n),!0).forEach((function(e){i()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):u(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var f={activeModules:[],isAuthenticated:!1,referenceSiteURL:"",trackingEnabled:!1,trackingID:"",userIDHash:"",userRoles:[]};function l(e){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:t,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:t,i=s(s({},f),e);i.referenceSiteURL&&(i.referenceSiteURL=i.referenceSiteURL.toString().replace(/\/+$/,""));var u=Object(o.a)(i,n),l=Object(c.a)(i,n,u,r),d={},g=function(){for(var t=arguments.length,e=new Array(t),n=0;n<t;n++)e[n]=arguments[n];var r=JSON.stringify(e);d[r]||(d[r]=Object(a.once)(l)),d[r].apply(d,e)};return{enableTracking:function(){i.trackingEnabled=!0},disableTracking:function(){i.trackingEnabled=!1},initializeSnippet:u,isTrackingEnabled:function(){return!!i.trackingEnabled},trackEvent:l,trackEventOnce:g}}}).call(this,n(26))}},[[1098,1,0]]]);