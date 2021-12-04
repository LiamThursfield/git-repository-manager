<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Repositories
            </h1>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <h1 class="font-semibold px-6 text-gray-850">
                Search
                <button
                    class="
                        text-sm text-theme-base-subtle-contrast
                        focus:outline-none focus:text-theme-primary
                        hover:text-theme-primary
                    "
                    @click="setSearchOptions"
                >
                    (Clear)
                </button>
            </h1>

            <!--Search Panel -->
            <div
                class="
                    flex flex-col items-center mt-4 px-6 space-y-4
                    md:flex-row md:space-y-0 md:space-x-8
                "
            >
                <div class="w-full md:w-1/4">
                    <input-group
                        input-autocomplete="repository_name_search"
                        input-class="form-control form-control-short"
                        input-id="repository_name_alias"
                        input-name="repository_name_alias"
                        input-placeholder="Alias/Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Name"
                        v-model="editableSearchOptions.repository_name_alias"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <select-group
                        :label-hidden="true"
                        label-text="Git Provider"
                        :input-any-option-enabled="true"
                        input-any-option-label="Git Provider"
                        input-class="form-control form-control-short"
                        input-id="repository_git_provider"
                        input-name="repository_git_provider"
                        :input-options="gitProviders"
                        v-model="editableSearchOptions.repository_git_provider"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <select-group
                        :label-hidden="true"
                        label-text="Privacy"
                        :input-any-option-enabled="true"
                        input-any-option-label="Privacy"
                        input-class="form-control form-control-short"
                        input-id="repository_is_private"
                        input-name="repository_is_private"
                        :input-options="{
                            '0': 'Public',
                            '1': 'Private',
                        }"
                        v-model="editableSearchOptions.repository_is_private"
                    />
                </div>
            </div>

            <p
                v-if="!repositoriesData"
                class="bg-theme-base-subtle mt-6 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No repositories
            </p>

            <template v-else>
                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table
                        class="table table-hover table-striped w-full"
                    >
                        <thead>
                            <tr>
                                <th class="indicator-column"></th>
                                <th>Alias/Name</th>
                                <th>Privacy</th>
                                <th>URL</th>
                                <th v-if="showActions"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr
                                v-for="(repository, index) in repositoriesData"
                                :key="`repository-${repository.id}`"
                            >
                                <td class="indicator-column">
                                    <component
                                        :is="getRepositoryProviderIcon(repository)"
                                        class="h-4 text-theme-base-subtle-contrast w-4"
                                    />
                                </td>
                                <td>
                                    {{ repository.human_readable_name }}
                                    <br>
                                    <span class="text-sm text-theme-base-subtle-contrast">
                                        {{ repository.alias ? repository.name : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <component
                                        :is="repository.is_private ? 'icon-lock' : 'icon-lock-open'"
                                        class="ml-2 w-4"
                                        :class="repository.is_private ? 'text-theme-danger-contrast' : 'text-theme-success-contrast'"
                                    />
                                </td>
                                <td>
                                    <a
                                        class="hover:text-theme-primary"
                                        aria-label="Repository URL"
                                        :href="repository.html_url"
                                        rel="noopener noreferrer"
                                        target="_blank"
                                    >
                                        {{ repository.html_url }}
                                    </a>
                                </td>
                                <td v-if="showActions">
                                    <div class="flex flex-row items-center justify-end -mx-1">
                                        <inertia-link
                                            v-if="userCanAny(['repositories.edit', 'repositories.view'])"
                                            class="
                                                flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                focus:outline-none focus:ring
                                                hover:bg-theme-info hover:text-theme-info-contrast
                                            "
                                            :href="userCan('repositories.edit') ?
                                                $route('admin.git.repositories.edit', repository.id) :
                                                $route('admin.git.repositories.show', repository.id)
                                            "
                                            title="View Repository"
                                        >
                                            <component
                                                :is="userCan('repositories.edit') ? 'icon-edit' : 'icon-eye'"
                                                class="w-4"
                                            />
                                        </inertia-link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>

            <!-- Pagination -->
            <div
                v-if="showPagination"
                class="flex flex-row justify-center mt-12 px-6"
            >
                <pagination :pagination="repositories.meta.pagination" />
            </div>
        </div>
    </section>
</template>

<script>

    import _ from "lodash";
    import {Inertia} from "@inertiajs/inertia";
    import InputGroup from "@/components/core/forms/InputGroup";
    import IconCheck from "@/components/core/icons/IconCheck";
    import SelectGroup from "@/components/core/forms/SelectGroup";

    export default {
        name: "AdminGitRepositoryIndex",
        components: {
            IconCheck,
            InputGroup,
            SelectGroup,
        },
        layout: 'admin-layout',
        props: {
            gitProviders: Array,
            repositories: Object,
            searchOptions: Array | Object,
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page                    : 15,
                    repository_git_provider     : '',
                    repository_is_private       : '',
                    repository_name_alias       : '',
                },
                isInitialised: false,
            }
        },
        computed: {
            repositoriesData() {
                if (!this.repositories || !this.repositories.data || this.repositories.data.length < 1) {
                    return false;
                }

                return this.repositories.data;
            },
            showActions() {
                return this.userCanAny(['repositories.edit', 'repositories.view']);
            },
            showPagination() {
                try {
                    return this.repositories.meta.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        methods: {
            getRepositoryProviderIcon(repository) {
                try {
                    let map = {
                        'Bitbucket': 'icon-brand-bitbucket',
                        'GitHub': 'icon-brand-github',
                        'GitLab': 'icon-brand-gitlab',
                    };

                    return map[repository.git_provider] ? map[repository.git_provider] : false;
                } catch (e) {
                    return false;
                }
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.repositoriesData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.git.repositories.index'),
                    this.editableSearchOptions,
                    {
                        only: ['repositories'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page                    : 15,
                    repository_git_provider     : '',
                    repository_is_private       : '',
                    repository_name_alias       : '',
                }

                try {
                    // Overwrite the defaults with any new options
                    _.forEach(new_options, (option, key) => {
                        options[key] = option;
                    })
                } catch (e) {
                    console.log(e);
                }

                this.editableSearchOptions = _.cloneDeep(options);
            }
        },
        watch: {
            editableSearchOptions: {
                deep: true,
                handler: 'onSearchOptionsUpdate'
            }
        }
    }
</script>
