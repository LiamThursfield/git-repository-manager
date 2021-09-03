"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[347],{2946:(t,e,r)=>{r.d(e,{S:()=>n});var n={model:{prop:"inputValue"},props:{errorClass:{default:"input-group-error",type:String},errorHideOnInput:{default:!0,type:Boolean},errorMessage:{default:"",type:String},inputAutofocus:{default:!1,type:Boolean},inputClass:{default:"input-group-input",type:String},inputDisabled:{default:!1,type:Boolean},inputId:{required:!0,type:String},inputName:{required:!0,type:String},inputRequired:{default:!1,type:Boolean},inputValue:{default:"",type:String|Number},inputWrapperClass:{default:"",type:String},labelClass:{default:"input-group-label",type:String},labelHidden:{default:!1,type:Boolean},labelText:{required:!0,type:String}},data:function(){return{hideError:!1}},computed:{formattedInputClass:function(){return this.isError?this.inputClass+" error":this.inputClass},formattedLabelClass:function(){var t=this.labelClass;return this.labelHidden&&(t+=" hidden"),t},isError:function(){return!(this.hideError||!this.errorMessage||""===this.errorMessage)}},methods:{autofocus:function(){var t=this;this.inputAutofocus&&this.$refs[this.inputId]&&this.$nextTick((function(){t.$refs[t.inputId].focus()}))},blurInput:function(){var t=this;this.$refs[this.inputId]&&this.$nextTick((function(){t.$refs[t.inputId].blur()}))},onErrorMessageChange:function(){this.hideError=!1},onInput:function(){this.$emit("input",this.$refs[this.inputId].value),this.errorHideOnInput&&(this.hideError=!0,this.$emit("errorHidden"))},onInputBlur:function(){this.$emit("blur")}},watch:{errorMessage:{handler:"onErrorMessageChange"}}}},3349:(t,e,r)=>{r.d(e,{Z:()=>i});var n=r(2946),a=r(1147);const s={name:"InputGroup",mixins:[n.S],components:{FormFieldError:a.Z},props:{inputAutocomplete:{default:"",type:String},inputMax:{default:"",type:String|Number},inputMaxLength:{default:"",type:String|Number},inputMin:{default:"",type:String|Number},inputMinLength:{default:"",type:String|Number},inputPlaceholder:{default:"",type:String},inputType:{default:"text",type:String}},mounted:function(){this.autofocus()}};const i=(0,r(1900).Z)(s,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"flex flex-col"},[r("label",{class:t.formattedLabelClass,attrs:{for:t.inputId}},[t._t("default",(function(){return[r("span",{staticClass:"flex flex-row items-baseline"},[r("span",[t._v(t._s(t.labelText))]),t._v(" "),t.inputRequired?r("sup",{staticClass:"text-theme-danger-contrast"},[t._v("\n                    *\n                ")]):t._e()])]}))],2),t._v(" "),r("div",{class:t.inputWrapperClass},[t._t("inputPrepend"),t._v(" "),r("input",{ref:t.inputId,class:t.formattedInputClass,attrs:{id:t.inputId,autocomplete:t.inputAutocomplete,disabled:t.inputDisabled,max:t.inputMax,maxlength:t.inputMaxLength,min:t.inputMin,minlength:t.inputMinLength,name:t.inputName,placeholder:t.inputPlaceholder,required:t.inputRequired,type:t.inputType},domProps:{value:t.inputValue},on:{blur:t.onInputBlur,input:t.onInput,keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"esc",27,e.key,["Esc","Escape"])?null:t.blurInput.apply(null,arguments)}}}),t._v(" "),t._t("inputAppend")],2),t._v(" "),r("form-field-error",{attrs:{"error-class":t.errorClass,"error-message":t.errorMessage,"is-error":t.isError}})],1)}),[],!1,null,null,null).exports},1147:(t,e,r)=>{r.d(e,{Z:()=>a});const n={name:"FormFieldError",props:{errorClass:{required:!0,type:String},errorMessage:{required:!0,type:String},isError:{required:!0,type:Boolean},transitionName:{default:"slide-down-fade",type:String}}};const a=(0,r(1900).Z)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:t.transitionName}},[t.isError?r("p",{class:t.errorClass},[t._v("\n            "+t._s(t.errorMessage)+"\n        ")]):t._e()])],1)}),[],!1,null,null,null).exports},5347:(t,e,r)=>{r.r(e),r.d(e,{default:()=>a});const n={name:"AuthRegister",components:{InputGroup:r(3349).Z},layout:"auth-layout",data:function(){return{form:{email:"",first_name:"",last_name:"",password:"",password_confirmation:""}}},methods:{submit:function(){this.$inertia.post(this.$route("register"),this.form)}}};const a=(0,r(1900).Z)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"auth-card-container"},[r("div",{staticClass:"auth-card"},[r("h1",{staticClass:"auth-header"},[t._v("\n            Welcome\n        ")]),t._v(" "),r("form",{staticClass:"px-6",on:{submit:function(e){return e.preventDefault(),t.submit.apply(null,arguments)}}},[r("div",{staticClass:"\n                    flex flex-col\n                    md:flex-row md:space-x-2\n                "},[r("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("first_name"),"input-autocomplete":"given-name","input-autofocus":!0,"input-class":"auth-input","input-id":"first_name","input-name":"first_name","input-required":!0,"input-type":"first_name","label-text":"First Name"},on:{errorHidden:function(e){return t.clearPageErrorMessage("first_name")}},model:{value:t.form.first_name,callback:function(e){t.$set(t.form,"first_name",e)},expression:"form.first_name"}}),t._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("last_name"),"input-autocomplete":"family-name","input-class":"auth-input","input-id":"last_name","input-name":"last_name","input-required":!0,"input-type":"last_name","label-text":"Last Name"},on:{errorHidden:function(e){return t.clearPageErrorMessage("last_name")}},model:{value:t.form.last_name,callback:function(e){t.$set(t.form,"last_name",e)},expression:"form.last_name"}})],1),t._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("email"),"input-autocomplete":"email","input-class":"auth-input","input-id":"email","input-name":"email","input-required":!0,"input-type":"email","label-text":"Email"},on:{errorHidden:function(e){return t.clearPageErrorMessage("email")}},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}}),t._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("password"),"input-autocomplete":"new-password","input-class":"auth-input","input-id":"password","input-name":"password","input-required":!0,"input-type":"password","label-text":"Password"},on:{errorHidden:function(e){return t.clearPageErrorMessage("password")}},model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}}),t._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("password_confirmation"),"input-autocomplete":"new-password","input-class":"auth-input","input-id":"password_confirmation","input-name":"password_confirmation","input-required":!0,"input-type":"password","label-text":"Confirm Password"},on:{errorHidden:function(e){return t.clearPageErrorMessage("password_confirmation")}},model:{value:t.form.password_confirmation,callback:function(e){t.$set(t.form,"password_confirmation",e)},expression:"form.password_confirmation"}}),t._v(" "),r("div",{staticClass:"flex flex-row items-center justify-between mt-4 py-6"},[r("button",{staticClass:"\n                        bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast\n                        focus:outline-none focus:ring focus:ring-primary\n                        hover:bg-theme-primary-hover hover:shadow-lg\n                        transition-all ease-in-out duration-300\n                    ",attrs:{type:"submit"}},[t._v("\n                    Register\n                ")]),t._v(" "),r("inertia-link",{staticClass:"\n                        text-gray-900\n                        hover:text-theme-primary\n                        transition-all ease-in-out duration-300\n                    ",attrs:{href:t.$route("login")}},[t._v("\n                    Already registered?\n                ")])],1)],1)])])}),[],!1,null,null,null).exports}}]);