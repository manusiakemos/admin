<template>
    <div ref="parentSidebar" id="parentx">
        <vs-sidebar :hidden-background="true"
                    color="primary"
                    class="sidebarx"
                    parent="parentx"
                    spacer
                    static
                    default-index="home"
                    v-model="activeSidebar">
            <div slot="header">
                <vs-row vs-type="flex" vs-justify="center" vs-align="flex-center">
                    <vs-avatar size="70px" :src="user.avatar ? '/images/'+user.avatar : '/images/avatar.png'"/>
                </vs-row>
                <vs-row vs-type="flex" vs-justify="center" vs-align="flex-center">
                    <h4>
                        {{ user.name }}
                    </h4>
                </vs-row>
            </div>

            <vs-sidebar-item :to="{name:'Home'}" index="home" icon="question_answer" class="m-1">
                Home
            </vs-sidebar-item>
            <vs-sidebar-item :to="{name:'Slider'}" index="slider" icon="question_answer" class="m-1">
                Slider
            </vs-sidebar-item>

            <div class="footer-sidebar gradient" slot="footer">
                <vs-row vs-type="flex" vs-justify="center" vs-align="flex-center">
                    <vs-button @click="logout" icon="reply" type="flat" color="info"><span
                        class="text-white text-uppercase">log out</span></vs-button>
                </vs-row>
            </div>

        </vs-sidebar>
    </div>

</template>
