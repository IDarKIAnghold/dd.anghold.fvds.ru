import{o as t,c as d,b as r,w as l,u as c,Z as b,a as s,F as o,q as _,f as n,t as i,i as u}from"./app.BQx0zvW2.js";import{S as p,a as m}from"./swiper-bundle.LUjWoUtn.js";const f=s("title",null,"Главная страница",-1),k={class:"index row"},v={class:"container mb-5"},g=s("div",{class:"fw-bold mb-4 fs-3"},"Каталог",-1),w={class:"catalog-block-menu"},y={class:"catalog-block-menu__name"},S={class:"catalog-block-menu__image"},B=["src"],N={class:"container mb-4"},V=s("div",{class:"fw-bold mb-4 fs-3"},"Классические гитары",-1),z={class:"product-slider-block__image"},$=["src"],J={class:"product-slider-block__name"},O={class:"product-slider-block__price"},P={class:"container mb-4"},C=s("div",{class:"fw-bold mb-4 fs-3"},"Акустические гитары",-1),F={class:"product-slider-block__image"},L=["src"],q={class:"product-slider-block__name"},D={class:"product-slider-block__price"},E={class:"container mb-4"},Z=s("div",{class:"fw-bold mb-4 fs-3"},"Электрогитары",-1),j={class:"product-slider-block__image"},x=["src"],A={class:"product-slider-block__name"},G={class:"product-slider-block__price"},H={class:"container mb-4"},I=s("div",{class:"fw-bold mb-4 fs-3"},"Бас-гитары",-1),K={class:"product-slider-block__image"},M=["src"],Q={class:"product-slider-block__name"},R={class:"product-slider-block__price"},Y={__name:"index",setup(T){return(a,U)=>(t(),d(o,null,[r(c(b),null,{default:l(()=>[f]),_:1}),s("div",k,[s("div",v,[g,s("div",w,[(t(!0),d(o,null,_(a.$page.props.CategoryList,e=>(t(),d(o,null,[(t(!0),d(o,null,_(e.product_type,h=>(t(),n(c(u),{href:"/type/"+h.name,class:"catalog-block-menu__item"},{default:l(()=>[s("div",y,i(h.name__ru),1),s("div",S,[s("picture",null,[s("img",{loading:"lazy",src:"/storage/src/row/type/"+h.name+".png",alt:""},null,8,B)])])]),_:2},1032,["href"]))),256))],64))),256))])]),s("div",N,[V,r(c(m),{spaceBetween:20,slidesPerView:2.3,class:"product-slider-block__list"},{default:l(()=>[(t(!0),d(o,null,_(a.$page.props.classical,e=>(t(),n(c(p),{key:e.id},{default:l(()=>[r(c(u),{href:"/product/"+e.slug,class:"product-slider-block__card"},{default:l(()=>[s("div",z,[s("img",{loading:"lazy",src:"/storage/src/"+JSON.parse(e.img)[0],alt:""},null,8,$)]),s("div",J,i(e.name),1),s("div",O,i(e.price),1)]),_:2},1032,["href"])]),_:2},1024))),128))]),_:1})]),s("div",P,[C,r(c(m),{spaceBetween:20,slidesPerView:2.3,class:"product-slider-block__list"},{default:l(()=>[(t(!0),d(o,null,_(a.$page.props.acoustic,e=>(t(),n(c(p),{key:e.id},{default:l(()=>[r(c(u),{href:"/product/"+e.slug,class:"product-slider-block__card"},{default:l(()=>[s("div",F,[s("img",{loading:"lazy",src:"/storage/src/"+JSON.parse(e.img)[0],alt:""},null,8,L)]),s("div",q,i(e.name),1),s("div",D,i(e.price),1)]),_:2},1032,["href"])]),_:2},1024))),128))]),_:1})]),s("div",E,[Z,r(c(m),{spaceBetween:20,slidesPerView:2.3,class:"product-slider-block__list"},{default:l(()=>[(t(!0),d(o,null,_(a.$page.props.electricguitar,e=>(t(),n(c(p),{key:e.id},{default:l(()=>[r(c(u),{href:"/product/"+e.slug,class:"product-slider-block__card"},{default:l(()=>[s("div",j,[s("img",{loading:"lazy",src:"/storage/src/"+JSON.parse(e.img)[0],alt:""},null,8,x)]),s("div",A,i(e.name),1),s("div",G,i(e.price),1)]),_:2},1032,["href"])]),_:2},1024))),128))]),_:1})]),s("div",H,[I,r(c(m),{spaceBetween:20,slidesPerView:2.3,class:"product-slider-block__list"},{default:l(()=>[(t(!0),d(o,null,_(a.$page.props.basguitar,e=>(t(),n(c(p),{key:e.id},{default:l(()=>[r(c(u),{href:"/product/"+e.slug,class:"product-slider-block__card"},{default:l(()=>[s("div",K,[s("img",{loading:"lazy",src:"/storage/src/"+JSON.parse(e.img)[0],alt:""},null,8,M)]),s("div",Q,i(e.name),1),s("div",R,i(e.price),1)]),_:2},1032,["href"])]),_:2},1024))),128))]),_:1})])])],64))}};export{Y as default};