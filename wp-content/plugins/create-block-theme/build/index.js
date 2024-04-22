(()=>{"use strict";var e,t,n,a,r={7047:(e,t,n)=>{function a(e,t,n){let a;Object.defineProperty(e,t,{get:()=>a||(a=n(),a),enumerable:!0})}n.d(t,{Z:()=>a})},2592:(e,t,n)=>{n.d(t,{x:()=>r});var a=n(6770);class r extends a.j{constructor(e,t,n){const{parser:r,start:o}=super(new a._(e,t,n)),l={enumerable:!1,get:()=>r};Object.defineProperty(this,"p",l);const i={enumerable:!1,get:()=>o};Object.defineProperty(this,"tableStart",i)}}},6770:(e,t,n)=>{n.d(t,{_:()=>r,j:()=>o});const a=new Date("1904-01-01T00:00:00+0000").getTime();class r{constructor(e,t,n){this.name=(n||e.tag||"").trim(),this.length=e.length,this.start=e.offset,this.offset=0,this.data=t,["getInt8","getUint8","getInt16","getUint16","getInt32","getUint32","getBigInt64","getBigUint64"].forEach((e=>{let t=e.replace(/get(Big)?/,"").toLowerCase(),n=parseInt(e.replace(/[^\d]/g,""))/8;Object.defineProperty(this,t,{get:()=>this.getValue(e,n)})}))}get currentPosition(){return this.start+this.offset}set currentPosition(e){this.start=e,this.offset=0}skip(e=0,t=8){this.offset+=e*t/8}getValue(e,t){let n=this.start+this.offset;this.offset+=t;try{return this.data[e](n)}catch(n){throw console.error("parser",e,t,this),console.error("parser",this.start,this.offset),n}}flags(e){if(8===e||16===e||32===e||64===e)return this[`uint${e}`].toString(2).padStart(e,0).split("").map((e=>"1"===e));console.error("Error parsing flags: flag types can only be 1, 2, 4, or 8 bytes long"),console.trace()}get tag(){const e=this.uint32;return t=[e>>24&255,e>>16&255,e>>8&255,255&e],Array.from(t).map((e=>String.fromCharCode(e))).join("");var t}get fixed(){return this.int16+Math.round(1e3*this.uint16/65356)/1e3}get legacyFixed(){let e=this.uint16,t=this.uint16.toString(16).padStart(4,0);return parseFloat(`${e}.${t}`)}get uint24(){return(this.uint8<<16)+(this.uint8<<8)+this.uint8}get uint128(){let e=0;for(let t=0;t<5;t++){let t=this.uint8;if(e=128*e+(127&t),t<128)break}return e}get longdatetime(){return new Date(a+1e3*parseInt(this.int64.toString()))}get fword(){return this.int16}get ufword(){return this.uint16}get Offset16(){return this.uint16}get Offset32(){return this.uint32}get F2DOT14(){const e=p.uint16;return[0,1,-2,-1][e>>14]+(16383&e)/16384}verifyLength(){this.offset!=this.length&&console.error(`unexpected parsed table size (${this.offset}) for "${this.name}" (expected ${this.length})`)}readBytes(e=0,t=0,n=8,a=!1){if(0===(e=e||this.length))return[];t&&(this.currentPosition=t);const r=`${a?"":"u"}int${n}`,o=[];for(;e--;)o.push(this[r]);return o}}class o{constructor(e){const t={enumerable:!1,get:()=>e};Object.defineProperty(this,"parser",t);const n=e.currentPosition,a={enumerable:!1,get:()=>n};Object.defineProperty(this,"start",a)}load(e){Object.keys(e).forEach((t=>{let n=Object.getOwnPropertyDescriptor(e,t);n.get?this[t]=n.get.bind(this):void 0!==n.value&&(this[t]=n.value)})),this.parser.length&&this.parser.verifyLength()}}}},o={};function l(e){var t=o[e];if(void 0!==t)return t.exports;var n=o[e]={exports:{}};return r[e](n,n.exports,l),n.exports}l.m=r,t=Object.getPrototypeOf?e=>Object.getPrototypeOf(e):e=>e.__proto__,l.t=function(n,a){if(1&a&&(n=this(n)),8&a)return n;if("object"==typeof n&&n){if(4&a&&n.__esModule)return n;if(16&a&&"function"==typeof n.then)return n}var r=Object.create(null);l.r(r);var o={};e=e||[null,t({}),t([]),t(t)];for(var i=2&a&&n;"object"==typeof i&&!~e.indexOf(i);i=t(i))Object.getOwnPropertyNames(i).forEach((e=>o[e]=()=>n[e]));return o.default=()=>n,l.d(r,o),r},l.d=(e,t)=>{for(var n in t)l.o(t,n)&&!l.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},l.f={},l.e=e=>Promise.all(Object.keys(l.f).reduce(((t,n)=>(l.f[n](e,t),t)),[])),l.u=e=>e+".js",l.miniCssF=e=>{},l.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),l.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),n={},a="create-block-theme:",l.l=(e,t,r,o)=>{if(n[e])n[e].push(t);else{var i,s;if(void 0!==r)for(var c=document.getElementsByTagName("script"),h=0;h<c.length;h++){var m=c[h];if(m.getAttribute("src")==e||m.getAttribute("data-webpack")==a+r){i=m;break}}i||(s=!0,(i=document.createElement("script")).charset="utf-8",i.timeout=120,l.nc&&i.setAttribute("nonce",l.nc),i.setAttribute("data-webpack",a+r),i.src=e),n[e]=[t];var u=(t,a)=>{i.onerror=i.onload=null,clearTimeout(f);var r=n[e];if(delete n[e],i.parentNode&&i.parentNode.removeChild(i),r&&r.forEach((e=>e(a))),t)return t(a)},f=setTimeout(u.bind(null,void 0,{type:"timeout",target:i}),12e4);i.onerror=u.bind(null,i.onerror),i.onload=u.bind(null,i.onload),s&&document.head.appendChild(i)}},l.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},(()=>{var e;l.g.importScripts&&(e=l.g.location+"");var t=l.g.document;if(!e&&t&&(t.currentScript&&(e=t.currentScript.src),!e)){var n=t.getElementsByTagName("script");if(n.length)for(var a=n.length-1;a>-1&&!e;)e=n[a--].src}if(!e)throw new Error("Automatic publicPath is not supported in this browser");e=e.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),l.p=e})(),(()=>{var e={826:0};l.f.j=(t,n)=>{var a=l.o(e,t)?e[t]:void 0;if(0!==a)if(a)n.push(a[2]);else{var r=new Promise(((n,r)=>a=e[t]=[n,r]));n.push(a[2]=r);var o=l.p+l.u(t),i=new Error;l.l(o,(n=>{if(l.o(e,t)&&(0!==(a=e[t])&&(e[t]=void 0),a)){var r=n&&("load"===n.type?"missing":n.type),o=n&&n.target&&n.target.src;i.message="Loading chunk "+t+" failed.\n("+r+": "+o+")",i.name="ChunkLoadError",i.type=r,i.request=o,a[1](i)}}),"chunk-"+t,t)}};var t=(t,n)=>{var a,r,[o,i,s]=n,c=0;if(o.some((t=>0!==e[t]))){for(a in i)l.o(i,a)&&(l.m[a]=i[a]);s&&s(l)}for(t&&t(n);c<o.length;c++)r=o[c],l.o(e,r)&&e[r]&&e[r][0](),e[r]=0},n=globalThis.webpackChunkcreate_block_theme=globalThis.webpackChunkcreate_block_theme||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))})(),(()=>{const e=window.React,t=window.wp.element,n=window.wp.i18n,a=window.wp.components,r=(0,n.__)("The quick brown fox jumps over the lazy dog.","create-block-theme"),o=(0,n.__)("Incredible as it may seem, I believe that the Aleph of Garay Street was a false Aleph.","create-block-theme"),i=(0,n.__)("First a glass of pseudo-cognac, he ordered, and then down you dive into the cellar. Let me warn you, you'll have to lie flat on your back. Total darkness, total immobility, and a certain ocular adjustment will also be necessary. From the floor, you must focus your eyes on the nineteenth step. Once I leave you, I'll lower the trapdoor and you'll be quite alone. You needn't fear the rodents very much though I know you will. In a minute or two, you'll see the Aleph, the microcosm of the alchemists and Kabbalists, our true proverbial friend, the multum in parvo!","create-block-theme"),s="sentence",c={heading:{text:r,size:30,lineHeight:1.1,margin:"0.5em 0",component:"h2"},sentence:{text:o,size:20,lineHeight:1.3,margin:"0.5em 0",component:"p"},paragraph:{text:i,size:16,lineHeight:1.5,margin:"0.5em 0",component:"p"}},h=(0,t.createContext)();function m({children:n}){const[a,r]=(0,t.useState)(localStorage.getItem("cbt_default-demo-type")||s),[o,l]=(0,t.useState)(localStorage.getItem("cbt_default-demo-text")||c[a].text),[i,m]=(0,t.useState)(parseInt(localStorage.getItem("cbt_default-demo-font-size"))||c[a].size),[u,f]=(0,t.useState)({}),d=e=>{l(e),localStorage.setItem("cbt_default-demo-text",e)},p=e=>{m(e),localStorage.setItem("cbt_default-demo-font-size",e)},g=e=>{d(c[e||a].text),p(c[e||a].size)},[b,y]=(0,t.useState)(JSON.parse(localStorage.getItem("cbt_families-open"))||[]);return(0,e.createElement)(h.Provider,{value:{demoText:o,handleDemoTextChange:d,resetDefaults:g,demoType:a,handleDemoTypeChange:e=>{r(e),localStorage.setItem("cbt_default-demo-type",e),g(e)},demoFontSize:i,handleDemoFontSizeChange:p,familiesOpen:b,handleToggleFamily:e=>{let t=[];t=b.includes(e)?b.filter((t=>t!==e)):[...b,e],y(t),localStorage.setItem("cbt_families-open",JSON.stringify(t))},axes:u,handleAxesChange:(e,t)=>{f({...u,[e]:{...u[e],currentValue:t}})}}},n)}const u=function({style:n}){const{demoText:a,demoType:r,demoFontSize:o}=(0,t.useContext)(h),l=c[r].component,i={...n,fontSize:`${o}px`,lineHeight:c[r].lineHeight,margin:c[r].margin};return(0,e.createElement)("div",null,(0,e.createElement)(l,{style:i},a))};function f(e){return e.includes("italic")?"italic":"normal"}function d(e){return"regular"===e||"italic"===e?"400":e.replace("italic","")}function p(e){const t={normal:(0,n._x)("Normal","Font style","create-block-theme"),italic:(0,n._x)("Italic","Font style","create-block-theme")};return void 0!==t[e]?t[e]:e}function g(e){return e.replace("http://","https://")}function b(e){const t=["Bytes","KB","MB","GB","TB"];if(0===e)return(0,n.__)("n/a","create-block-theme");const a=parseInt(Math.floor(Math.log(e)/Math.log(1024)));return 0===a?e+" "+t[a]:(e/Math.pow(1024,a)).toFixed(1)+" "+t[a]}function y(e){return`'${e}'`.trim()}const v=window.wp.primitives,w=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"m11.3 17.2-5-5c-.1-.1-.1-.3 0-.4l2.3-2.3-1.1-1-2.3 2.3c-.7.7-.7 1.8 0 2.5l5 5H7.5v1.5h5.3v-5.2h-1.5v2.6zm7.5-6.4-5-5h2.7V4.2h-5.2v5.2h1.5V6.8l5 5c.1.1.1.3 0 .4l-2.3 2.3 1.1 1.1 2.3-2.3c.6-.7.6-1.9-.1-2.5z"})),E=function({axis:t,setAxisCurrentValue:r}){return(0,e.createElement)("div",null,(0,e.createElement)(a.RangeControl,{label:t.tag+" "+(0,n.__)("font axis:","create-block-theme"),name:`font-axis-${t.tag}`,id:`font-axis-${t.tag}`,min:parseInt(t.minValue),max:parseInt(t.maxValue),value:parseInt(t.currentValue),onChange:e=>{r(t.tag,e)},step:1}))},_=function({axes:t,setAxes:n}){const a=(e,a)=>{n({...t,[e]:{...t[e],currentValue:a}})};return(0,e.createElement)(e.Fragment,null,t&&Object.keys(t).length&&(0,e.createElement)(e.Fragment,null,Object.keys(t).map((n=>(0,e.createElement)(E,{axis:t[n],key:`axis-range-${n}`,setAxisCurrentValue:a})))))},k=function({axes:r,setAxes:o,resetAxes:l}){const{demoText:i,handleDemoTextChange:s,demoType:c,handleDemoTypeChange:m,demoFontSize:u,handleDemoFontSizeChange:f,resetDefaults:d}=(0,t.useContext)(h);return(0,e.createElement)("div",{className:"demo-text-input"},(0,e.createElement)("div",{className:"container"},(0,e.createElement)("div",{className:"controls"},(0,e.createElement)("div",{className:"standard-controls"},(0,e.createElement)(a.SelectControl,{label:(0,n.__)("Preview type","create-block-theme"),onChange:m,value:c},(0,e.createElement)("option",{value:"heading"},(0,n.__)("Heading","create-block-theme")),(0,e.createElement)("option",{value:"sentence"},(0,n.__)("Sentence","create-block-theme")),(0,e.createElement)("option",{value:"paragraph"},(0,n.__)("Paragraph","create-block-theme"))),(0,e.createElement)(a.__experimentalInputControl,{label:(0,n.__)("Demo text","create-block-theme"),value:i,onChange:s}),(0,e.createElement)("div",null,(0,e.createElement)(a.RangeControl,{label:(0,n.__)("Font size (px)","create-block-theme"),value:u,onChange:f,min:8,max:140,withInputField:!0}))),!!r&&!!Object.keys(r).length&&(0,e.createElement)("div",{className:"extra-controls"},(0,e.createElement)(_,{axes:r,setAxes:o}))),(0,e.createElement)("div",null,(0,e.createElement)(a.Button,{variant:"secondary",icon:w,onClick:()=>{d("sentence"),m("sentence"),l?.()}},(0,n.__)("Reset","create-block-theme")))))},S=function(t){return(0,e.createElement)("div",{className:"fonts-page-layout"},t.children)},x=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"M20 5h-5.7c0-1.3-1-2.3-2.3-2.3S9.7 3.7 9.7 5H4v2h1.5v.3l1.7 11.1c.1 1 1 1.7 2 1.7h5.7c1 0 1.8-.7 2-1.7l1.7-11.1V7H20V5zm-3.2 2l-1.7 11.1c0 .1-.1.2-.3.2H9.1c-.1 0-.3-.1-.3-.2L7.2 7h9.6z"})),F=function({title:r,fontsOutline:o,handleDeleteFontFace:l,handleDeleteFontFamily:i}){const[s,c]=(0,t.useState)({}),h=Object.keys(o).map((e=>o[e].faces.map((t=>({family:e,weight:t.weight,style:t.style,src:t.src}))))).flat();(0,t.useEffect)((()=>{const e=h.map((e=>fetch(e.src,{method:"HEAD"})));Promise.all(e).then((e=>{const t={};e.forEach((e=>{t[e.url]=e.headers.get("content-length")})),c(t)}))}),[o]);const m=Object.keys(o).reduce(((e,t)=>e+o[t].faces.length),0),u=b(h.reduce(((e,t)=>e+parseInt(s[t.src])),0));return(0,e.createElement)("div",{className:"sidebar"},(0,e.createElement)("div",{className:"sidebar-container"},(0,e.createElement)("div",{className:"variants-outline"},(0,e.createElement)("h2",null,r),(0,e.createElement)("h3",null,o.family),!!o&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)("div",{className:"variants-list"},(0,e.createElement)("div",{className:"content"},Object.keys(o).map(((t,r)=>(0,e.createElement)("div",{className:"variants-family",key:`variants-family-${r}`},(0,e.createElement)("div",{className:"header"},(0,e.createElement)("span",{className:"name"},o[t].family," "),(0,e.createElement)("div",null,(0,e.createElement)("span",{className:"variants"},!!o[t].faces.length&&(0,e.createElement)(e.Fragment,null,sprintf(
// translators: %s: Variants information.
(0,n.__)("( %s )","create-block-theme"),sprintf(
// translators: %d: Number of variants.
(0,n._n)("%d Variant","%d Variants",o[t].faces.length,"create-block-theme"),o[t].faces.length)))),(0,e.createElement)(a.Button,{icon:x,iconSize:15,isSmall:!0,onClick:()=>i(o[t].family)}))),o[t].faces.map(((n,r)=>{return(0,e.createElement)("div",{className:"variant-row",key:`selected-variant-${r}`},(0,e.createElement)("div",{className:"variant"},n.weight," ",p(n.style)),(0,e.createElement)("div",{className:"size"},(i=n.src,s[i]?b(s[i]):null)),(0,e.createElement)("div",null,(0,e.createElement)(a.Button,{onClick:()=>l(o[t].family,n.weight,n.style),icon:x,iconSize:15,isSmall:!0})));var i})))))))),(0,e.createElement)("div",{className:"variants-total"},(0,e.createElement)("div",{className:"variant"},sprintf(
// translators: %d: Number of variants.
(0,n._n)("%d Variant","%d Variants",m,"create-block-theme"),m)),(0,e.createElement)("div",{className:"size"},u)))))};function T(){return(0,e.createElement)("div",{style:{display:"flex",alignItems:"center",justifyContent:"center"}},(0,e.createElement)("div",{style:{width:"600px",marginTop:"2rem",display:"flex",flexDirection:"column",alignItems:"center",textAlign:"center"}},(0,e.createElement)("h1",{style:{width:"400px",lineHeight:1.4}},(0,n.__)("The new Font Library is now available in the WordPress editor.","create-block-theme")),(0,e.createElement)("p",null,(0,n.__)("You can manage your theme fonts directly from the","create-block-theme")," ",(0,e.createElement)("a",{href:"/wp-admin/site-editor.php?canvas=edit"},(0,n._x)("editor","Link to the site editor","create-block-theme")),"."),(0,e.createElement)("img",{src:"https://i0.wp.com/wordpress.org/news/files/2024/04/Font-Manager-2.png?w=620&ssl=1",alt:"WordPress 6.5 Font Library"}),(0,e.createElement)("p",null,(0,n.__)("For more information, please check out","create-block-theme")," ",(0,e.createElement)("a",{href:"https://wordpress.org/news/2024/04/regina/"},"What's inside 6.5"),".")))}const C=window.wp.data,O=window.wp.coreData;let j=globalThis.fetch;if(!j){let e=[];j=globalThis.fetch=(...t)=>new Promise(((n,a)=>{e.push({args:t,resolve:n,reject:a})})),l.e(83).then(l.t.bind(l,5083,19)).then((t=>{for(j=globalThis.fetch=async function(e){return new Promise(((n,a)=>{t.readFile(e,((e,t)=>{if(e)return a(e);n({ok:!0,arrayBuffer:()=>t.buffer})}))}))};e.length;){let t=e.shift();j(...t.args).then((e=>t.resolve(e))).catch((e=>t.reject(e)))}})).catch((e=>{throw console.error(e),new Error("lib-font cannot run unless either the Fetch API or Node's filesystem module is available.")}))}class N{constructor(e,t={},n){this.type=e,this.detail=t,this.msg=n,Object.defineProperty(this,"__mayPropagate",{enumerable:!1,writable:!0}),this.__mayPropagate=!0}preventDefault(){}stopPropagation(){this.__mayPropagate=!1}valueOf(){return this}toString(){return this.msg?`[${this.type} event]: ${this.msg}`:`[${this.type} event]`}}class L{constructor(){this.listeners={}}addEventListener(e,t,n){let a=this.listeners[e]||[];n?a.unshift(t):a.push(t),this.listeners[e]=a}removeEventListener(e,t){let n=this.listeners[e]||[],a=n.findIndex((e=>e===t));a>-1&&(n.splice(a,1),this.listeners[e]=n)}dispatch(e){let t=this.listeners[e.type];if(t)for(let n=0,a=t.length;n<a&&e.__mayPropagate;n++)t[n](e)}}var P=l(2592),V=l(7047);class $ extends P.x{constructor(e,t,n){const{p:a}=super({offset:0,length:12},t,"sfnt");this.version=a.uint32,this.numTables=a.uint16,this.searchRange=a.uint16,this.entrySelector=a.uint16,this.rangeShift=a.uint16,a.verifyLength(),this.directory=[...new Array(this.numTables)].map((e=>new D(a))),this.tables={},this.directory.forEach((e=>{(0,V.Z)(this.tables,e.tag.trim(),(()=>n(this.tables,{tag:e.tag,offset:e.offset,length:e.length},t)))}))}}class D{constructor(e){this.tag=e.tag,this.checksum=e.uint32,this.offset=e.uint32,this.length=e.uint32}}const B=globalThis.pako?globalThis.pako.inflate:void 0;let I;B||l.e(952).then(l.t.bind(l,952,19)).then((e=>{I=t=>e.unzipSync(t)}));class A extends P.x{constructor(e,t,n){const{p:a}=super({offset:0,length:44},t,"woff");this.signature=a.tag,this.flavor=a.uint32,this.length=a.uint32,this.numTables=a.uint16,a.uint16,this.totalSfntSize=a.uint32,this.majorVersion=a.uint16,this.minorVersion=a.uint16,this.metaOffset=a.uint32,this.metaLength=a.uint32,this.metaOrigLength=a.uint32,this.privOffset=a.uint32,this.privLength=a.uint32,a.verifyLength(),this.directory=[...new Array(this.numTables)].map((e=>new z(a))),G(this,t,n)}}class z{constructor(e){this.tag=e.tag,this.offset=e.uint32,this.compLength=e.uint32,this.origLength=e.uint32,this.origChecksum=e.uint32}}function G(e,t,n){e.tables={},e.directory.forEach((a=>{(0,V.Z)(e.tables,a.tag.trim(),(()=>{let r=0,o=t;if(a.compLength!==a.origLength){const e=t.buffer.slice(a.offset,a.offset+a.compLength);let n;if(B)n=B(new Uint8Array(e));else{if(!I){const e="no brotli decoder available to decode WOFF2 font";throw font.onerror&&font.onerror(e),new Error(e)}n=I(new Uint8Array(e))}o=new DataView(n.buffer)}else r=a.offset;return n(e.tables,{tag:a.tag,offset:r,length:a.origLength},o)}))}))}const U=globalThis.unbrotli;let R;U||l.e(952).then(l.t.bind(l,952,19)).then((e=>{R=t=>e.brotliDecompressSync(t)}));class W extends P.x{constructor(e,t,n){const{p:a}=super({offset:0,length:48},t,"woff2");this.signature=a.tag,this.flavor=a.uint32,this.length=a.uint32,this.numTables=a.uint16,a.uint16,this.totalSfntSize=a.uint32,this.totalCompressedSize=a.uint32,this.majorVersion=a.uint16,this.minorVersion=a.uint16,this.metaOffset=a.uint32,this.metaLength=a.uint32,this.metaOrigLength=a.uint32,this.privOffset=a.uint32,this.privLength=a.uint32,a.verifyLength(),this.directory=[...new Array(this.numTables)].map((e=>new H(a)));let r,o=a.currentPosition;this.directory[0].offset=0,this.directory.forEach(((e,t)=>{let n=this.directory[t+1];n&&(n.offset=e.offset+(void 0!==e.transformLength?e.transformLength:e.origLength))}));let l=t.buffer.slice(o);if(U)r=U(new Uint8Array(l));else{if(!R){const t="no brotli decoder available to decode WOFF2 font";throw e.onerror&&e.onerror(t),new Error(t)}r=new Uint8Array(R(l))}!function(e,t,n){e.tables={},e.directory.forEach((a=>{(0,V.Z)(e.tables,a.tag.trim(),(()=>{const r=a.offset,o=r+(a.transformLength?a.transformLength:a.origLength),l=new DataView(t.slice(r,o).buffer);try{return n(e.tables,{tag:a.tag,offset:0,length:a.origLength},l)}catch(e){console.error(e)}}))}))}(this,r,n)}}class H{constructor(e){this.flags=e.uint8;const t=this.tagNumber=63&this.flags;this.tag=63===t?e.tag:["cmap","head","hhea","hmtx","maxp","name","OS/2","post","cvt ","fpgm","glyf","loca","prep","CFF ","VORG","EBDT","EBLC","gasp","hdmx","kern","LTSH","PCLT","VDMX","vhea","vmtx","BASE","GDEF","GPOS","GSUB","EBSC","JSTF","MATH","CBDT","CBLC","COLR","CPAL","SVG ","sbix","acnt","avar","bdat","bloc","bsln","cvar","fdsc","feat","fmtx","fvar","gvar","hsty","just","lcar","mort","morx","opbd","prop","trak","Zapf","Silf","Glat","Gloc","Feat","Sill"][63&t];let n=0!=(this.transformVersion=(192&this.flags)>>6);"glyf"!==this.tag&&"loca"!==this.tag||(n=3!==this.transformVersion),this.origLength=e.uint128,n&&(this.transformLength=e.uint128)}}const M={};let J=!1;function q(e,t,n){let a=t.tag.replace(/[^\w\d]/g,""),r=M[a];return r?new r(t,n,e):(console.warn(`lib-font has no definition for ${a}. The table was skipped.`),{})}function Z(){let e=0;function t(n,a){if(!J)return e>10?a(new Error("loading took too long")):(e++,setTimeout((()=>t(n)),250));n(q)}return new Promise(((e,n)=>t(e)))}Promise.all([l.e(915).then(l.bind(l,3915)),l.e(612).then(l.bind(l,612)),l.e(162).then(l.bind(l,4162)),l.e(590).then(l.bind(l,3590)),l.e(543).then(l.bind(l,6543)),l.e(132).then(l.bind(l,9132)),l.e(196).then(l.bind(l,2196)),l.e(154).then(l.bind(l,9154)),l.e(701).then(l.bind(l,1701)),l.e(356).then(l.bind(l,6356)),Promise.all([l.e(197),l.e(800)]).then(l.bind(l,2800)),Promise.all([l.e(197),l.e(169)]).then(l.bind(l,4169)),l.e(768).then(l.bind(l,3768)),l.e(538).then(l.bind(l,5538)),l.e(469).then(l.bind(l,8469)),l.e(633).then(l.bind(l,8633)),l.e(73).then(l.bind(l,3073)),l.e(131).then(l.bind(l,2131)),l.e(233).then(l.bind(l,2233)),l.e(906).then(l.bind(l,2906)),l.e(959).then(l.bind(l,5959)),l.e(685).then(l.bind(l,4685)),l.e(694).then(l.bind(l,5694)),l.e(509).then(l.bind(l,8509)),l.e(234).then(l.bind(l,7234)),l.e(729).then(l.bind(l,9729)),l.e(665).then(l.bind(l,9665)),l.e(176).then(l.bind(l,6176)),l.e(312).then(l.bind(l,6312)),l.e(68).then(l.bind(l,68)),l.e(376).then(l.bind(l,6376)),l.e(905).then(l.bind(l,7905)),l.e(618).then(l.bind(l,2618)),l.e(209).then(l.bind(l,9209)),l.e(422).then(l.bind(l,5422)),l.e(257).then(l.bind(l,5257)),l.e(122).then(l.bind(l,9122)),l.e(330).then(l.bind(l,5330)),l.e(521).then(l.bind(l,4521)),l.e(497).then(l.bind(l,2497)),l.e(506).then(l.bind(l,6506))]).then((e=>{e.forEach((e=>{let t=Object.keys(e)[0];M[t]=e[t]})),J=!0}));const K=[0,1,0,0],Y=[79,84,84,79],X=[119,79,70,70],Q=[119,79,70,50];function ee(e,t){if(e.length===t.length){for(let n=0;n<e.length;n++)if(e[n]!==t[n])return;return!0}}class te extends L{constructor(e,t={}){super(),this.name=e,this.options=t,this.metrics=!1}get src(){return this.__src}set src(e){this.__src=e,(async()=>{globalThis.document&&!this.options.skipStyleSheet&&await async function(e,t,n={}){if(!globalThis.document)return;let a=function(e,t){let n=e.lastIndexOf("."),a=(e.substring(n+1)||"").toLowerCase(),r={ttf:"truetype",otf:"opentype",woff:"woff",woff2:"woff2"}[a];if(r)return r;let o={eot:"The .eot format is not supported: it died in January 12, 2016, when Microsoft retired all versions of IE that didn't already support WOFF.",svg:"The .svg format is not supported: SVG fonts (not to be confused with OpenType with embedded SVG) were so bad we took the entire fonts chapter out of the SVG specification again.",fon:"The .fon format is not supported: this is an ancient Windows bitmap font format.",ttc:"Based on the current CSS specification, font collections are not (yet?) supported."}[a];if(o||(o=`${e} is not a known webfont format.`),t)throw new Error(o);console.warn(`Could not load font: ${o}`)}(t,n.errorOnStyle);if(!a)return;let r=document.createElement("style");r.className="injected-by-Font-js";let o=[];return n.styleRules&&(o=Object.entries(n.styleRules).map((([e,t])=>`${e}: ${t};`))),r.textContent=`\n@font-face {\n    font-family: "${e}";\n    ${o.join("\n\t")}\n    src: url("${t}") format("${a}");\n}`,globalThis.document.head.appendChild(r),r}(this.name,e,this.options),this.loadFont(e)})()}async loadFont(e,t){fetch(e).then((e=>function(e){if(!e.ok)throw new Error(`HTTP ${e.status} - ${e.statusText}`);return e}(e)&&e.arrayBuffer())).then((n=>this.fromDataBuffer(n,t||e))).catch((n=>{const a=new N("error",n,`Failed to load font at ${t||e}`);this.dispatch(a),this.onerror&&this.onerror(a)}))}async fromDataBuffer(e,t){this.fontData=new DataView(e);let n=function(e){const t=[e.getUint8(0),e.getUint8(1),e.getUint8(2),e.getUint8(3)];return ee(t,K)||ee(t,Y)?"SFNT":ee(t,X)?"WOFF":ee(t,Q)?"WOFF2":void 0}(this.fontData);if(!n)throw new Error(`${t} is either an unsupported font format, or not a font at all.`);await this.parseBasicData(n);const a=new N("load",{font:this});this.dispatch(a),this.onload&&this.onload(a)}async parseBasicData(e){return Z().then((t=>("SFNT"===e&&(this.opentype=new $(this,this.fontData,t)),"WOFF"===e&&(this.opentype=new A(this,this.fontData,t)),"WOFF2"===e&&(this.opentype=new W(this,this.fontData,t)),this.opentype)))}getGlyphId(e){return this.opentype.tables.cmap.getGlyphId(e)}reverse(e){return this.opentype.tables.cmap.reverse(e)}supports(e){return 0!==this.getGlyphId(e)}supportsVariation(e){return!1!==this.opentype.tables.cmap.supportsVariation(e)}measureText(e,t=16){if(this.__unloaded)throw new Error("Cannot measure text: font was unloaded. Please reload before calling measureText()");let n=document.createElement("div");n.textContent=e,n.style.fontFamily=this.name,n.style.fontSize=`${t}px`,n.style.color="transparent",n.style.background="transparent",n.style.top="0",n.style.left="0",n.style.position="absolute",document.body.appendChild(n);let a=n.getBoundingClientRect();document.body.removeChild(n);const r=this.opentype.tables["OS/2"];return a.fontSize=t,a.ascender=r.sTypoAscender,a.descender=r.sTypoDescender,a}unload(){if(this.styleElement.parentNode){this.styleElement.parentNode.removeElement(this.styleElement);const e=new N("unload",{font:this});this.dispatch(e),this.onunload&&this.onunload(e)}this._unloaded=!0}load(){if(this.__unloaded){delete this.__unloaded,document.head.appendChild(this.styleElement);const e=new N("load",{font:this});this.dispatch(e),this.onload&&this.onload(e)}}}globalThis.Font=te;const ne=function({font:n,variant:a,isSelected:r,handleToggle:o}){const l=a.includes("italic")?"italic":"normal",i="regular"===a||"italic"===a?"400":a.replace("italic",""),s=n.files[a].replace("http://","https://"),c={fontFamily:n.family,fontStyle:l,fontWeight:i};(0,t.useEffect)((()=>{const e=y(n.family),t=new FontFace(e,`url( ${s} )`,{style:l,weight:i});(async()=>{try{const e=await t.load();document.fonts.add(e)}catch(e){console.error(e)}})()}),[n,l,a,s,i]);const h=`${n.family.toLowerCase().replace(" ","-")}-${a}`;return(0,e.createElement)("tr",null,(0,e.createElement)("td",{className:""},(0,e.createElement)("input",{type:"checkbox",name:"google-font-variant",id:h,value:a,checked:r,onChange:o})),(0,e.createElement)("td",{className:""},(0,e.createElement)("label",{htmlFor:h},i)),(0,e.createElement)("td",{className:""},(0,e.createElement)("label",{htmlFor:h},p(l))),(0,e.createElement)("td",{className:"demo-cell"},(0,e.createElement)("label",{htmlFor:h},(0,e.createElement)(u,{id:h,style:c}))))},ae=(0,e.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,e.createElement)(v.Path,{d:"M14.6 7l-1.2-1L8 12l5.4 6 1.2-1-4.6-5z"})),re=function(){const{adminUrl:t}=createBlockTheme;return(0,e.createElement)(a.Button,{varint:"secondary",icon:ae,href:`${t}themes.php?page=manage-fonts`,iconSize:20,style:{padding:"0",height:"1.5rem",minWidth:"1.5rem",marginLeft:"-.5rem"},"aria-label":(0,n.__)("Back to manage fonts","create-block-theme")})},oe={},le=function(){const[r,o]=(0,t.useState)({}),[l,i]=(0,t.useState)(null),[s,c]=(0,t.useState)({}),[h,m]=(0,t.useState)(oe),u=document.querySelector("#nonce").value,p=e=>{const t=h[e];if(t&&t?.faces?.length){const{[e]:t,...n}=h;m(n)}else{const t={family:e,faces:l.variants.map((e=>({weight:d(e),style:f(e),src:g(l.files[e])})))};m({...h,[e]:t})}},b=(e,t,n)=>{const a=h[e];return!!a&&!!a.faces.find((e=>e.weight===t&&e.style===n))},y=(e,t,n)=>{b(e,t,n)?((e,t,n)=>{const a=h[e],r=a.faces.filter((e=>!(e.weight===t&&e.style===n)));if(r.length)m({...h,[e]:{...a,faces:r}});else{const{[e]:t,...n}=h;m(n)}})(e,t,n):((e,t,n)=>{const a=h[e],r=function(e,t){return"400"===t?"italic"===e?"italic":"regular":"normal"===e?t:t+e}(n,t);m(a?{...h,[e]:{...a,faces:[...a?.faces||[],{weight:t,style:n,src:g(l.files[r])}]}}:{...h,[e]:{family:e,faces:[{weight:t,style:n,src:g(l.files[r])}]}})})(e,t,n)};(0,t.useEffect)((()=>{(async()=>{const e=await fetch(createBlockTheme.googleFontsDataUrl),t=await e.json();o(t)})()}),[]);const v=(0,C.useSelect)((e=>e(O.store).getCurrentTheme()),null);let w="";return l&&(w=l.family.toLowerCase().replace(" ","-")),(0,e.createElement)(S,null,(0,e.createElement)("main",null,(0,e.createElement)("header",null,(0,e.createElement)(re,null),(0,e.createElement)("h1",{className:"wp-heading-inline"},(0,n.__)("Add Google fonts to your theme","create-block-theme")),(0,e.createElement)("p",null,(0,n.__)("Add Google fonts assets and font face definitions to your currently active theme","create-block-theme")," ","(",v?.name.rendered,")")),!r?.items&&(0,e.createElement)("p",null,(0,e.createElement)(a.Spinner,null),(0,e.createElement)("span",null,(0,n.__)("Loading Google fonts data…","create-block-theme"))),r?.items&&(0,e.createElement)(e.Fragment,null,(0,e.createElement)("div",{className:"select-font"},(0,e.createElement)(a.SelectControl,{label:(0,n.__)("Select Font","create-block-theme"),name:"google-font",onChange:e=>{i(r.items[e]),(e=>{const t=new te(e.family);let n=!1,a=Object.values(e.files)[0];if(a.includes("http://")&&(a=a.replace("http://","https://")),t.src=a,t.onerror=e=>{console.error(e),n=!0},!n){function r(e){const t=e.detail.font,{name:n}=t.opentype.tables,a={copyright:n.get(0),source:n.get(11),license:n.get(13),licenseURL:n.get(14)};c(a)}t.onload=e=>r(e)}})(r.items[e])},size:"__unstable-large"},(0,e.createElement)("option",{value:null},(0,n.__)("Select a font…","create-block-theme")),r.items.map(((t,n)=>(0,e.createElement)("option",{value:n,key:`option${n}`},t.family))))),(0,e.createElement)(k,null),l&&(0,e.createElement)("p",null,(0,n.__)("Select the font variants you want to include:","create-block-theme")),l&&(0,e.createElement)("table",{className:"wp-list-table widefat striped table-view-list",id:"google-fonts-table"},(0,e.createElement)("thead",null,(0,e.createElement)("tr",null,(0,e.createElement)("td",{className:""},(0,e.createElement)("input",{type:"checkbox",id:`select-all-${w}`,onChange:()=>p(l.family),checked:l.variants.length===h[l.family]?.faces?.length})),(0,e.createElement)("td",{className:""},(0,e.createElement)("label",{htmlFor:`select-all-${w}`},(0,n.__)("Weight","create-block-theme"))),(0,e.createElement)("td",{className:""},(0,e.createElement)("label",{htmlFor:`select-all-${w}`},(0,n.__)("Style","create-block-theme"))),(0,e.createElement)("td",{className:""},(0,e.createElement)("label",{htmlFor:`select-all-${w}`},(0,n.__)("Preview","create-block-theme"))))),(0,e.createElement)("tbody",null,l.variants.map(((t,n)=>(0,e.createElement)(ne,{font:l,variant:t,key:`font-variant-${n}`,isSelected:b(l.family,d(t),f(t)),handleToggle:()=>y(l.family,d(t),f(t))}))))),(0,e.createElement)("form",{encType:"multipart/form-data",action:"",method:"POST"},(0,e.createElement)("input",{type:"hidden",name:"selection-data",value:JSON.stringify(Object.values(h))}),(0,e.createElement)("input",{type:"hidden",name:"font-credits",value:JSON.stringify(s)}),(0,e.createElement)(a.Button,{variant:"primary",type:"submit",disabled:0===Object.values(h).length},(0,n.__)("Add Google fonts to your theme","create-block-theme")),(0,e.createElement)("input",{type:"hidden",name:"nonce",value:u})))),(0,e.createElement)(F,{title:(0,n.__)("Selected Variants","create-block-theme"),fontsOutline:h,handleDeleteFontFace:y,handleDeleteFontFamily:p}))};function ie(e){return e&&Object.keys(e).length?Object.keys(e).map((t=>`'${e[t].tag}' ${e[t].currentValue}`)).join(", "):""}const se=function({formData:t,setFormData:r,resetFormData:o,isFormValid:l,setAxes:i}){const s=document.querySelector("#nonce").value,c=ie(t.axes);return(0,e.createElement)(e.Fragment,null,(0,e.createElement)("form",{method:"POST",id:"font-upload-form",action:"",encType:"multipart/form-data"},(0,e.createElement)("input",{type:"hidden",name:"nonce",value:s}),(0,e.createElement)("div",{className:"form-group"},(0,e.createElement)("label",{htmlFor:"font-file"},(0,n.__)("Font file:","create-block-theme")),(0,e.createElement)("input",{type:"file",name:"font-file",id:"font-file",onChange:e=>{const t=e.target.files[0];if(!t)return void o();const n=new FileReader;n.readAsArrayBuffer(t),n.onload=()=>{const e=new te("Uploaded Font");e.fromDataBuffer(n.result,t.name),e.onload=e=>{const n=e.detail.font,{name:a}=n.opentype.tables,o=a.get(1),l=a.get(2).toLowerCase().includes("italic"),s=n.opentype.tables["OS/2"].usWeightClass||"normal",c=!!n.opentype.tables.fvar,h=c&&n.opentype.tables.fvar.axes.find((({tag:e})=>"wght"===e)),m=h?`${h.minValue} ${h.maxValue}`:null,u=c?n.opentype.tables.fvar.axes.reduce(((e,{tag:t,minValue:n,defaultValue:a,maxValue:r})=>(e[t]={tag:t,minValue:n,defaultValue:a,maxValue:r,currentValue:a},e)),{}):{},f={copyright:a.get(0),source:a.get(11),license:a.get(13),licenseURL:a.get(14)};r({file:t,name:o,style:l?"italic":"normal",weight:h?m:s,variable:c,fontCredits:f}),i(u)}}},accept:".otf, .ttf, .woff, .woff2"}),(0,e.createElement)("small",null,(0,n.__)(".otf, .ttf, .woff, .woff2 file extensions supported","create-block-theme"))),(0,e.createElement)("h4",null,(0,n.__)("Font face definition for this font file:","create-block-theme")),(0,e.createElement)("div",{className:"form-group"},(0,e.createElement)(a.__experimentalInputControl,{label:(0,n.__)("Font name:","create-block-theme"),type:"text",name:"font-name",id:"font-name",placeholder:(0,n.__)("Font name","create-block-theme"),value:t.name||"",onChange:e=>r({...t,name:e})})),(0,e.createElement)("div",{className:"form-group"},(0,e.createElement)(a.SelectControl,{label:(0,n.__)("Font style:","create-block-theme"),name:"font-style",id:"font-style",value:t.style||"normal",onChange:e=>r({...t,style:e})},(0,e.createElement)("option",{value:"normal"},p("normal")),(0,e.createElement)("option",{value:"italic"},p("italic")))),(0,e.createElement)("div",{className:"form-group"},(0,e.createElement)(a.__experimentalInputControl,{label:(0,n.__)("Font weight:","create-block-theme"),type:"text",name:"font-weight",id:"font-weight",placeholder:(0,n.__)("Font weight","create-block-theme"),value:t.weight||"",onChange:e=>r({...t,weight:e})})),t.variable&&(0,e.createElement)("input",{type:"hidden",name:"font-variation-settings",value:c}),(0,e.createElement)("input",{type:"hidden",name:"font-credits",value:t.fontCredits?JSON.stringify(t.fontCredits):""})),(0,e.createElement)(a.Button,{variant:"primary",type:"submit",disabled:!l(),form:"font-upload-form"},(0,n.__)("Upload font to your theme","create-block-theme")))},ce={file:null,name:null,weight:null,style:null},he=function(){const[a,r]=(0,t.useState)(ce),[o,l]=(0,t.useState)({}),i=(0,t.useCallback)((()=>!(!a.name||a.name&&!/^[a-z0-9 ]+$/i.test(a.name))&&a.file&&a.weight&&a.style),[a]);return(0,t.useEffect)((()=>{(async()=>{if(!i())return;const e=await a.file.arrayBuffer(),t=y(a.name),n=new FontFace(t,e,{style:a.style,weight:a.weight});try{const e=await n.load();document.fonts.add(e)}catch(e){console.error(e)}})()}),[a,i]),(0,e.createElement)("div",{className:"layout"},(0,e.createElement)("main",null,(0,e.createElement)("header",null,(0,e.createElement)(re,null),(0,e.createElement)("h1",null,(0,n.__)("Local Fonts","create-block-theme")),(0,e.createElement)("p",null,(0,n.__)("Add local fonts assets and font face definitions to your currently active theme","create-block-theme"))),(0,e.createElement)(se,{isFormValid:i,formData:a,setFormData:r,resetFormData:()=>{r(ce)},setAxes:l})),(0,e.createElement)("div",{className:"preview"},(0,e.createElement)("h2",null,(0,n.__)("Font file preview","create-block-theme")),i()?(0,e.createElement)(e.Fragment,null,(0,e.createElement)(k,{axes:o,setAxes:l,resetAxes:()=>{const e=Object.keys(o).reduce(((e,t)=>(e[t]={...o[t],currentValue:o[t].defaultValue},e)),{});l(e)}}),(0,e.createElement)("p",null,(0,n.__)("Demo:","create-block-theme")),(0,e.createElement)(u,{style:(()=>{if(!i())return{};const e={fontFamily:y(a.name),fontWeight:a.weight,fontStyle:a.style};return a.variable&&(e.fontVariationSettings=ie(o)),e})()})):(0,e.createElement)("p",null,(0,n.__)("Load a font file to preview it.","create-block-theme"))))};function me(){let t=null;switch(new URLSearchParams(document.location.search).get("page")){case"manage-fonts":t=T;break;case"add-google-font-to-theme-json":t=le;break;case"add-local-font-to-theme-json":t=he;break;default:t=()=>(0,e.createElement)("h1",null,"This page is not implemented yet.")}return(0,e.createElement)(m,null,(0,e.createElement)(t,null))}window.addEventListener("load",(function(){const n=document.getElementById("create-block-theme-app");void 0===t.createRoot?(0,t.render)((0,e.createElement)(me,null),n):(0,t.createRoot)(n).render((0,e.createElement)(me,null))}),!1)})()})();