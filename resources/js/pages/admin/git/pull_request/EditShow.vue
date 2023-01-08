<template>
    <section>
        <form
            autocomplete="off"
            @submit.prevent="submit"
        >
            <!-- Header -->
            <div class="flex flex-row items-center mb-6">
                <h1 class="font-medium mr-auto text-lg">
                    {{ isEdit ? 'Edit' : '' }} Pull Request
                </h1>

                <inertia-link
                    v-if="userCan('pull_requests.view')"
                    class="
                        button button-default-responsive button-primary-subtle
                        flex flex-row items-center mr-2
                    "
                    :href="$route('admin.git.pull_requests.index')"
                >
                    <icon-chevron-left
                        class="w-5 md:mr-2"
                    />
                    <span
                        class="hidden md:inline"
                    >
                        Back
                    </span>
                </inertia-link>

                <button
                    v-if="isEdit"
                    class="
                        button button-default-responsive button-primary
                        flex flex-row items-center
                    "
                    type="submit"
                >
                    <icon-save class="w-5 md:mr-2"/>

                    <span class="hidden md:inline">
                        Save Changes
                    </span>
                </button>
            </div>

            <!-- Repository Info -->
            <div class="bg-white py-6 shadow-subtle rounded-lg">
                <div class="block px-6 w-full">
                    <h2 class="font-medium">
                        {{ pullRequest.title }}
                    </h2>

                    <p class="mt-2">
                        {{ pullRequest.body }}
                    </p>
                </div>
            </div>
        </form>
    </section>
</template>

<script>
    import InputGroup from "@/components/core/forms/InputGroup";

    export default {
        name: "AdminGitPullRequestEditShow",
        components: {
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            isEdit: {
                default: false,
                type: Boolean,
            },
            pullRequest: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                formData: null,
            }
        },
        computed: {
        },
        created() {
            this.formData = {
            }
        },
        methods: {
            submit() {
                if (!this.userCan('pull_requests.edit')) {
                    return;
                }

                this.$inertia.put(
                    this.$route('admin.git.pull_requests.update', this.pullRequest.id),
                    this.formData
                );
            }
        },
    }
</script>
