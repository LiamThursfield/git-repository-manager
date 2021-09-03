<template>
    <main
        id="website-layout"
    >
        <slot />
    </main>
</template>

<script>
    export default {
        name: "WebsiteLayout",
        metaInfo() {
            return {
                title: 'Git Repository Manager',
                meta: [
                    {
                        name: 'description',
                        content: 'Git Repository Manager',
                    }
                ]
            }
        },
    }
</script>
