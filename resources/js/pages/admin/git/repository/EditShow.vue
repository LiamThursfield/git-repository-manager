<template>
    <section>
        <form
            autocomplete="off"
            @submit.prevent="submit"
        >
            <!-- Header -->
            <div class="flex flex-row items-center mb-6">
                <h1 class="font-medium mr-auto text-lg">
                    {{ isEdit ? 'Edit' : '' }} Repository
                    <span class="ml-2 opacity-75 text-sm">
                        {{ repository.human_readable_name }}
                    </span>
                </h1>

                <inertia-link
                    v-if="userCan('repositories.view')"
                    class="
                        button button-default-responsive button-primary-subtle
                        flex flex-row items-center mr-2
                    "
                    :href="$route('admin.git.repositories.index')"
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

            <!-- Repository Form -->
            <div class="bg-white py-6 shadow-subtle rounded-lg">
                <div class="block px-6 w-full">
                    <input-group
                        :input-disabled="true"
                        input-id="name"
                        input-name="name"
                        input-type="text"
                        label-text="Name"
                        v-model="formData.name"
                    />

                    <input-group
                        class="mt-4"
                        :error-message="getPageErrorMessage('alias')"
                        input-autocomplete="off"
                        :input-autofocus="isEdit"
                        :input-disabled="!isEdit"
                        input-id="alias"
                        input-name="alias"
                        input-type="text"
                        label-text="Alias"
                        @errorHidden="clearPageErrorMessage('alias')"
                        v-model="formData.alias"
                    />

                    <input-group
                        class="mt-4"
                        input-class="border border-theme-base-subtle font-medium px-3 py-2 rounded-l w-full focus:border-theme-primary focus:outline-none focus:ring-0"
                        :input-disabled="true"
                        input-id="git_provider"
                        input-name="git_provider"
                        input-type="text"
                        input-wrapper-class="flex flex-row items-center"
                        label-text="Git Provider"
                        v-model="formData.git_provider"
                    >
                        <template v-slot:inputAppend>
                            <div class="border border-l-0 border-theme-base-subtle px-4 py-2 rounded-l-none rounded-r text-theme-base-subtle-contrast">
                                <component
                                    :is="repositoryProviderIcon"
                                    class="w-5"
                                />
                            </div>
                        </template>
                    </input-group>

                    <input-group
                        class="mt-4"
                        input-class="border border-theme-base-subtle font-medium px-3 py-2 rounded-l w-full focus:border-theme-primary focus:outline-none focus:ring-0"
                        :input-disabled="true"
                        input-id="html_url"
                        input-name="html_url"
                        input-type="text"
                        input-wrapper-class="flex flex-row items-center"
                        label-text="URL"
                        v-model="formData.html_url"
                    >
                        <template v-slot:inputAppend>
                            <a
                                class="
                                    button button-primary-subtle
                                    border border-l-0 border-primary-subtle rounded-l-none
                                "
                                :href="formData.html_url"
                                rel="noopener noreferrer"
                                target="_blank"
                            >
                                <icon-external-link class="w-5 "/>
                            </a>
                        </template>
                    </input-group>
                </div>
            </div>
        </form>
    </section>
</template>

<script>
    import InputGroup from "@/components/core/forms/InputGroup";

    export default {
        name: "AdminGitRepositoryEditShow",
        components: {
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            isEdit: {
                default: false,
                type: Boolean,
            },
            repository: {
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
            repositoryProviderIcon() {
                try {
                    let map = {
                        'Bitbucket': 'icon-brand-bitbucket',
                        'GitHub': 'icon-brand-github',
                        'GitLab': 'icon-brand-gitlab',
                    };

                    return map[this.repository.git_provider] ? map[this.repository.git_provider] : false;
                } catch (e) {
                    return false;
                }
            }
        },
        created() {
            this.formData = {
                alias           : this.repository.alias,
                git_provider    : this.repository.git_provider,
                html_url        : this.repository.html_url,
                is_private      : this.repository.is_private,
                name            : this.repository.name,
            }
        },
        methods: {
            submit() {
                if (!this.userCan('repositories.edit')) {
                    return;
                }

                this.$inertia.put(
                    this.$route('admin.git.repositories.update', this.repository.id),
                    this.formData
                );
            }
        },
    }
</script>
