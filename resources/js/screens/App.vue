<template>
    <div class="main-wrapper d-flex" style="min-height:100vh">
        <sidebar v-show="activeSidebar"></sidebar>
        <main class="mainapp container-fluid" :id="screen_large && activeSidebar ? 'margin-sidebar': 'no-margin'">
            <!--        <main class="mainapp container-fluid">-->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center p-3">
                        <h4 class="font-weight-bold text-dark">{{ $store.state.appName }}</h4>
                        <div class="ml-auto">
                            <router-link class="mr-1" :to="{name:'Profile'}">Profile</router-link>
                            <router-link class="mr-1" :to="{name:'Password'}">Ubah Password</router-link>
                        </div>
                        <div class="ml-4">
                            <a href="#" @click="!activeSidebar ? toggleSidebar(true) : toggleSidebar(false)">

                                <img src="/images/menu.svg"
                                     alt="menu" height="20">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <router-view></router-view>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import Sidebar from "../components/Sidebar";

export default {
    components: {
        Sidebar
    },
    name: "App",
    data: function () {
        return {
            activeItem: 0,
            screen_large: false,
        }
    }
}
</script>

<style scoped>
#margin-sidebar {
    margin-left: 265px;
}
</style>
