"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[909],{2946:(e,t,r)=>{r.d(t,{S:()=>n});var n={model:{prop:"inputValue"},props:{errorClass:{default:"input-group-error",type:String},errorHideOnInput:{default:!0,type:Boolean},errorMessage:{default:"",type:String},inputAutofocus:{default:!1,type:Boolean},inputClass:{default:"input-group-input",type:String},inputDisabled:{default:!1,type:Boolean},inputId:{required:!0,type:String},inputName:{required:!0,type:String},inputRequired:{default:!1,type:Boolean},inputValue:{default:"",type:String|Number},inputWrapperClass:{default:"",type:String},labelClass:{default:"input-group-label",type:String},labelHidden:{default:!1,type:Boolean},labelText:{required:!0,type:String}},data:function(){return{hideError:!1}},computed:{formattedInputClass:function(){return this.isError?this.inputClass+" error":this.inputClass},formattedLabelClass:function(){var e=this.labelClass;return this.labelHidden&&(e+=" hidden"),e},isError:function(){return!(this.hideError||!this.errorMessage||""===this.errorMessage)}},methods:{autofocus:function(){var e=this;this.inputAutofocus&&this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].focus()}))},blurInput:function(){var e=this;this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].blur()}))},onErrorMessageChange:function(){this.hideError=!1},onInput:function(){this.$emit("input",this.$refs[this.inputId].value),this.errorHideOnInput&&(this.hideError=!0,this.$emit("errorHidden"))},onInputBlur:function(){this.$emit("blur")}},watch:{errorMessage:{handler:"onErrorMessageChange"}}}},5781:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(2946),s=r(1441);const i={name:"InputGroup",mixins:[n.S],components:{FormFieldError:s.Z},props:{inputAutocomplete:{default:"",type:String},inputMax:{default:"",type:String|Number},inputMaxLength:{default:"",type:String|Number},inputMin:{default:"",type:String|Number},inputMinLength:{default:"",type:String|Number},inputPlaceholder:{default:"",type:String},inputType:{default:"text",type:String}},mounted:function(){this.autofocus()}};const a=(0,r(1900).Z)(i,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"flex flex-col"},[r("label",{class:e.formattedLabelClass,attrs:{for:e.inputId}},[e._t("default",(function(){return[r("span",{staticClass:"flex flex-row items-baseline"},[r("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?r("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])]}))],2),e._v(" "),r("div",{class:e.inputWrapperClass},[e._t("inputPrepend"),e._v(" "),r("input",{ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,autocomplete:e.inputAutocomplete,disabled:e.inputDisabled,max:e.inputMax,maxlength:e.inputMaxLength,min:e.inputMin,minlength:e.inputMinLength,name:e.inputName,placeholder:e.inputPlaceholder,required:e.inputRequired,type:e.inputType},domProps:{value:e.inputValue},on:{blur:e.onInputBlur,input:e.onInput,keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput.apply(null,arguments)}}}),e._v(" "),e._t("inputAppend")],2),e._v(" "),r("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},1441:(e,t,r)=>{r.d(t,{Z:()=>s});const n={name:"FormFieldError",props:{errorClass:{required:!0,type:String},errorMessage:{required:!0,type:String},isError:{required:!0,type:Boolean},transitionName:{default:"slide-down-fade",type:String}}};const s=(0,r(1900).Z)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("transition",{attrs:{name:e.transitionName}},[e.isError?r("p",{class:e.errorClass},[e._v("\n            "+e._s(e.errorMessage)+"\n        ")]):e._e()])],1)}),[],!1,null,null,null).exports},909:(e,t,r)=>{r.r(t),r.d(t,{default:()=>s});const n={name:"AuthLogin",components:{InputGroup:r(5781).Z},layout:"auth-layout",data:function(){return{form:{email:"",password:"",remember:null}}},methods:{submit:function(){this.$inertia.post(this.$route("login"),this.form)}}};const s=(0,r(1900).Z)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"auth-card-container"},[r("div",{staticClass:"auth-card"},[r("h1",{staticClass:"auth-header"},[e._v("\n            Welcome back\n        ")]),e._v(" "),r("form",{staticClass:"px-6",on:{submit:function(t){return t.preventDefault(),e.submit.apply(null,arguments)}}},[r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("email"),"input-autocomplete":"email","input-autofocus":!0,"input-class":"auth-input","input-id":"email","input-name":"email","input-required":!0,"input-type":"email","label-text":"Email"},on:{errorHidden:function(t){return e.clearPageErrorMessage("email")}},model:{value:e.form.email,callback:function(t){e.$set(e.form,"email",t)},expression:"form.email"}}),e._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("password"),"input-autocomplete":"current-password","input-class":"auth-input","input-id":"password","input-name":"password","input-required":!0,"input-type":"password","label-text":"Password"},on:{errorHidden:function(t){return e.clearPageErrorMessage("password")}},model:{value:e.form.password,callback:function(t){e.$set(e.form,"password",t)},expression:"form.password"}}),e._v(" "),r("div",{staticClass:"mt-6"},[r("label",{staticClass:"cursor-pointer flex font-medium inline-block items-center text-theme-base-contrast"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.remember,expression:"form.remember"}],staticClass:"\n                            leading-tight mr-2 rounded\n                            focus:outline-none focus:ring focus:ring-primary\n                        ",attrs:{id:"remember",name:"remember",type:"checkbox"},domProps:{checked:Array.isArray(e.form.remember)?e._i(e.form.remember,null)>-1:e.form.remember},on:{change:function(t){var r=e.form.remember,n=t.target,s=!!n.checked;if(Array.isArray(r)){var i=e._i(r,null);n.checked?i<0&&e.$set(e.form,"remember",r.concat([null])):i>-1&&e.$set(e.form,"remember",r.slice(0,i).concat(r.slice(i+1)))}else e.$set(e.form,"remember",s)}}}),e._v(" "),r("span",{staticClass:"select-none text-sm"},[e._v("\n                        Remember Me\n                      ")])])]),e._v(" "),r("div",{staticClass:"flex flex-row items-center justify-between mt-4 py-6"},[r("button",{staticClass:"\n                        bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast\n                        focus:outline-none focus:ring focus:ring-primary\n                        hover:bg-theme-primary-hover hover:shadow-lg\n                        transition-all ease-in-out duration-300\n                    ",attrs:{type:"submit"}},[e._v("\n                    Sign In\n                ")]),e._v(" "),r("inertia-link",{staticClass:"\n                        text-gray-900\n                        hover:text-theme-primary\n                        transition-all ease-in-out duration-300\n                    ",attrs:{href:e.$route("password.request")}},[e._v("\n                    Forgot Password?\n                ")])],1)],1)]),e._v(" "),r("div",{staticClass:"flex justify-end mt-4"},[e.$routeCheck("register")?r("inertia-link",{staticClass:"\n                text-gray-300 text-sm tracking-wide\n                hover:text-theme-base-subtle-contrast\n            ",attrs:{href:e.$route("register")}},[e._v("\n            Create a new account\n        ")]):e._e()],1)])}),[],!1,null,null,null).exports}}]);