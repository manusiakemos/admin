<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3" v-for="v in 4">
                        <vs-card>
                            <h4>100</h4>
                            <p>lorem ipsum dolor sit amet</p>
                        </vs-card>
                    </div>
                </div>
                <vs-card class="mt-1">
                    <chart></chart>
                </vs-card>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from "../components/Chart";
    export default {
        components:{
            Chart
        }
    }
</script>
