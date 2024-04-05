import{o as r,f as h,a as i,u as f,w as n,F as y,Z as x,b as s,e as w,c as l,g as m,i as b,k as $,j as V,d as p}from"./app-d1b51263.js";import{_ as k}from"./AuthenticatedLayout-b705c1d1.js";import{_ as d,a as c,b as u}from"./TextInput-dd6bd5a0.js";import{P as B}from"./PrimaryButton-8581af56.js";import{r as g,m as v,n as q,u as I}from"./index-4a448963.js";import"./ApplicationLogo-29098b52.js";import"./_plugin-vue_export-helper-c27b6911.js";const M={name:{required:g,maxLength:v(60)},quantity:{required:g,numeric:q},description:{required:g,maxLength:v(255)},image:{required:g}},F=s("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"Item",-1),N={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-3"},S={class:"p-4 sm:p-8 bg-white shadow sm:rounded-lg"},U=s("header",null,[s("h2",{class:"text-lg font-medium text-gray-900"},"Add Item"),s("p",{class:"mt-1 text-sm text-gray-600"}," Insert Item Information ")],-1),C={class:"grid grid-cols-3 gap-4"},D={class:"sm:max-w-md"},E={class:"sm:max-w-md"},L={class:"grid grid-cols-3 gap-4"},_={class:"mb-4"},j={class:"sm:max-w-md"},O={class:"flex items-center gap-4"},P={name:"Create",props:["inventory"],data(){return{name:"",description:"",image:"",quantity:"",vx:I()}},methods:{async validate(){return await this.vx.$validate(),this.vx.$errors.length},async storeItem(){await this.validate(),axios.post(this.inventory.id+"/items",new FormData(this.$refs.itemForm)).then(a=>{var e;console.log(a.data),swal({title:"Success!",text:((e=a==null?void 0:a.data)==null?void 0:e.message)||"Operation Successful",icon:"success"}).then(t=>{this.$inertia.visit("/"+this.inventory.id+"/items")})}).catch(a=>{var e,t;console.log(a.response.data),swal({title:"Error!",text:((t=(e=a==null?void 0:a.response)==null?void 0:e.data)==null?void 0:t.message)||"Something went wrong",icon:"error"})})},errorMsg(a){return a.$errors.length?a.$errors[0].$message:!1}},validations(){return{...M}}},J=Object.assign(P,{setup(a){return(e,t)=>(r(),h(y,null,[i(f(x),{title:"Inventory"}),i(k,null,{header:n(()=>[F]),default:n(()=>[s("div",N,[s("div",S,[s("section",null,[U,s("form",{onSubmit:t[5]||(t[5]=w((...o)=>e.storeItem&&e.storeItem(...o),["prevent"])),class:"mt-6 space-y-6",id:"itemForm",ref:"itemForm"},[s("div",C,[s("div",D,[i(d,{for:"name",value:"Name"}),i(c,{name:"name",id:"name",type:"text",class:"mt-1 block w-full",autocomplete:"off",modelValue:e.name,"onUpdate:modelValue":t[0]||(t[0]=o=>e.name=o),onBlur:e.vx.name.$touch},null,8,["modelValue","onBlur"]),e.vx.name.$error?(r(),l(u,{key:0,class:"mt-2",message:e.errorMsg(e.vx.name)},null,8,["message"])):m("",!0)]),s("div",E,[i(d,{for:"quantity",value:"Quantity"}),i(c,{name:"quantity",id:"quantity",type:"text",class:"mt-1 block w-full",autocomplete:"off",modelValue:e.quantity,"onUpdate:modelValue":t[1]||(t[1]=o=>e.quantity=o),onBlur:e.vx.quantity.$touch},null,8,["modelValue","onBlur"]),e.vx.quantity.$error?(r(),l(u,{key:0,class:"mt-2",message:e.errorMsg(e.vx.quantity)},null,8,["message"])):m("",!0)])]),s("div",L,[s("div",_,[i(d,{for:"description",value:"Description"}),b(s("textarea",{name:"description",id:"description",class:"border border-gray-300 rounded px-3 py-2 w-full h-32 focus:outline-none focus:ring focus:border-blue-300",placeholder:"Enter description here","onUpdate:modelValue":t[2]||(t[2]=o=>e.description=o),onBlur:t[3]||(t[3]=(...o)=>e.vx.description.$touch&&e.vx.description.$touch(...o))},null,544),[[$,e.description]]),e.vx.description.$error?(r(),l(u,{key:0,class:"mt-2",message:e.errorMsg(e.vx.description)},null,8,["message"])):m("",!0)]),s("div",j,[i(d,{for:"image",value:"Image"}),i(c,{name:"image",id:"image",type:"file",class:"mt-1 block w-full",autocomplete:"off",modelValue:e.image,"onUpdate:modelValue":t[4]||(t[4]=o=>e.image=o),onBlur:e.vx.name.$touch},null,8,["modelValue","onBlur"]),e.vx.image.$error?(r(),l(u,{key:0,class:"mt-2",message:e.errorMsg(e.vx.image)},null,8,["message"])):m("",!0)])]),s("div",O,[i(f(V),{class:"inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150",href:e.route("items.index",a.inventory.id)},{default:n(()=>[p(" Back ")]),_:1},8,["href"]),i(B,null,{default:n(()=>[p("Save")]),_:1})])],544)])])])]),_:1})],64))}});export{J as default};
