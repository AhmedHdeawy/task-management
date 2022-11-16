<template>
    <div>
        <Header />
        <div class="b-example-divider"></div>
        <router-view></router-view>
    </div>
    

</template>


<script>
import Header from "../components/Header.vue";
export default {
    components: {
        Header
    }
}

</script>

<style>

</style>