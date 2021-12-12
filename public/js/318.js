"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[318],{2946:(e,t,r)=>{r.d(t,{S:()=>a});var a={model:{prop:"inputValue"},props:{errorClass:{default:"input-group-error",type:String},errorHideOnInput:{default:!0,type:Boolean},errorMessage:{default:"",type:String},inputAutofocus:{default:!1,type:Boolean},inputClass:{default:"input-group-input",type:String},inputDisabled:{default:!1,type:Boolean},inputId:{required:!0,type:String},inputName:{required:!0,type:String},inputRequired:{default:!1,type:Boolean},inputValue:{default:"",type:String|Number},inputWrapperClass:{default:"",type:String},labelClass:{default:"input-group-label",type:String},labelHidden:{default:!1,type:Boolean},labelText:{required:!0,type:String}},data:function(){return{hideError:!1}},computed:{formattedInputClass:function(){return this.isError?this.inputClass+" error":this.inputClass},formattedLabelClass:function(){var e=this.labelClass;return this.labelHidden&&(e+=" hidden"),e},isError:function(){return!(this.hideError||!this.errorMessage||""===this.errorMessage)}},methods:{autofocus:function(){var e=this;this.inputAutofocus&&this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].focus()}))},blurInput:function(){var e=this;this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].blur()}))},onErrorMessageChange:function(){this.hideError=!1},onInput:function(){this.$emit("input",this.$refs[this.inputId].value),this.errorHideOnInput&&(this.hideError=!0,this.$emit("errorHidden"))},onInputBlur:function(){this.$emit("blur")}},watch:{errorMessage:{handler:"onErrorMessageChange"}}}},9033:(e,t,r)=>{r.d(t,{Z:()=>u});var a=r(2946),n={props:{inputValue:{default:!1,type:String|Number|Boolean},inputValueFalse:{default:!1,type:String|Number|Boolean},inputValueTrue:{default:!0,type:String|Number|Boolean}},data:function(){return{editableValue:!1}},computed:{isChecked:function(){return this.editableValue===this.inputValueTrue}},mounted:function(){this.editableValue=this.inputValue,this.autofocus()},methods:{onInput:function(){this.$emit("input",this.isChecked?this.inputValueTrue:this.inputValueFalse),this.errorHideOnInput&&(this.hideError=!0)}}},s=r(1441);const i={name:"InlineCheckboxGroup",mixins:[a.S,n],components:{FormFieldError:s.Z},props:{inputClass:{default:"cursor-pointer form-checkbox h-5 mr-2 rounded text-theme-primary w-5 focus:border-theme-primary focus:outline-none focus:ring focus:ring-primary",type:String},labelClass:{default:"cursor-pointer flex-1 font-medium select-none text-theme-base-contrast text-sm tracking-wider",type:String}}};const u=(0,r(1900).Z)(i,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"flex flex-col"},[r("div",{staticClass:"flex flex-row"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.editableValue,expression:"editableValue"}],ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,disabled:e.inputDisabled,"false-value":e.inputValueFalse,name:e.inputName,required:e.inputRequired,"true-value":e.inputValueTrue,type:"checkbox"},domProps:{checked:Array.isArray(e.editableValue)?e._i(e.editableValue,null)>-1:e._q(e.editableValue,e.inputValueTrue)},on:{change:[function(t){var r=e.editableValue,a=t.target,n=a.checked?e.inputValueTrue:e.inputValueFalse;if(Array.isArray(r)){var s=e._i(r,null);a.checked?s<0&&(e.editableValue=r.concat([null])):s>-1&&(e.editableValue=r.slice(0,s).concat(r.slice(s+1)))}else e.editableValue=n},e.onInput],keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput.apply(null,arguments)}}}),e._v(" "),r("label",{class:e.labelClass,attrs:{for:e.inputId}},[r("span",{staticClass:"flex flex-row items-baseline"},[r("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?r("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])])]),e._v(" "),r("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},5781:(e,t,r)=>{r.d(t,{Z:()=>i});var a=r(2946),n=r(1441);const s={name:"InputGroup",mixins:[a.S],components:{FormFieldError:n.Z},props:{inputAutocomplete:{default:"",type:String},inputMax:{default:"",type:String|Number},inputMaxLength:{default:"",type:String|Number},inputMin:{default:"",type:String|Number},inputMinLength:{default:"",type:String|Number},inputPlaceholder:{default:"",type:String},inputType:{default:"text",type:String}},mounted:function(){this.autofocus()}};const i=(0,r(1900).Z)(s,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"flex flex-col"},[r("label",{class:e.formattedLabelClass,attrs:{for:e.inputId}},[e._t("default",(function(){return[r("span",{staticClass:"flex flex-row items-baseline"},[r("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?r("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])]}))],2),e._v(" "),r("div",{class:e.inputWrapperClass},[e._t("inputPrepend"),e._v(" "),r("input",{ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,autocomplete:e.inputAutocomplete,disabled:e.inputDisabled,max:e.inputMax,maxlength:e.inputMaxLength,min:e.inputMin,minlength:e.inputMinLength,name:e.inputName,placeholder:e.inputPlaceholder,required:e.inputRequired,type:e.inputType},domProps:{value:e.inputValue},on:{blur:e.onInputBlur,input:e.onInput,keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput.apply(null,arguments)}}}),e._v(" "),e._t("inputAppend")],2),e._v(" "),r("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},1441:(e,t,r)=>{r.d(t,{Z:()=>n});const a={name:"FormFieldError",props:{errorClass:{required:!0,type:String},errorMessage:{required:!0,type:String},isError:{required:!0,type:Boolean},transitionName:{default:"slide-down-fade",type:String}}};const n=(0,r(1900).Z)(a,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("transition",{attrs:{name:e.transitionName}},[e.isError?r("p",{class:e.errorClass},[e._v("\n            "+e._s(e.errorMessage)+"\n        ")]):e._e()])],1)}),[],!1,null,null,null).exports},3318:(e,t,r)=>{r.r(t),r.d(t,{default:()=>l});var a=r(6486),n=r.n(a),s=r(9033),i=r(5781);const u={name:"AdminUserEdit",components:{InlineCheckboxGroup:s.Z,InputGroup:i.Z},layout:"admin-layout",props:{selectableRoles:{required:!0,type:Object},user:{required:!0,type:Object}},data:function(){return{formData:null}},computed:{isCurrentUser:function(){try{return this.user.id===this.$page.props.auth.user.id}catch(e){return!1}},isSelectableRoles:function(){try{return Object.keys(this.selectableRoles).length>0}catch(e){return!1}}},created:function(){this.formData={email:this.user.email,first_name:this.user.first_name,github_username:this.user.github_username,last_name:this.user.last_name,roles:this.user.roles},Array.isArray(this.formData.roles)&&(this.formData.roles={}),this.initialiseRoles()},methods:{initialiseRoles:function(){var e=this;n().forEach(this.selectableRoles,(function(t,r){e.formData.roles.hasOwnProperty(r)||(e.formData.roles[r]=!1)}))},submit:function(){this.$inertia.put(this.$route("admin.users.update",this.user.id),this.formData)}}};const l=(0,r(1900).Z)(u,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("form",{staticClass:"max-w-5xl mx-auto",attrs:{autocomplete:"off"},on:{submit:function(t){return t.preventDefault(),e.submit.apply(null,arguments)}}},[e.userCan("users.edit")?r("div",{staticClass:"flex flex-row items-center mb-6"},[r("h1",{staticClass:"font-medium mr-auto text-lg"},[e._v("\n            Edit User\n            "),r("span",{staticClass:"ml-2 opacity-75 text-sm"},[e._v("\n                "+e._s(e.user.name)+"\n            ")])]),e._v(" "),e.userCan("users.view")?r("inertia-link",{staticClass:"\n                button button-default-responsive button-primary-subtle\n                flex flex-row items-center mr-2\n            ",attrs:{href:e.$route("admin.users.index")}},[r("icon-chevron-left",{staticClass:"w-5 md:mr-2"}),e._v(" "),r("span",{staticClass:"hidden md:inline"},[e._v("\n                Back\n            ")])],1):e._e(),e._v(" "),r("button",{staticClass:"\n                button button-default-responsive button-primary\n                flex flex-row items-center\n            ",attrs:{type:"submit"}},[r("icon-save",{staticClass:"\n                    w-5\n                    md:mr-2\n                "}),e._v(" "),r("span",{staticClass:"hidden md:inline"},[e._v("\n                Save Changes\n            ")])],1)],1):e._e(),e._v(" "),r("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[r("div",{staticClass:"block px-6 w-full"},[r("input-group",{attrs:{"error-message":e.getPageErrorMessage("first_name"),"input-autocomplete":"off","input-autofocus":!0,"input-id":"first_name","input-name":"first_name","input-required":!0,"input-type":"text","label-text":"First Name"},on:{errorHidden:function(t){return e.clearPageErrorMessage("first_name")}},model:{value:e.formData.first_name,callback:function(t){e.$set(e.formData,"first_name",t)},expression:"formData.first_name"}}),e._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("last_name"),"input-autocomplete":"off","input-id":"last_name","input-name":"last_name","input-required":!0,"input-type":"text","label-text":"Last Name"},on:{errorHidden:function(t){return e.clearPageErrorMessage("last_name")}},model:{value:e.formData.last_name,callback:function(t){e.$set(e.formData,"last_name",t)},expression:"formData.last_name"}}),e._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("email"),"input-autocomplete":"off","input-id":"email","input-name":"email","input-required":!0,"input-type":"email","label-text":"Email"},on:{errorHidden:function(t){return e.clearPageErrorMessage("email")}},model:{value:e.formData.email,callback:function(t){e.$set(e.formData,"email",t)},expression:"formData.email"}}),e._v(" "),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("github_username"),"input-autocomplete":"off","input-id":"github_username","input-name":"github_username","input-required":!0,"input-type":"github_username","label-text":"GitHub Username"},on:{errorHidden:function(t){return e.clearPageErrorMessage("github_username")}},model:{value:e.formData.github_username,callback:function(t){e.$set(e.formData,"github_username",t)},expression:"formData.github_username"}})],1)]),e._v(" "),e.isSelectableRoles?r("div",{staticClass:"bg-white mt-6 py-6 shadow-subtle rounded-lg"},[r("div",{staticClass:"block px-6 w-full"},[r("p",{staticClass:"font-medium mb-4 text-theme-base-contrast tracking-wider"},[e._v("\n                Roles\n            ")]),e._v(" "),r("div",{staticClass:"space-y-3"},e._l(e.selectableRoles,(function(t,a){return r("inline-checkbox-group",{key:"user-role-"+a,attrs:{"input-id":"user-role-"+a,"input-name":"user-role-"+a,"label-text":t},model:{value:e.formData.roles[a],callback:function(t){e.$set(e.formData.roles,a,t)},expression:"formData.roles[role_key]"}})})),1)])]):e._e()])}),[],!1,null,null,null).exports}}]);