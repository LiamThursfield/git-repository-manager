<template>
    <nav
        :key="url"
        class="side-menu"
        :class="{
            'side-menu-open': isMobileSideMenuOpen
        }"
    >
        <!-- Header -->
        <div class="relative">
            <div
                class="
                    absolute flex flex-row items-center justify-start
                    bottom-0 left-0 top-0
                    transition-default transition-colors
                    lg:hidden
                "
            >
                <button
                    class="menu-toggle"
                    type="button"
                    @click="hideMobileSideMenu"
                >
                    <icon-close />
                </button>
            </div>

            <inertia-link
                class="logo"
                :href="$route('admin.index')"
            >
                <logo-light class="mr-2 w-6"/>
                <span>GRM</span>
            </inertia-link>
        </div>

        <div
            v-for="(menuSection, menuSectionKey) in visibleMenu"
            :key="menuSectionKey"
            class="menu-section"
        >
            <p
                v-if="menuSection.showLabel"
                class="menu-subheading"
            >
                {{ menuSection.label }}
            </p>

            <ul class="root-menu">
                <side-menu-item
                    v-for="(menuItem, menuItemKey) in menuSection.children"
                    :key="`${menuSectionKey}.${menuItemKey}`"
                    class="root-menu-item"
                    :menu-item="menuItem"
                    :menu-item-key="`${menuSectionKey}.${menuItemKey}`"
                    :toggled-items="toggledItems"
                    @openItem="onMenuItemOpened"
                    @toggleItem="onMenuItemToggled"
                />
            </ul>

            <div
                v-if="menuSectionKey !== lastMenuSection"
                 class="menu-separator"
            ></div>
        </div>
    </nav>
</template>

<script>

    import _ from 'lodash';
    import SideMenuItem from "./SideMenuItem";

    export default {
        name: "SideMenu",
        components: {SideMenuItem},
        props: {
            url: String,
        },
        data() {
            return {
                menu: {
                    main: {
                        children: {
                            dashboard: {
                                children: false,
                                icon: "icon-home",
                                label: "Dashboard",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: [],
                                route: "admin.index",
                            },
                        },
                        label: "Main",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: [],
                        showLabel: false,
                    },
                    git: {
                        children : {
                            repositories: {
                                activeRoutes: ["admin.git.repositories.index", "admin.git.repositories.edit", "admin.git.repositories.show"],
                                children: false,
                                icon: "icon-sitemap",
                                label: "Repositories",
                                requiresAllPermissions: ["repositories.view"],
                                requiresAnyPermissions: [],
                                route: "admin.git.repositories.index",
                            }
                        },
                        label: "Git",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["repositories.view"],
                        showLabel: true,
                    },
                    settings: {
                        children : {
                            users: {
                                activeRoutes: ["admin.users.index", "admin.users.create", "admin.users.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Users",
                                        requiresAllPermissions: ["users.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.users.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create User",
                                        requiresAllPermissions: ["users.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.users.create",
                                    },
                                },
                                icon: "icon-users",
                                label: "Users",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["users.view", "users.create"],
                                route: false,
                            }
                        },
                        label: "Settings",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["users.view", "users.create"],
                        showLabel: true,
                    },
                },
                mountedItems: {},
                toggledItems: {}
            }
        },
        computed: {
            isMobileSideMenuOpen() {
                return this.$store.getters.isMobileSideMenuOpen;
            },
            lastMenuSection() {
                let keys = Object.keys(this.visibleMenu);
                return keys[keys.length - 1];
            },
            visibleMenu() {
                let visibleMenu = {};

                _.forEach(this.menu, (menuItem, key) => {
                    let item = this.getVisibleMenuWithChildren(menuItem);
                    if (item) {
                        visibleMenu[key] = item;
                    }
                });

                return visibleMenu;
            }
        },
        methods: {
            canViewMenu(menu) {
                // If there is a route, ensure it exists
                if (menu.route && menu.route.length && !this.$routeCheck(menu.route)) {
                    return false;
                }

                return this.userCanAny(menu.requiresAnyPermissions) && this.userCanAll(menu.requiresAllPermissions);
            },
            getVisibleMenuWithChildren(menu) {
                if (!menu) {
                    return false;
                }

                // Ensure the menu is valid and the user has permission to view it
                if (!this.canViewMenu(menu)) {
                    return false;
                }

                // If the menu has no children and the user has permission to view it, then show it
                if (!menu.children) {
                    return menu;
                }

                // Menu has children so only show visible children
                let visibleMenu = _.cloneDeep(menu);
                visibleMenu.children = {};

                _.forEach(menu.children, (child, key) => {
                    child = this.getVisibleMenuWithChildren(child);

                    if (child) {
                        visibleMenu.children[key] = child;
                    }
                });

                return visibleMenu;
            },
            hideMobileSideMenu() {
                this.$store.commit('hideMobileSideMenu');
            },
            onMenuItemOpened(itemKey) {
                this.$set(this.toggledItems, itemKey, true);
            },
            onMenuItemToggled(itemKey) {
                if (this.toggledItems[itemKey]) {
                    this.$set(this.toggledItems, itemKey, false);
                } else {
                    this.$set(this.toggledItems, itemKey, true);
                }
            },
        }
    }
</script>
