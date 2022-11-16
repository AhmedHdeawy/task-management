<template>
    <div>
        <Header />
        <div class="b-example-divider"></div>
        <Projects-List />
    </div>
    

</template>


<script>

import Header from "../components/Header.vue";
import Projects_List from "../components/project/Index.vue"

export default {

    components: {
        Header,
        "Projects-List": Projects_List
    }

}

</script>

<style>

</style>