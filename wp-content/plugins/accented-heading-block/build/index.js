(()=>{"use strict";var e,n={786:()=>{const e=window.wp.blocks,n=window.React,t=window.wp.i18n,r=window.wp.blockEditor,a=window.wp.components,o=JSON.parse('{"UU":"create-block/accented-heading-block"}');(0,e.registerBlockType)(o.UU,{edit:function({attributes:e,setAttributes:o}){const{headingNormal:l,headingAccented:c}=e;return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(r.InspectorControls,null,(0,n.createElement)(a.PanelBody,{title:(0,t.__)("Settings","accented-heading-block")},(0,n.createElement)(a.TextControl,{label:(0,t.__)("Heading Normal","accented-heading-block"),value:l||"",onChange:e=>o({headingNormal:e})}),(0,n.createElement)(a.TextControl,{label:(0,t.__)("Heading Accent","accented-heading-block"),value:c||"",onChange:e=>o({headingAccented:e})}))),(0,n.createElement)("h3",{...(0,r.useBlockProps)()},l,(0,n.createElement)("em",null,c)))}})}},t={};function r(e){var a=t[e];if(void 0!==a)return a.exports;var o=t[e]={exports:{}};return n[e](o,o.exports,r),o.exports}r.m=n,e=[],r.O=(n,t,a,o)=>{if(!t){var l=1/0;for(s=0;s<e.length;s++){for(var[t,a,o]=e[s],c=!0,i=0;i<t.length;i++)(!1&o||l>=o)&&Object.keys(r.O).every((e=>r.O[e](t[i])))?t.splice(i--,1):(c=!1,o<l&&(l=o));if(c){e.splice(s--,1);var d=a();void 0!==d&&(n=d)}}return n}o=o||0;for(var s=e.length;s>0&&e[s-1][2]>o;s--)e[s]=e[s-1];e[s]=[t,a,o]},r.o=(e,n)=>Object.prototype.hasOwnProperty.call(e,n),(()=>{var e={57:0,350:0};r.O.j=n=>0===e[n];var n=(n,t)=>{var a,o,[l,c,i]=t,d=0;if(l.some((n=>0!==e[n]))){for(a in c)r.o(c,a)&&(r.m[a]=c[a]);if(i)var s=i(r)}for(n&&n(t);d<l.length;d++)o=l[d],r.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return r.O(s)},t=globalThis.webpackChunkaccented_heading_block=globalThis.webpackChunkaccented_heading_block||[];t.forEach(n.bind(null,0)),t.push=n.bind(null,t.push.bind(t))})();var a=r.O(void 0,[350],(()=>r(786)));a=r.O(a)})();