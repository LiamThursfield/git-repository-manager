<template>
    <main
        id="admin-layout"
        class="flex min-h-screen"
    >
        <side-menu
            :url="url()"
        />

        <div class="flex flex-1 flex-col max-w-full">
            <top-menu />

            <page-alerts />

            <div class="bg-theme-base flex-1 p-8">
                <slot/>
            </div>
        </div>
    </main>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia'

    import PageAlerts from "../../components/core/alerts/PageAlerts";

    export default {
        name: "AdminLayout",
        components: {
            PageAlerts
        },
        metaInfo() {
            return {
                title: this.metaTitle,
                meta: [
                    {
                        name: 'description',
                        content: this.metaDescription,
                    }
                ]
            }
        },
        computed: {
            metaDescription() {
                return this.getMetaDataField(
                    'description',
                    'Git Repository Manager'
                );
            },
            metaTitle() {
                return this.getMetaDataField(
                    'title',
                    'Git Repository Manager'
                );
            }
        },
        mounted() {
            Inertia.on('success', event => {
                this.hideMobileSideMenu();
            })
        },
        methods: {
            getMetaDataField(slug, fallback = '') {
                try {
                    return this.$page.props.meta[slug] ?? fallback;
                } catch (e) {
                    console.log(e);
                    return fallback;
                }
            },
            url() {
                return location.pathname.substr(1)
            },
            hideMobileSideMenu() {
                if (this.$store.state.isMobileSideMenuOpen) {
                    this.$store.commit('hideMobileSideMenu');
                }
            },
        }
    }
</script>
