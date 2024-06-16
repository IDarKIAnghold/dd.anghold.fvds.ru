import{r as x,y as S,o as d,c,a as v,w as f,u as p,d as e,F as g,I as j,f as l,j as q,t as i,x as b,Z as V,k as w,n as y,Q as F}from"./app.CqJCRoH7.js";const B=e("title",null,"Корзина",-1),J={class:"cart"},P={key:0,class:"d-flex"},Q={class:"w-75 me-5"},T={key:0,class:"product-widget row"},A={class:"windget-header single-product-widget-header"},E={class:"windget-header__img"},L=["src"],M={class:"widget-header__code"},W={class:"windget-header__title"},Z={class:"windget-header__menu"},G=["onClick"],H=["onClick"],K=e("i",{class:"fa-regular fa-trash-can btn-block"},null,-1),R=[K],U={class:"windget-header__bottom widget-header__bottom-row"},X={class:"count-buttons"},Y={class:"count-buttons__button-wrapper"},tt=["onClick","disabled"],et=e("i",{class:"fa-solid fa-minus"},null,-1),st=[et],ot=["onChange","disabled","value"],at={class:"count-buttons__button-wrapper"},nt=["onClick","disabled"],dt=e("i",{class:"fa-solid fa-plus"},null,-1),ct=[dt],it={key:0,class:"widget-header__cost-per-item"},rt={class:"windget-heager__price widget-header__bottom-row"},lt={class:"price"},ut={key:0,class:"price__prev"},_t={class:"price__current"},ht={class:"windget-header__avails"},vt={style:{"font-size":"14px"}},ft={key:0,class:"product-widget m-2"},pt=e("h5",{class:"m-0 text-center"},"Нет в наличии",-1),gt=[pt],bt={key:0,class:"product-widget row"},wt={class:"windget-header single-product-widget-header"},yt={class:"windget-header__img"},kt=["src"],xt={class:"widget-header__code"},qt={class:"windget-header__title"},Ct={class:"windget-header__menu"},Ft=["onClick"],Ot=["onClick"],zt=e("i",{class:"fa-regular fa-trash-can btn-block"},null,-1),jt=[zt],mt=e("div",{class:"windget-header__bottom widget-header__bottom-row"},null,-1),It={class:"windget-heager__price widget-header__bottom-row"},$t={class:"price"},Dt={key:0,class:"price__prev"},Nt={class:"price__current"},St={class:"windget-header__avails"},Vt={style:{"font-size":"14px"}},Bt={class:"w-25"},Jt={class:"row p-0 sticky-top"},Pt={class:"border-bottom border-secondary p-3"},Qt={class:"btn btn-block w-100 bg-success text-white p-3"},Tt=e("span",{style:{"font-size":"14px"}},"Доступные способы оплаты и время доставки можно выбрать при оформлении заказа",-1),At={class:"d-flex flex-column p-3"},Et={class:"d-flex justify-content-between border-bottom border-secondary pb-2 mb-1"},Lt=e("span",null,"Ваша корзина",-1),Mt={key:0,style:{"font-size":"12px"}},Wt={key:1,style:{"font-size":"12px"}},Zt={key:2,style:{"font-size":"12px"}},Gt={class:"d-flex justify-content-between pb-2 mb-1"},Ht=e("span",null,"Стоимость",-1),Kt={class:"full-price"},Rt={key:1,class:"row"},Ut=e("h5",{class:"text-center"},"Корзина Пуста",-1),Xt=[Ut],te={__name:"cart",props:{products:Object,cart:Object},setup(o){const a=x(!0),_=x(0),k=x(0);x(!1);const r=o,m=S(()=>r.products.some(s=>s.count<=0));function C(s,n){let t=new FormData;t.append("product_id",s),t.append("quantity",n),_.value=0,k.value=0;for(const u of Object.values(r.products))u.count>1&&(_.value+=parseInt(r.cart[u.id].quantity),k.value+=parseInt(u.price)*parseInt(r.cart[u.id].quantity));b.post(route("updateQuantity"),t).then(function(u){a.value=!0})}const O=(s,n)=>{if(a.value==!1)return;let t=new FormData,u=Object.values(r.products).indexOf(s);t.append("product_id",s.id),a.value=!1,r.products.splice(u,1),delete r.cart[s.id],b.post(route("removeFromCart"),t).then(function(h){a.value=!0})},I=(s,n,t)=>{n.quantity<=1||a.value!=!1&&(a.value=!1,n.quantity--,C(s.id,n.quantity))},$=(s,n,t)=>{a.value!=!1&&(n.quantity>=s.count||(a.value=!1,n.quantity++,C(s.id,n.quantity)))},D=(s,n,t)=>{if(a.value!=!1){if(t.target.value<1){t.target.value=n.quantity;return}t.target.value>=s.count&&(t.target.value=s.count),a.value=!1,n.quantity=t.target.value,C(s.id,n.quantity)}},N=()=>{a.value!=!1&&(a.value=!1,b.post(route("clearCart")).then(function(s){a.value=!0,r.cart.length=0,r.products.length=0}))},z=s=>{const n=new FormData;n.append("product_id",s.id),F().props.favorite[s.id]?b.post(route("removeFromFavorite"),n).then(function(t){delete F().props.favorite[s.id]}):b.post(route("addToFavorite"),n).then(function(t){F().props.favorite[s.id]={product_id:s.id}})};for(const s of Object.values(r.products))s.count>1&&(_.value+=parseInt(r.cart[s.id].quantity),k.value+=parseInt(s.price)*parseInt(r.cart[s.id].quantity));return(s,n)=>(d(),c(g,null,[v(p(V),null,{default:f(()=>[B]),_:1}),e("div",J,[o.products.length>0?(d(),c("div",P,[e("div",Q,[e("div",{class:"product-widget row p-3"},[e("span",{onClick:N,class:"text-danger user-select-none pe-auto w-auto",role:"button"},"Очистить корзину")]),(d(!0),c(g,null,j(o.products,(t,u)=>(d(),c(g,null,[t.count>0?(d(),c("div",T,[e("div",A,[e("div",E,[v(p(w),{href:"/product/"+t.slug,class:"widget-header__link"},{default:f(()=>[e("img",{loading:"lazy",src:t.img?"/storage/src/"+JSON.parse(t.img)[0]:"/storage/src/row/no-image.png"},null,8,L)]),_:2},1032,["href"]),e("div",M,i(t.id),1)]),e("div",W,[v(p(w),{href:"/product/"+t.slug,class:"text-decoration-none text-dark"},{default:f(()=>[q(i(t.name),1)]),_:2},1032,["href"])]),e("div",Z,[e("div",{class:"wishlist-button_cart",onClick:h=>z(t)},[e("i",{class:y([s.$page.props.favorite[t.id]?"fa-solid":"fa-regular ","fa-heart"])},null,2)],8,G),e("div",{class:"remove-button",onClick:h=>O(t,o.cart[t.id])},R,8,H)]),e("div",U,[e("div",null,[e("div",X,[e("div",Y,[e("button",{onClick:h=>I(t,o.cart[t.id]),class:y(["count-buttons__button",{"windget-header__bottom__disable":a.value==!1||o.cart[t.id].quantity==1}]),disabled:a.value==!1||o.cart[t.id].quantity==1},st,10,tt)]),e("input",{type:"number",name:"",id:"",step:"1",min:"0",max:"1162",class:y(["count-buttons__input",{"windget-header__bottom__disable":a.value==!1}]),onChange:h=>D(t,o.cart[t.id],h),disabled:a.value==!1,value:o.cart[t.id].quantity},null,42,ot),e("div",at,[e("button",{onClick:h=>$(t,o.cart[t.id]),class:y(["count-buttons__button",{"windget-header__bottom__disable":a.value==!1||o.cart[t.id].quantity==t.count}]),disabled:a.value==!1||o.cart[t.id].quantity==t.count},ct,10,nt)])]),o.cart[t.id].quantity>1?(d(),c("span",it,i(t.price)+" ₽ / шт. ",1)):l("",!0)])]),e("div",rt,[e("div",lt,[t.old_price>0?(d(),c("div",ut,i(t.old_price*o.cart[t.id].quantity),1)):l("",!0),e("div",_t,i(t.price*o.cart[t.id].quantity),1)])]),e("div",ht,[e("div",vt,[e("span",null," В наличии: "+i(t.count),1)])])])])):l("",!0)],64))),256)),m.value?(d(),c("div",ft,gt)):l("",!0),(d(!0),c(g,null,j(o.products,(t,u)=>(d(),c(g,null,[t.count<=0?(d(),c("div",bt,[e("div",wt,[e("div",yt,[v(p(w),{href:"/product/"+t.slug,class:"widget-header__link"},{default:f(()=>[e("img",{loading:"lazy",src:t.img?"/storage/src/"+JSON.parse(t.img)[0]:"/storage/src/row/no-image.png"},null,8,kt)]),_:2},1032,["href"]),e("div",xt,i(t.id),1)]),e("div",qt,[v(p(w),{href:"/product/"+t.slug,class:"text-decoration-none text-dark"},{default:f(()=>[q(i(t.name),1)]),_:2},1032,["href"])]),e("div",Ct,[e("div",{class:"wishlist-button_cart",onClick:h=>z(t)},[e("i",{class:y([s.$page.props.favorite[t.id]?"fa-solid":"fa-regular ","fa-heart"])},null,2)],8,Ft),e("div",{class:"remove-button",onClick:h=>O(t,o.cart[t.id])},jt,8,Ot)]),mt,e("div",It,[e("div",$t,[t.old_price>0?(d(),c("div",Dt,i(t.old_price*o.cart[t.id].quantity),1)):l("",!0),e("div",Nt,i(t.price*o.cart[t.id].quantity),1)])]),e("div",St,[e("div",Vt,[e("span",null," В наличии: "+i(t.count),1)])])])])):l("",!0)],64))),256))]),e("div",Bt,[e("div",Jt,[e("div",Pt,[e("button",Qt,[v(p(w),{href:s.route("orderView"),class:"text-white text-decoration-none"},{default:f(()=>[q("Перейти к оформлению")]),_:1},8,["href"])]),Tt]),e("div",At,[e("div",Et,[Lt,e("span",null,[q(i(_.value)+" ",1),_.value==1?(d(),c("span",Mt,"товар")):l("",!0),_.value>1&&_.value<5?(d(),c("span",Wt,"товара")):l("",!0),_.value>=5?(d(),c("span",Zt,"товаров")):l("",!0)])]),e("div",Gt,[Ht,e("span",Kt,i(k.value),1)])])])])])):l("",!0),o.products.length<1?(d(),c("div",Rt,Xt)):l("",!0)])],64))}};export{te as default};
