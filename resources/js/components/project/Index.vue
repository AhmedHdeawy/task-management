<template>
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold mb-5 text-primary">Projects</h1>
        <div class="col-lg-6 mx-auto mt-5 text-start">
            <div class="mb-2">
                <button type="button" class="btn btn-primary btn-lg">
                    <i class="bi bi-bag-plus-fill"></i>
                    Create Project
                </button>
            </div>
            <table class="table table-bordered table-hover table-primary" v-if="projects.length > 0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Tasks</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects" :key="project.id">
                        <th scope="row"> {{ project.id }} </th>
                        <td> {{ project.name }} </td>
                        <td> {{ project.created_at }} </td>
                        <td> {{ project.tasks_count }} </td>
                        <td>
                            <button type="button" class="btn btn-primary">Tasks</button>
                            <button type="button" class="btn btn-danger">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <Create />
    </div>

</template>
<script>

import Create from "./Create.vue"
export default {
    name: "Projects_List",
    components: {
        Create
    },
    data() {
        return {
            projects: [],
            create: false
        }
    },
    created() {
        this.fetchProjects();
    },
    methods: {
        fetchProjects() {
            axios.get('/api/projects')
                .then(res => {
                    this.projects = res.data.data;
                }).catch((err) => {
                    console.log(err);
                })
        }
    }
}

</script>