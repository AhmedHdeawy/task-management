<template>
    <div>
        <Header />
        <div class="b-example-divider"></div>
        <List />
    </div>


</template>


<script>

import Header from "../../components/Header.vue";
import List from "../../components/project/List.vue"

export default {
    name: "Projects",
    components: {
        Header,
        "List": List
    }

}

</script>

<style>

</style>