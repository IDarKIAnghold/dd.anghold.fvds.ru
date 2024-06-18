import{A as it,Q as rt,B as at,C as st,E as lt,o as I,c as Y,a as m,F as ue,t as q,r as z,f as V,b as O,T as _e,j,e as re,v as le,d as Re,x as Me,G as Le,s as Te,n as ut,H as Fe,I as ct,m as dt,l as pt,J as mt,u as Z,w as Ie,K as ft,k as ht}from"./app.BQx0zvW2.js";const gn=it("user",{state:()=>({user:{}}),actions:{loadUser(){const u=rt().props.user;u.id,u.first_name,u.last_name,u.nickname,u.email,u.img,u.status}}});var we={exports:{}};(function(x,u){(function(_,y){typeof u.nodeName!="string"?x.exports=y():_.Croppie=y()})(typeof self<"u"?self:st,function(){if(typeof Promise!="function"){/*! promise-polyfill 3.1.0 */(function(e){function n(a,c){return function(){a.apply(c,arguments)}}function t(a){if(typeof this!="object")throw new TypeError("Promises must be constructed via new");if(typeof a!="function")throw new TypeError("not a function");this._state=null,this._value=null,this._deferreds=[],h(a,n(r,this),n(i,this))}function o(a){var c=this;return this._state===null?void this._deferreds.push(a):void v(function(){var s=c._state?a.onFulfilled:a.onRejected;if(s===null)return void(c._state?a.resolve:a.reject)(c._value);var p;try{p=s(c._value)}catch(g){return void a.reject(g)}a.resolve(p)})}function r(a){try{if(a===this)throw new TypeError("A promise cannot be resolved with itself.");if(a&&(typeof a=="object"||typeof a=="function")){var c=a.then;if(typeof c=="function")return void h(n(c,a),n(r,this),n(i,this))}this._state=!0,this._value=a,l.call(this)}catch(s){i.call(this,s)}}function i(a){this._state=!1,this._value=a,l.call(this)}function l(){for(var a=0,c=this._deferreds.length;c>a;a++)o.call(this,this._deferreds[a]);this._deferreds=null}function d(a,c,s,p){this.onFulfilled=typeof a=="function"?a:null,this.onRejected=typeof c=="function"?c:null,this.resolve=s,this.reject=p}function h(a,c,s){var p=!1;try{a(function(g){p||(p=!0,c(g))},function(g){p||(p=!0,s(g))})}catch(g){if(p)return;p=!0,s(g)}}var f=setTimeout,v=typeof setImmediate=="function"&&setImmediate||function(a){f(a,1)},b=Array.isArray||function(a){return Object.prototype.toString.call(a)==="[object Array]"};t.prototype.catch=function(a){return this.then(null,a)},t.prototype.then=function(a,c){var s=this;return new t(function(p,g){o.call(s,new d(a,c,p,g))})},t.all=function(){var a=Array.prototype.slice.call(arguments.length===1&&b(arguments[0])?arguments[0]:arguments);return new t(function(c,s){function p(S,R){try{if(R&&(typeof R=="object"||typeof R=="function")){var H=R.then;if(typeof H=="function")return void H.call(R,function(P){p(S,P)},s)}a[S]=R,--g===0&&c(a)}catch(P){s(P)}}if(a.length===0)return c([]);for(var g=a.length,E=0;E<a.length;E++)p(E,a[E])})},t.resolve=function(a){return a&&typeof a=="object"&&a.constructor===t?a:new t(function(c){c(a)})},t.reject=function(a){return new t(function(c,s){s(a)})},t.race=function(a){return new t(function(c,s){for(var p=0,g=a.length;g>p;p++)a[p].then(c,s)})},t._setImmediateFn=function(a){v=a},x.exports?x.exports=t:e.Promise||(e.Promise=t)})(this)}typeof window<"u"&&typeof window.CustomEvent!="function"&&function(){function e(n,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var o=document.createEvent("CustomEvent");return o.initCustomEvent(n,t.bubbles,t.cancelable,t.detail),o}e.prototype=window.Event.prototype,window.CustomEvent=e}(),typeof HTMLCanvasElement<"u"&&!HTMLCanvasElement.prototype.toBlob&&Object.defineProperty(HTMLCanvasElement.prototype,"toBlob",{value:function(e,n,t){for(var o=atob(this.toDataURL(n,t).split(",")[1]),r=o.length,i=new Uint8Array(r),l=0;l<r;l++)i[l]=o.charCodeAt(l);e(new Blob([i],{type:n||"image/png"}))}});var _=["Webkit","Moz","ms"],y=typeof document<"u"?document.createElement("div").style:{},k=[1,8,3,6],w=[2,7,4,5],C,L,T;function W(e){if(e in y)return e;for(var n=e[0].toUpperCase()+e.slice(1),t=_.length;t--;)if(e=_[t]+n,e in y)return e}L=W("transform"),C=W("transformOrigin"),T=W("userSelect");function N(e,n){var t=k.indexOf(e)>-1?k:w,o=t.indexOf(e),r=n/90%t.length;return t[(t.length+o+r%t.length)%t.length]}function B(e,n){e=e||{};for(var t in n)n[t]&&n[t].constructor&&n[t].constructor===Object?(e[t]=e[t]||{},B(e[t],n[t])):e[t]=n[t];return e}function D(e){return B({},e)}function A(e,n,t){var o;return function(){var r=this,i=arguments,l=function(){o=null,e.apply(r,i)};clearTimeout(o),o=setTimeout(l,n)}}function ce(e){if("createEvent"in document){var n=document.createEvent("HTMLEvents");n.initEvent("change",!1,!0),e.dispatchEvent(n)}else e.fireEvent("onchange")}function M(e,n,t){if(typeof n=="string"){var o=n;n={},n[o]=t}for(var r in n)e.style[r]=n[r]}function X(e,n){e.classList?e.classList.add(n):e.className+=" "+n}function Pe(e,n){e.classList?e.classList.remove(n):e.className=e.className.replace(n,"")}function be(e,n){for(var t in n)e.setAttribute(t,n[t])}function G(e){return parseInt(e,10)}function Ze(e,n){if(!e)throw"Source image missing";var t=new Image;return t.style.opacity="0",new Promise(function(o,r){function i(){t.style.opacity="1",setTimeout(function(){o(t)},1)}t.removeAttribute("crossOrigin"),e.match(/^https?:\/\/|^\/\//)&&t.setAttribute("crossOrigin","anonymous"),t.onload=function(){n?EXIF.getData(t,function(){i()}):i()},t.onerror=function(l){t.style.opacity=1,setTimeout(function(){r(l)},1)},t.src=e})}function xe(e,n){var t=e.naturalWidth,o=e.naturalHeight,r=n||de(e);if(r&&r>=5){var i=t;t=o,o=i}return{width:t,height:o}}var Be={translate3d:{suffix:", 0px"},translate:{suffix:""}},F=function(e,n,t){this.x=parseFloat(e),this.y=parseFloat(n),this.scale=parseFloat(t)};F.parse=function(e){return e.style?F.parse(e.style[L]):e.indexOf("matrix")>-1||e.indexOf("none")>-1?F.fromMatrix(e):F.fromString(e)},F.fromMatrix=function(e){var n=e.substring(7).split(",");return(!n.length||e==="none")&&(n=[1,0,0,1,0,0]),new F(G(n[4]),G(n[5]),parseFloat(n[0]))},F.fromString=function(e){var n=e.split(") "),t=n[0].substring(U.globals.translate.length+1).split(","),o=n.length>1?n[1].substring(6):1,r=t.length>1?t[0]:0,i=t.length>1?t[1]:0;return new F(r,i,o)},F.prototype.toString=function(){var e=Be[U.globals.translate].suffix||"";return U.globals.translate+"("+this.x+"px, "+this.y+"px"+e+") scale("+this.scale+")"};var ne=function(e){if(!e||!e.style[C]){this.x=0,this.y=0;return}var n=e.style[C].split(" ");this.x=parseFloat(n[0]),this.y=parseFloat(n[1])};ne.prototype.toString=function(){return this.x+"px "+this.y+"px"};function de(e){return e.exifdata&&e.exifdata.Orientation?G(e.exifdata.Orientation):1}function Ce(e,n,t){var o=n.width,r=n.height,i=e.getContext("2d");switch(e.width=n.width,e.height=n.height,i.save(),t){case 2:i.translate(o,0),i.scale(-1,1);break;case 3:i.translate(o,r),i.rotate(180*Math.PI/180);break;case 4:i.translate(0,r),i.scale(1,-1);break;case 5:e.width=r,e.height=o,i.rotate(90*Math.PI/180),i.scale(1,-1);break;case 6:e.width=r,e.height=o,i.rotate(90*Math.PI/180),i.translate(0,-r);break;case 7:e.width=r,e.height=o,i.rotate(-90*Math.PI/180),i.translate(-o,r),i.scale(1,-1);break;case 8:e.width=r,e.height=o,i.translate(0,o),i.rotate(-90*Math.PI/180);break}i.drawImage(n,0,0,o,r),i.restore()}function De(){var e=this,n="croppie-container",t=e.options.viewport.type?"cr-vp-"+e.options.viewport.type:null,o,r,i,l,d,h;e.options.useCanvas=e.options.enableOrientation||pe.call(e),e.data={},e.elements={},o=e.elements.boundary=document.createElement("div"),i=e.elements.viewport=document.createElement("div"),r=e.elements.img=document.createElement("img"),l=e.elements.overlay=document.createElement("div"),e.options.useCanvas?(e.elements.canvas=document.createElement("canvas"),e.elements.preview=e.elements.canvas):e.elements.preview=r,X(o,"cr-boundary"),o.setAttribute("aria-dropeffect","none"),d=e.options.boundary.width,h=e.options.boundary.height,M(o,{width:d+(isNaN(d)?"":"px"),height:h+(isNaN(h)?"":"px")}),X(i,"cr-viewport"),t&&X(i,t),M(i,{width:e.options.viewport.width+"px",height:e.options.viewport.height+"px"}),i.setAttribute("tabindex",0),X(e.elements.preview,"cr-image"),be(e.elements.preview,{alt:"preview","aria-grabbed":"false"}),X(l,"cr-overlay"),e.element.appendChild(o),o.appendChild(e.elements.preview),o.appendChild(i),o.appendChild(l),X(e.element,n),e.options.customClass&&X(e.element,e.options.customClass),He.call(this),e.options.enableZoom&&Oe.call(e),e.options.enableResize&&We.call(e)}function pe(){return this.options.enableExif&&window.EXIF}function We(){var e=this,n=document.createElement("div"),t=!1,o,r,i,l=50,d,h,f,v;X(n,"cr-resizer"),M(n,{width:this.options.viewport.width+"px",height:this.options.viewport.height+"px"}),this.options.resizeControls.height&&(f=document.createElement("div"),X(f,"cr-resizer-vertical"),n.appendChild(f)),this.options.resizeControls.width&&(v=document.createElement("div"),X(v,"cr-resizer-horisontal"),n.appendChild(v));function b(s){if(!(s.button!==void 0&&s.button!==0)&&(s.preventDefault(),!t)){var p=e.elements.overlay.getBoundingClientRect();if(t=!0,r=s.pageX,i=s.pageY,o=s.currentTarget.className.indexOf("vertical")!==-1?"v":"h",d=p.width,h=p.height,s.touches){var g=s.touches[0];r=g.pageX,i=g.pageY}window.addEventListener("mousemove",a),window.addEventListener("touchmove",a),window.addEventListener("mouseup",c),window.addEventListener("touchend",c),document.body.style[T]="none"}}function a(s){var p=s.pageX,g=s.pageY;if(s.preventDefault(),s.touches){var E=s.touches[0];p=E.pageX,g=E.pageY}var S=p-r,R=g-i,H=e.options.viewport.height+R,P=e.options.viewport.width+S;o==="v"&&H>=l&&H<=h?(M(n,{height:H+"px"}),e.options.boundary.height+=R,M(e.elements.boundary,{height:e.options.boundary.height+"px"}),e.options.viewport.height+=R,M(e.elements.viewport,{height:e.options.viewport.height+"px"})):o==="h"&&P>=l&&P<=d&&(M(n,{width:P+"px"}),e.options.boundary.width+=S,M(e.elements.boundary,{width:e.options.boundary.width+"px"}),e.options.viewport.width+=S,M(e.elements.viewport,{width:e.options.viewport.width+"px"})),ie.call(e),fe.call(e),oe.call(e),ee.call(e),i=g,r=p}function c(){t=!1,window.removeEventListener("mousemove",a),window.removeEventListener("touchmove",a),window.removeEventListener("mouseup",c),window.removeEventListener("touchend",c),document.body.style[T]=""}f&&(f.addEventListener("mousedown",b),f.addEventListener("touchstart",b)),v&&(v.addEventListener("mousedown",b),v.addEventListener("touchstart",b)),this.elements.boundary.appendChild(n)}function J(e){if(this.options.enableZoom){var n=this.elements.zoomer,t=K(e,4);n.value=Math.max(parseFloat(n.min),Math.min(parseFloat(n.max),t)).toString()}}function Oe(){var e=this,n=e.elements.zoomerWrap=document.createElement("div"),t=e.elements.zoomer=document.createElement("input");X(n,"cr-slider-wrap"),X(t,"cr-slider"),t.type="range",t.step="0.0001",t.value="1",t.style.display=e.options.showZoomer?"":"none",t.setAttribute("aria-label","zoom"),e.element.appendChild(n),n.appendChild(t),e._currentZoom=1;function o(){Ae.call(e,{value:parseFloat(t.value),origin:new ne(e.elements.preview),viewportRect:e.elements.viewport.getBoundingClientRect(),transform:F.parse(e.elements.preview)})}function r(i){var l,d;if(e.options.mouseWheelZoom==="ctrl"&&i.ctrlKey!==!0)return 0;i.wheelDelta?l=i.wheelDelta/1200:i.deltaY?l=i.deltaY/1060:i.detail?l=i.detail/-60:l=0,d=e._currentZoom+l*e._currentZoom,i.preventDefault(),J.call(e,d),o.call(e)}e.elements.zoomer.addEventListener("input",o),e.elements.zoomer.addEventListener("change",o),e.options.mouseWheelZoom&&(e.elements.boundary.addEventListener("mousewheel",r),e.elements.boundary.addEventListener("DOMMouseScroll",r))}function Ae(e){var n=this,t=e?e.transform:F.parse(n.elements.preview),o=e?e.viewportRect:n.elements.viewport.getBoundingClientRect(),r=e?e.origin:new ne(n.elements.preview);function i(){var f={};f[L]=t.toString(),f[C]=r.toString(),M(n.elements.preview,f)}if(n._currentZoom=e?e.value:n._currentZoom,t.scale=n._currentZoom,n.elements.zoomer.setAttribute("aria-valuenow",n._currentZoom),i(),n.options.enforceBoundary){var l=Xe.call(n,o),d=l.translate,h=l.origin;t.x>=d.maxX&&(r.x=h.minX,t.x=d.maxX),t.x<=d.minX&&(r.x=h.maxX,t.x=d.minX),t.y>=d.maxY&&(r.y=h.minY,t.y=d.maxY),t.y<=d.minY&&(r.y=h.maxY,t.y=d.minY)}i(),Ye.call(n),ee.call(n)}function Xe(e){var n=this,t=n._currentZoom,o=e.width,r=e.height,i=n.elements.boundary.clientWidth/2,l=n.elements.boundary.clientHeight/2,d=n.elements.preview.getBoundingClientRect(),h=d.width,f=d.height,v=o/2,b=r/2,a=(v/t-i)*-1,c=a-(h*(1/t)-o*(1/t)),s=(b/t-l)*-1,p=s-(f*(1/t)-r*(1/t)),g=1/t*v,E=h*(1/t)-g,S=1/t*b,R=f*(1/t)-S;return{translate:{maxX:a,minX:c,maxY:s,minY:p},origin:{maxX:E,minX:g,maxY:R,minY:S}}}function oe(e){var n=this,t=n._currentZoom,o=n.elements.preview.getBoundingClientRect(),r=n.elements.viewport.getBoundingClientRect(),i=F.parse(n.elements.preview.style[L]),l=new ne(n.elements.preview),d=r.top-o.top+r.height/2,h=r.left-o.left+r.width/2,f={},v={};if(e){var b=l.x,a=l.y,c=i.x,s=i.y;f.y=b,f.x=a,i.y=c,i.x=s}else f.y=d/t,f.x=h/t,v.y=(f.y-l.y)*(1-t),v.x=(f.x-l.x)*(1-t),i.x-=v.x,i.y-=v.y;var p={};p[C]=f.x+"px "+f.y+"px",p[L]=i.toString(),M(n.elements.preview,p)}function He(){var e=this,n=!1,t,o,r,i,l;function d(s,p){var g=e.elements.preview.getBoundingClientRect(),E=l.y+p,S=l.x+s;e.options.enforceBoundary?(i.top>g.top+p&&i.bottom<g.bottom+p&&(l.y=E),i.left>g.left+s&&i.right<g.right+s&&(l.x=S)):(l.y=E,l.x=S)}function h(s){e.elements.preview.setAttribute("aria-grabbed",s),e.elements.boundary.setAttribute("aria-dropeffect",s?"move":"none")}function f(s){var p=37,g=38,E=39,S=40;if(s.shiftKey&&(s.keyCode===g||s.keyCode===S)){var R;s.keyCode===g?R=parseFloat(e.elements.zoomer.value)+parseFloat(e.elements.zoomer.step):R=parseFloat(e.elements.zoomer.value)-parseFloat(e.elements.zoomer.step),e.setZoom(R)}else if(e.options.enableKeyMovement&&s.keyCode>=37&&s.keyCode<=40){s.preventDefault();var H=P(s.keyCode);l=F.parse(e.elements.preview),document.body.style[T]="none",i=e.elements.viewport.getBoundingClientRect(),v(H)}function P(te){switch(te){case p:return[1,0];case g:return[0,1];case E:return[-1,0];case S:return[0,-1]}}}function v(s){var p=s[0],g=s[1],E={};d(p,g),E[L]=l.toString(),M(e.elements.preview,E),ie.call(e),document.body.style[T]="",oe.call(e),ee.call(e),r=0}function b(s){if(!(s.button!==void 0&&s.button!==0)&&(s.preventDefault(),!n)){if(n=!0,t=s.pageX,o=s.pageY,s.touches){var p=s.touches[0];t=p.pageX,o=p.pageY}h(n),l=F.parse(e.elements.preview),window.addEventListener("mousemove",a),window.addEventListener("touchmove",a),window.addEventListener("mouseup",c),window.addEventListener("touchend",c),document.body.style[T]="none",i=e.elements.viewport.getBoundingClientRect()}}function a(s){s.preventDefault();var p=s.pageX,g=s.pageY;if(s.touches){var E=s.touches[0];p=E.pageX,g=E.pageY}var S=p-t,R=g-o,H={};if(s.type==="touchmove"&&s.touches.length>1){var P=s.touches[0],te=s.touches[1],Se=Math.sqrt((P.pageX-te.pageX)*(P.pageX-te.pageX)+(P.pageY-te.pageY)*(P.pageY-te.pageY));r||(r=Se/e._currentZoom);var ot=Se/r;J.call(e,ot),ce(e.elements.zoomer);return}d(S,R),H[L]=l.toString(),M(e.elements.preview,H),ie.call(e),o=g,t=p}function c(){n=!1,h(n),window.removeEventListener("mousemove",a),window.removeEventListener("touchmove",a),window.removeEventListener("mouseup",c),window.removeEventListener("touchend",c),document.body.style[T]="",oe.call(e),ee.call(e),r=0}e.elements.overlay.addEventListener("mousedown",b),e.elements.viewport.addEventListener("keydown",f),e.elements.overlay.addEventListener("touchstart",b)}function ie(){if(this.elements){var e=this,n=e.elements.boundary.getBoundingClientRect(),t=e.elements.preview.getBoundingClientRect();M(e.elements.overlay,{width:t.width+"px",height:t.height+"px",top:t.top-n.top+"px",left:t.left-n.left+"px"})}}var Ye=A(ie,500);function ee(){var e=this,n=e.get();if(Ee.call(e))if(e.options.update.call(e,n),e.$&&typeof Prototype>"u")e.$(e.element).trigger("update.croppie",n);else{var t;window.CustomEvent?t=new CustomEvent("update",{detail:n}):(t=document.createEvent("CustomEvent"),t.initCustomEvent("update",!0,!0,n)),e.element.dispatchEvent(t)}}function Ee(){return this.elements.preview.offsetHeight>0&&this.elements.preview.offsetWidth>0}function me(){var e=this,n=1,t={},o=e.elements.preview,r,i=new F(0,0,n),l=new ne,d=Ee.call(e);!d||e.data.bound||(e.data.bound=!0,t[L]=i.toString(),t[C]=l.toString(),t.opacity=1,M(o,t),r=e.elements.preview.getBoundingClientRect(),e._originalImageWidth=r.width,e._originalImageHeight=r.height,e.data.orientation=pe.call(e)?de(e.elements.img):e.data.orientation,e.options.enableZoom?fe.call(e,!0):e._currentZoom=n,i.scale=e._currentZoom,t[L]=i.toString(),M(o,t),e.data.points.length?ze.call(e,e.data.points):Ne.call(e),oe.call(e),ie.call(e))}function fe(e){var n=this,t=Math.max(n.options.minZoom,0)||0,o=n.options.maxZoom||1.5,r,i,l=n.elements.zoomer,d=parseFloat(l.value),h=n.elements.boundary.getBoundingClientRect(),f=xe(n.elements.img,n.data.orientation),v=n.elements.viewport.getBoundingClientRect(),b,a;n.options.enforceBoundary&&(b=v.width/f.width,a=v.height/f.height,t=Math.max(b,a)),t>=o&&(o=t+1),l.min=K(t,4),l.max=K(o,4),!e&&(d<l.min||d>l.max)?J.call(n,d<l.min?l.min:l.max):e&&(i=Math.max(h.width/f.width,h.height/f.height),r=n.data.boundZoom!==null?n.data.boundZoom:i,J.call(n,r)),ce(l)}function ze(e){if(e.length!==4)throw"Croppie - Invalid number of points supplied: "+e;var n=this,t=e[2]-e[0],o=n.elements.viewport.getBoundingClientRect(),r=n.elements.boundary.getBoundingClientRect(),i={left:o.left-r.left,top:o.top-r.top},l=o.width/t,d=e[1],h=e[0],f=-1*e[1]+i.top,v=-1*e[0]+i.left,b={};b[C]=h+"px "+d+"px",b[L]=new F(v,f,l).toString(),M(n.elements.preview,b),J.call(n,l),n._currentZoom=l}function Ne(){var e=this,n=e.elements.preview.getBoundingClientRect(),t=e.elements.viewport.getBoundingClientRect(),o=e.elements.boundary.getBoundingClientRect(),r=t.left-o.left,i=t.top-o.top,l=r-(n.width-t.width)/2,d=i-(n.height-t.height)/2,h=new F(l,d,e._currentZoom);M(e.elements.preview,L,h.toString())}function Ue(e){var n=this,t=n.elements.canvas,o=n.elements.img,r=t.getContext("2d");r.clearRect(0,0,t.width,t.height),t.width=o.width,t.height=o.height;var i=n.options.enableOrientation&&e||de(o);Ce(t,o,i)}function he(e){var n=this,t=e.points,o=G(t[0]),r=G(t[1]),i=G(t[2]),l=G(t[3]),d=i-o,h=l-r,f=e.circle,v=document.createElement("canvas"),b=v.getContext("2d"),a=e.outputWidth||d,c=e.outputHeight||h;v.width=a,v.height=c,e.backgroundColor&&(b.fillStyle=e.backgroundColor,b.fillRect(0,0,a,c));var s=o,p=r,g=d,E=h,S=0,R=0,H=a,P=c;return o<0&&(s=0,S=Math.abs(o)/d*a),g+s>n._originalImageWidth&&(g=n._originalImageWidth-s,H=g/d*a),r<0&&(p=0,R=Math.abs(r)/h*c),E+p>n._originalImageHeight&&(E=n._originalImageHeight-p,P=E/h*c),b.drawImage(this.elements.preview,s,p,g,E,S,R,H,P),f&&(b.fillStyle="#fff",b.globalCompositeOperation="destination-in",b.beginPath(),b.arc(v.width/2,v.height/2,v.width/2,0,Math.PI*2,!0),b.closePath(),b.fill()),v}function je(e){var n=e.points,t=document.createElement("div"),o=document.createElement("img"),r=n[2]-n[0],i=n[3]-n[1];return X(t,"croppie-result"),t.appendChild(o),M(o,{left:-1*n[0]+"px",top:-1*n[1]+"px"}),o.src=e.url,M(t,{width:r+"px",height:i+"px"}),t}function Ve(e){return he.call(this,e).toDataURL(e.format,e.quality)}function qe(e){var n=this;return new Promise(function(t){he.call(n,e).toBlob(function(o){t(o)},e.format,e.quality)})}function Ge(e){this.elements.img.parentNode&&(Array.prototype.forEach.call(this.elements.img.classList,function(n){e.classList.add(n)}),this.elements.img.parentNode.replaceChild(e,this.elements.img),this.elements.preview=e),this.elements.img=e}function ke(e,n){var t=this,o,r=[],i=null,l=pe.call(t);if(typeof e=="string")o=e,e={};else if(Array.isArray(e))r=e.slice();else{if(typeof e>"u"&&t.data.url)return me.call(t),ee.call(t),null;o=e.url,r=e.points||[],i=typeof e.zoom>"u"?null:e.zoom}return t.data.bound=!1,t.data.url=o||t.data.url,t.data.boundZoom=i,Ze(o,l).then(function(d){if(Ge.call(t,d),r.length)t.options.relative&&(r=[r[0]*d.naturalWidth/100,r[1]*d.naturalHeight/100,r[2]*d.naturalWidth/100,r[3]*d.naturalHeight/100]);else{var h=xe(d),f=t.elements.viewport.getBoundingClientRect(),v=f.width/f.height,b=h.width/h.height,a,c;b>v?(c=h.height,a=c*v):(a=h.width,c=h.height/v);var s=(h.width-a)/2,p=(h.height-c)/2,g=s+a,E=p+c;t.data.points=[s,p,g,E]}t.data.orientation=e.orientation||1,t.data.points=r.map(function(S){return parseFloat(S)}),t.options.useCanvas&&Ue.call(t,t.data.orientation),me.call(t),ee.call(t),n&&n()})}function K(e,n){return parseFloat(e).toFixed(n||0)}function $e(){var e=this,n=e.elements.preview.getBoundingClientRect(),t=e.elements.viewport.getBoundingClientRect(),o=t.left-n.left,r=t.top-n.top,i=(t.width-e.elements.viewport.offsetWidth)/2,l=(t.height-e.elements.viewport.offsetHeight)/2,d=o+e.elements.viewport.offsetWidth+i,h=r+e.elements.viewport.offsetHeight+l,f=e._currentZoom;(f===1/0||isNaN(f))&&(f=1);var v=e.options.enforceBoundary?0:Number.NEGATIVE_INFINITY;return o=Math.max(v,o/f),r=Math.max(v,r/f),d=Math.max(v,d/f),h=Math.max(v,h/f),{points:[K(o),K(r),K(d),K(h)],zoom:f,orientation:e.data.orientation}}var Ke={type:"canvas",format:"png",quality:1},Qe=["jpeg","webp","png"];function Je(e){var n=this,t=$e.call(n),o=B(D(Ke),D(e)),r=typeof e=="string"?e:o.type||"base64",i=o.size||"viewport",l=o.format,d=o.quality,h=o.backgroundColor,f=typeof o.circle=="boolean"?o.circle:n.options.viewport.type==="circle",v=n.elements.viewport.getBoundingClientRect(),b=v.width/v.height,a;return i==="viewport"?(t.outputWidth=v.width,t.outputHeight=v.height):typeof i=="object"&&(i.width&&i.height?(t.outputWidth=i.width,t.outputHeight=i.height):i.width?(t.outputWidth=i.width,t.outputHeight=i.width/b):i.height&&(t.outputWidth=i.height*b,t.outputHeight=i.height)),Qe.indexOf(l)>-1&&(t.format="image/"+l,t.quality=d),t.circle=f,t.url=n.data.url,t.backgroundColor=h,a=new Promise(function(c){switch(r.toLowerCase()){case"rawcanvas":c(he.call(n,t));break;case"canvas":case"base64":c(Ve.call(n,t));break;case"blob":qe.call(n,t).then(c);break;default:c(je.call(n,t));break}}),a}function et(){me.call(this)}function tt(e){if(!this.options.useCanvas||!this.options.enableOrientation)throw"Croppie: Cannot rotate without enableOrientation && EXIF.js included";var n=this,t=n.elements.canvas;if(n.data.orientation=N(n.data.orientation,e),Ce(t,n.elements.img,n.data.orientation),oe.call(n,!0),fe.call(n),Math.abs(e)/90%2===1){var o=n._originalImageHeight,r=n._originalImageWidth;n._originalImageWidth=o,n._originalImageHeight=r}}function nt(){var e=this;e.element.removeChild(e.elements.boundary),Pe(e.element,"croppie-container"),e.options.enableZoom&&e.element.removeChild(e.elements.zoomerWrap),delete e.elements}if(typeof window<"u"&&window.jQuery){var Q=window.jQuery;Q.fn.croppie=function(e){var n=typeof e;if(n==="string"){var t=Array.prototype.slice.call(arguments,1),o=Q(this).data("croppie");return e==="get"?o.get():e==="result"?o.result.apply(o,t):e==="bind"?o.bind.apply(o,t):this.each(function(){var r=Q(this).data("croppie");if(r){var i=r[e];if(Q.isFunction(i))i.apply(r,t),e==="destroy"&&Q(this).removeData("croppie");else throw"Croppie "+e+" method not found"}})}else return this.each(function(){var r=new U(this,e);r.$=Q,Q(this).data("croppie",r)})}}function U(e,n){if(e.className.indexOf("croppie-container")>-1)throw new Error("Croppie: Can't initialize croppie more than once");if(this.element=e,this.options=B(D(U.defaults),n),this.element.tagName.toLowerCase()==="img"){var t=this.element;X(t,"cr-original-image"),be(t,{"aria-hidden":"true",alt:""});var o=document.createElement("div");this.element.parentNode.appendChild(o),o.appendChild(t),this.element=o,this.options.url=this.options.url||t.src}if(De.call(this),this.options.url){var r={url:this.options.url,points:this.options.points};delete this.options.url,delete this.options.points,ke.call(this,r)}}return U.defaults={viewport:{width:100,height:100,type:"square"},boundary:{},orientationControls:{enabled:!0,leftClass:"",rightClass:""},resizeControls:{width:!0,height:!0},customClass:"",showZoomer:!0,enableZoom:!0,enableResize:!1,mouseWheelZoom:!0,enableExif:!1,enforceBoundary:!0,enableOrientation:!1,enableKeyMovement:!0,update:function(){}},U.globals={translate:"translate3d"},B(U.prototype,{bind:function(e,n){return ke.call(this,e,n)},get:function(){var e=$e.call(this),n=e.points;return this.options.relative&&(n[0]/=this.elements.img.naturalWidth/100,n[1]/=this.elements.img.naturalHeight/100,n[2]/=this.elements.img.naturalWidth/100,n[3]/=this.elements.img.naturalHeight/100),e},result:function(e){return Je.call(this,e)},refresh:function(){return et.call(this)},setZoom:function(e){J.call(this,e),ce(this.elements.zoomer)},rotate:function(e){tt.call(this,e)},destroy:function(){return nt.call(this)}}),U})})(we,we.exports);var vt=we.exports;const gt=at(vt),wt=lt({emits:["updateviewModalCrop"],data(){return{croppie:null}},mounted(){var x=document.getElementById("fileInput").files[0],u=new FileReader;u.onload=_=>{this.croppie=new gt(document.getElementById("preview"),{viewport:{width:400,height:400,type:"circle"},boundary:{width:400,height:400}}),this.croppie.bind({url:_.target.result})},u.readAsDataURL(x)},methods:{updateImage(){this.croppie&&this.croppie.result("base64").then(x=>{$("#imageData").val(x);var u=document.querySelector('meta[name="csrf-token"]').getAttribute("content");$("#ImageUpdate").append('<input type="hidden" name="_token" value="'+u+'">'),document.getElementById("ImageUpdate").submit()})},cancelUpdate(){this.croppie&&($(".modal").removeClass("show"),this.croppie.destroy(),$("#fileInput").val(""),$(".modal-content").empty(),this.$emit("updateviewModalCrop"))}}}),ye=(x,u)=>{const _=x.__vccOpts||x;for(const[y,k]of u)_[y]=k;return _},_t=m("div",{class:"modal-header"},null,-1),yt=m("div",{class:"modal-body cart-modal",id:"cart-modal"},[m("form",{method:"post",action:"/profile/update/image",id:"ImageUpdate"},[m("div",{id:"preview"}),m("input",{type:"file",id:"fileInput",hidden:""}),m("input",{type:"hidden",id:"imageData",name:"imageData"})])],-1),bt={class:"modal-footer"};function xt(x,u,_,y,k,w){return I(),Y(ue,null,[_t,yt,m("div",bt,[m("button",{onClick:u[0]||(u[0]=(...C)=>x.updateImage&&x.updateImage(...C)),class:"btn btn-info"},"Изменить"),m("button",{onClick:u[1]||(u[1]=(...C)=>x.cancelUpdate&&x.cancelUpdate(...C)),class:"btn btn-danger"},"Отмена")])],64)}const Ct=ye(wt,[["render",xt]]),Et={props:{title:String,text:String},methods:{CloseToast(x){this.$emit("updateToast_view"),$(".toast-container").remove()}}},kt={class:"toast-container"},$t={class:"toast-header"},St={class:"me-auto"},It={class:"toast-body"},Rt=m("div",{class:"toast-footer"},null,-1);function Mt(x,u,_,y,k,w){return I(),Y("div",kt,[m("div",$t,[m("strong",St,q(_.title),1),m("button",{type:"button",class:"btn btn-close m-0 p-2",onClick:u[0]||(u[0]=C=>w.CloseToast(C))})]),m("div",It,q(_.text),1),Rt])}const Lt=ye(Et,[["render",Mt]]),Tt={class:"border border-warning bg-white warning__body"},Ft={__name:"ProfileInfoStatus",setup(x){const u=z(!1),_=z(!1),y=z(""),k=z(""),w=()=>{Me.post(route("verification.verifyEmailSend")).then(function(T){k.value=T.data.message,_.value=!0,console.log(T)}).catch(function(T){console.log(T)})},C=()=>{_.value=!1},L=()=>{u.value=!u.value};return(T,W)=>(I(),Y(ue,null,[_.value?(I(),V(_e,{key:0,to:".main"},[O(Lt,{title:y.value,text:k.value,onUpdateToast_view:C},null,8,["title","text"])])):j("",!0),m("div",{class:"warning__icon"},[m("i",{onClick:L,class:"fa-solid fa-circle-exclamation"})]),re(m("div",Tt,[m("span",{class:""},[Re(" Ваш адресс электронной почты не подтверждён. "),m("a",{onClick:w,class:"text-info warning__email-button"}," Нажмите сюда чтобы подтвердить. ")])],512),[[le,u.value]])],64))}},Pt={class:"row"},Zt={class:"user-settings-info"},Bt={class:"user-settings-info__left-block"},Dt={class:"user-settings-info__load-photo-btn"},Wt=["src"],Ot={class:"user-settings-info__info"},At={class:"user-settings-info__nickname"},Xt={class:"user-settings-info__fullname"},Ht=m("div",{class:"publish-toggle"},[m("a",{href:"/logout",type:"button",class:"bg-light text-dark button-profile-ui exit"},"Выход")],-1),wn={__name:"ProfileInfo",setup(x){const u=z(!1),_=Le("userStore"),y=Te(()=>_.user),k=()=>{$("#fileInput").trigger("click")},w=()=>{$(".modal").hasClass("snow")||($(".modal-content").append("<div>"),u.value=!0,$(".modal").addClass("show"))},C=()=>{u.value=!1};return(L,T)=>(I(),Y(ue,null,[u.value?(I(),V(_e,{key:0,to:".modal-content div"},[O(Ct,{onUpdateviewModalCrop:C})])):j("",!0),m("div",Pt,[m("div",Zt,[m("div",Bt,[m("input",{onChange:w,accept:".jpg,.jpeg,.png,.gif",type:"file",id:"fileInput",autocomplete:"off",style:{display:"none"}},null,32),m("div",{class:"user-settings-info__avatar-settings-wrapper user-settings-info__avatar-settings-wrapper_editable",onClick:k},[m("a",Dt,[m("img",{class:"user-settings-info__avatar-image",src:y.value.img?"/storage/src/profile/"+y.value.img:"/storage/src/profile/plug.png","data-role":"avatar"},null,8,Wt)])])]),m("div",Ot,[m("div",At,q(y.value.nickname),1),m("div",Xt,q(y.value.first_name+" "+y.value.last_name),1)]),L.$page.props.user.email_verified_at==null?(I(),V(Ft,{key:0})):j("",!0),Ht])])],64))}},Yt={class:"personal-info-confirm-container"},zt={class:"input-row__error"},Nt={class:"input-row__error-message"},Ut={class:"input-row"},jt=["type","id","value"],Vt={for:"ir-email",class:"input-row__label"},qt={class:"personal-info-confirm-container__confirm-btn-container"},ae={__name:"ProfileSettingsInput",props:{type:String,type_input:String},setup(x){const u=x,_=z(""),y=z(""),k=z(!1),w=Le("userStore"),C=Te(()=>w.user);switch(u.type){case"email":_.value="Email";break;case"first_name":_.value="Имя";break;case"last_name":_.value="Фамилия";break;case"nickname":_.value="Nickname";break}const L=B=>{k.value=!0,$(B.target).closest(".personal-info-confirm-container").find(".input-row__container").addClass("input-row__container_filled")},T=B=>{B.target.value==""&&$(B.target).closest(".personal-info-confirm-container").find(".input-row__container").removeClass("input-row__container_filled")},W=(B,D)=>{k.value=!1,y.value="",D||$(B.target).closest(".personal-info-confirm-container").find(".input-row__container").removeClass("input-row__container_filled")},N=()=>{y.value="";const B=new FormData;B.append(u.type,$("#ir-"+u.type).val());let D=$("#ir-"+u.type).val();Me.post(route("update",{type:u.type}),B,{headers:{"Content-Type":"multipart/form-data"}}).then(A=>{if(A.data.error=="NotEmail"){y.value="Указана не почта",$("#ir-"+u.type).val(D);return}if(A.data.error=="Uses"){y.value="Данный адресс "+u.type+" занят",$("#ir-"+u.type).val(D);return}if(A.data.error=="LongString"){y.value="Это поле не может быть пустым",$("#ir-"+u.type).val(D);return}w.user[u.type]=$("#ir-"+u.type).val(),k.value=!1}).catch(A=>{y.value="Error updating "+_.value+": "+A,console.log("Error updating "+_.value+": ",A)})};return(B,D)=>(I(),Y("div",Yt,[re(m("div",zt,[m("div",Nt,q(y.value),1)],512),[[le,y.value!=""]]),m("div",Ut,[m("div",{class:ut(["input-row__container",{"input-row__container_filled":C.value[u.type]}])},[m("input",{type:x.type_input,class:"input-row__input",id:"ir-"+u.type,value:C.value[u.type],onFocus:D[0]||(D[0]=A=>L(A)),onBlur:D[1]||(D[1]=A=>T(A))},null,40,jt),m("label",Vt,q(_.value),1)],2)]),re(m("div",qt,[m("button",{class:"personal-info-confirm-container__btn ns-btn btn-info",onClick:N},"Подтвердить"),m("button",{class:"personal-info-confirm-container__btn-cancel ns-btn",onClick:D[2]||(D[2]=A=>W(A,C.value[u.type]))},"Отмена")],512),[[le,k.value]])]))}},Gt={class:"text-center bg-danger p-2"},Kt={class:"text-sm text-white my-auto"},se={__name:"InputError",props:{message:{type:String}},setup(x){return(u,_)=>re((I(),Y("div",Gt,[m("p",Kt,q(x.message),1)],512)),[[le,x.message]])}},Qt={class:"block font-medium text-sm text-gray-700"},Jt={key:0},en={key:1},ve={__name:"InputLabel",props:{value:{type:String}},setup(x){return(u,_)=>(I(),Y("label",Qt,[x.value?(I(),Y("span",Jt,q(x.value),1)):(I(),Y("span",en,[Fe(u.$slots,"default")]))]))}},tn={},nn={class:"btn inline-flex items-center px-4 bg-primary text-white"};function on(x,u){return I(),Y("button",nn,[Fe(x.$slots,"default")])}const rn=ye(tn,[["render",on]]),ge={__name:"TextInput",props:{modelValue:{type:String,required:!0},modelModifiers:{}},emits:["update:modelValue"],setup(x,{expose:u}){const _=ct(x,"modelValue"),y=z(null);return dt(()=>{y.value.hasAttribute("autofocus")&&y.value.focus()}),u({focus:()=>y.value.focus()}),(k,w)=>re((I(),Y("input",{class:"input-row__container","onUpdate:modelValue":w[0]||(w[0]=C=>_.value=C),ref_key:"input",ref:y},null,512)),[[pt,_.value]])}},an={class:"modal-header p-0"},sn=m("h2",{class:"text-lg font-medium text-gray"},"Изменить Пароль",-1),ln={class:"flex items-center gap-4"},un={key:0,class:"text-sm text-gray-600"},cn={__name:"updatePasswordForm",emits:["closeModal"],setup(x,{emit:u}){const _=z(null),y=z(null),k=u,w=mt({current_password:"",password:"",password_confirmation:""}),C=()=>{w.post(route("passwordUpdate"),{preserveScroll:!0,onError:()=>{w.errors.error_code=="passwordIncorrect"&&(w.reset("password","password_confirmation"),_.value.focus()),w.errors.error_code=="oldPassword"&&(w.reset("password","password_confirmation"),_.value.focus()),w.errors.error_code=="PasswordMismatch"&&(w.reset("password_confirmation"),y.value.focus())}})},L=T=>{k("closeModal")};return(T,W)=>(I(),Y("section",null,[m("div",an,[sn,m("button",{type:"button",class:"btn btn-close m-0 p-2",onClick:W[0]||(W[0]=N=>L())})]),m("form",{onSubmit:ht(C,["prevent"]),class:"mt-6 space-y-6"},[Z(w).errors.error_code=="emptyInput"||Z(w).errors.error_code=="oldPassword"?(I(),V(se,{key:0,message:Z(w).errors.error_text,class:"mt-2"},null,8,["message"])):j("",!0),m("div",null,[O(ve,{for:"current_password",value:"Текущий Пароль"}),O(ge,{id:"current_password",ref_key:"currentPasswordInput",ref:y,modelValue:Z(w).current_password,"onUpdate:modelValue":W[1]||(W[1]=N=>Z(w).current_password=N),type:"password",class:"mt-1 block w-full",autocomplete:"current-password"},null,8,["modelValue"]),Z(w).errors.error_code=="passwordIncorrect"?(I(),V(se,{key:0,message:Z(w).errors.error_text,class:"mt-2"},null,8,["message"])):j("",!0)]),m("div",null,[O(ve,{for:"password",value:"Новый Пароль"}),O(ge,{id:"password",ref_key:"passwordInput",ref:_,modelValue:Z(w).password,"onUpdate:modelValue":W[2]||(W[2]=N=>Z(w).password=N),type:"password",class:"mt-1 block w-full",autocomplete:"new-password"},null,8,["modelValue"]),Z(w).errors.error_code=="Passwordmismatch"?(I(),V(se,{key:0,message:Z(w).errors.error_text,class:"mt-2"},null,8,["message"])):j("",!0)]),m("div",null,[O(ve,{for:"password_confirmation",value:"Повторите Пароль"}),O(ge,{id:"password_confirmation",modelValue:Z(w).password_confirmation,"onUpdate:modelValue":W[3]||(W[3]=N=>Z(w).password_confirmation=N),type:"password",class:"mt-1 block w-full",autocomplete:"new-password"},null,8,["modelValue"]),Z(w).errors.error_code=="Passwordmismatch"?(I(),V(se,{key:0,message:Z(w).errors.error_text,class:"mt-2"},null,8,["message"])):j("",!0)]),m("div",ln,[O(rn,{disabled:Z(w).processing},{default:Ie(()=>[Re("Сохранить")]),_:1},8,["disabled"]),O(ft,null,{default:Ie(()=>[Z(w).recentlySuccessful?(I(),Y("p",un,"Пароль сохранён.")):j("",!0)]),_:1})])],32)]))}},dn={class:"row"},pn={class:"settings"},mn={class:"password-setting"},fn={class:"settings__list"},hn={__name:"ProfileSettings",setup(x){const u=z(!1),_=k=>{k.preventDefault(),!$(".modal").hasClass("snow")&&($(".modal-content").append("<div>"),u.value=!0,$(".modal").addClass("show"))},y=()=>{$(".modal").removeClass("show"),$(".modal-content").empty(),u.value=!1};return(k,w)=>(I(),Y(ue,null,[u.value?(I(),V(_e,{key:0,to:".modal-content div"},[O(cn,{onCloseModal:y})])):j("",!0),m("div",dn,[m("div",pn,[m("div",mn,[m("a",{href:"",onClick:w[0]||(w[0]=C=>_(C))},"Сменить Пароль →")]),m("div",fn,[O(ae,{type:"email",type_input:"email"}),O(ae,{type:"first_name",type_input:"text"}),O(ae,{type:"last_name",type_input:"text"}),O(ae,{type:"nickname",type_input:"text"})])])])],64))}},_n=hn;export{_n as P,wn as _,gn as u};