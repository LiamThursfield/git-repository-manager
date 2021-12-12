"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[214],{2946:(t,e,r)=>{r.d(e,{S:()=>n});var n={model:{prop:"inputValue"},props:{errorClass:{default:"input-group-error",type:String},errorHideOnInput:{default:!0,type:Boolean},errorMessage:{default:"",type:String},inputAutofocus:{default:!1,type:Boolean},inputClass:{default:"input-group-input",type:String},inputDisabled:{default:!1,type:Boolean},inputId:{required:!0,type:String},inputName:{required:!0,type:String},inputRequired:{default:!1,type:Boolean},inputValue:{default:"",type:String|Number},inputWrapperClass:{default:"",type:String},labelClass:{default:"input-group-label",type:String},labelHidden:{default:!1,type:Boolean},labelText:{required:!0,type:String}},data:function(){return{hideError:!1}},computed:{formattedInputClass:function(){return this.isError?this.inputClass+" error":this.inputClass},formattedLabelClass:function(){var t=this.labelClass;return this.labelHidden&&(t+=" hidden"),t},isError:function(){return!(this.hideError||!this.errorMessage||""===this.errorMessage)}},methods:{autofocus:function(){var t=this;this.inputAutofocus&&this.$refs[this.inputId]&&this.$nextTick((function(){t.$refs[t.inputId].focus()}))},blurInput:function(){var t=this;this.$refs[this.inputId]&&this.$nextTick((function(){t.$refs[t.inputId].blur()}))},onErrorMessageChange:function(){this.hideError=!1},onInput:function(){this.$emit("input",this.$refs[this.inputId].value),this.errorHideOnInput&&(this.hideError=!0,this.$emit("errorHidden"))},onInputBlur:function(){this.$emit("blur")}},watch:{errorMessage:{handler:"onErrorMessageChange"}}}},5781:(t,e,r)=>{r.d(e,{Z:()=>a});var n=r(2946),i=r(1441);const s={name:"InputGroup",mixins:[n.S],components:{FormFieldError:i.Z},props:{inputAutocomplete:{default:"",type:String},inputMax:{default:"",type:String|Number},inputMaxLength:{default:"",type:String|Number},inputMin:{default:"",type:String|Number},inputMinLength:{default:"",type:String|Number},inputPlaceholder:{default:"",type:String},inputType:{default:"text",type:String}},mounted:function(){this.autofocus()}};const a=(0,r(1900).Z)(s,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"flex flex-col"},[r("label",{class:t.formattedLabelClass,attrs:{for:t.inputId}},[t._t("default",(function(){return[r("span",{staticClass:"flex flex-row items-baseline"},[r("span",[t._v(t._s(t.labelText))]),t._v(" "),t.inputRequired?r("sup",{staticClass:"text-theme-danger-contrast"},[t._v("\n                    *\n                ")]):t._e()])]}))],2),t._v(" "),r("div",{class:t.inputWrapperClass},[t._t("inputPrepend"),t._v(" "),r("input",{ref:t.inputId,class:t.formattedInputClass,attrs:{id:t.inputId,autocomplete:t.inputAutocomplete,disabled:t.inputDisabled,max:t.inputMax,maxlength:t.inputMaxLength,min:t.inputMin,minlength:t.inputMinLength,name:t.inputName,placeholder:t.inputPlaceholder,required:t.inputRequired,type:t.inputType},domProps:{value:t.inputValue},on:{blur:t.onInputBlur,input:t.onInput,keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"esc",27,e.key,["Esc","Escape"])?null:t.blurInput.apply(null,arguments)}}}),t._v(" "),t._t("inputAppend")],2),t._v(" "),r("form-field-error",{attrs:{"error-class":t.errorClass,"error-message":t.errorMessage,"is-error":t.isError}})],1)}),[],!1,null,null,null).exports},1441:(t,e,r)=>{r.d(e,{Z:()=>i});const n={name:"FormFieldError",props:{errorClass:{required:!0,type:String},errorMessage:{required:!0,type:String},isError:{required:!0,type:Boolean},transitionName:{default:"slide-down-fade",type:String}}};const i=(0,r(1900).Z)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:t.transitionName}},[t.isError?r("p",{class:t.errorClass},[t._v("\n            "+t._s(t.errorMessage)+"\n        ")]):t._e()])],1)}),[],!1,null,null,null).exports},4214:(t,e,r)=>{r.r(e),r.d(e,{default:()=>i});const n={name:"AuthPasswordEmail",components:{InputGroup:r(5781).Z},layout:"auth-layout",data:function(){return{form:{email:""}}},methods:{submit:function(){this.$inertia.post(this.$route("password.email"),this.form)}}};const i=(0,r(1900).Z)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"auth-card-container"},[r("div",{staticClass:"auth-card"},[r("h1",{staticClass:"auth-header"},[t._v("\n            Password Reset\n        ")]),t._v(" "),t.$page.props.flash.status?r("p",{staticClass:"pb-8 px-6 text-center text-green-700"},[t._v("\n            "+t._s(t.$page.props.flash.status)+"\n        ")]):r("form",{staticClass:"px-6",on:{submit:function(e){return e.preventDefault(),t.submit.apply(null,arguments)}}},[r("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("email"),"input-autocomplete":"email","input-class":"auth-input","input-id":"email","input-name":"email","input-required":!0,"input-type":"email","label-text":"Email"},on:{errorHidden:function(e){return t.clearPageErrorMessage("email")}},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}}),t._v(" "),t._m(0)],1)]),t._v(" "),r("div",{staticClass:"flex justify-between mt-4"},[r("inertia-link",{staticClass:"\n                text-gray-300 text-sm tracking-wide\n                hover:text-theme-base-subtle-contrast\n            ",attrs:{href:t.$route("login")}},[t._v("\n            Login\n        ")]),t._v(" "),t.$routeCheck("register")?r("inertia-link",{staticClass:"\n                text-gray-300 text-sm tracking-wide\n                hover:text-theme-base-subtle-contrast\n            ",attrs:{href:t.$route("register")}},[t._v("\n            Register\n        ")]):t._e()],1)])}),[function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"flex flex-row items-center justify-between mt-4 py-6"},[r("button",{staticClass:"\n                        bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast\n                        focus:outline-none focus:ring focus:ring-primary\n                        hover:bg-theme-primary-hover hover:shadow-lg\n                        transition-all ease-in-out duration-300\n                    ",attrs:{type:"submit"}},[t._v("\n                    Send Password Reset Link\n                ")])])}],!1,null,null,null).exports}}]);