"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[83],{9425:(t,s,e)=>{e.r(s),e.d(s,{default:()=>a});const n={name:"AdminProfileIndex",layout:"admin-layout",props:{auth:Object,profile:Object}};const a=(0,e(1900).Z)(n,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("section",{staticClass:"max-w-5xl mx-auto"},[t.userCan("profile.edit")?e("div",{staticClass:"flex flex-row items-center mb-6"},[e("h1",{staticClass:"font-medium mr-auto text-lg"},[t._v("\n            My Profile\n        ")]),t._v(" "),e("inertia-link",{staticClass:"\n                button button-default-responsive button-primary-subtle\n                flex flex-row items-center\n            ",attrs:{href:t.$route("admin.profile.edit")}},[e("icon-edit",{staticClass:"\n                    w-5\n                    md:mr-2\n                "}),t._v(" "),e("span",{staticClass:"hidden md:inline"},[t._v("\n                Edit Profile\n            ")])],1)],1):t._e(),t._v(" "),e("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[e("div",{staticClass:"block px-6 w-full"},[e("p",[e("span",{staticClass:"block font-semibold text-theme-base-subtle-contrast text-xs"},[t._v("\n                    First Name\n                ")]),t._v("\n                "+t._s(t.profile.first_name)+"\n            ")]),t._v(" "),e("p",{staticClass:"mt-2"},[e("span",{staticClass:"block font-semibold text-theme-base-subtle-contrast text-xs"},[t._v("\n                    Last Name\n                ")]),t._v("\n                "+t._s(t.profile.last_name)+"\n            ")]),t._v(" "),e("p",{staticClass:"mt-2"},[e("span",{staticClass:"block font-semibold text-theme-base-subtle-contrast text-xs"},[t._v("\n                    Email\n                ")]),t._v("\n                "+t._s(t.profile.email)+"\n            ")]),t._v(" "),e("p",{staticClass:"mt-2"},[e("span",{staticClass:"block font-semibold text-theme-base-subtle-contrast text-xs"},[t._v("\n                    GitHub Username\n                ")]),t._v("\n                "+t._s(t.profile.github_username?t.profile.github_username:"-")+"\n            ")])])])])}),[],!1,null,null,null).exports}}]);