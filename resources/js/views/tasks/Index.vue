<template>
    <div v-if="project" class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold mb-5 text-primary"> {{ project.name }} Tasks</h1>

        <div class="col-lg-6 mx-auto mt-5 text-start">
            <div class="alert alert-danger" role="alert" v-if="deleteDone">
                Task Deleted Successfully
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-success btn-lg">
                    <i class="bi bi-bag-plus-fill"></i>
                    <router-link tag="span" :to="{ name: 'create_task', params: { id: project.id } }">Create Task</router-link>
                </button>
            </div>
            <table class="table table-bordered table-hover table-primary" v-if="tasks.length > 0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="task in tasks" :key="task.id">
                        <th scope="row"> {{ task.id }} </th>
                        <td> {{ task.name }} </td>
                        <td> {{ task.created_at }} </td>
                        <td>
                            <button @click.prevent="deleteTask(task.id)" type="button" class="btn btn-danger">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-2">
                <button type="button" class="btn btn-primary btn-lg" @click.prevent="$router.go(-1)">Back To Projects</button>
            </div>
            
        </div>
    </div>
</template>


<script>

export default {
    name: "Tasks",
    data() {
        return {
            tasks: [],
            project: null,
            create: false,
            deleteDone: false
        }
    },
    created() {
        this.fetchTasks(this.$route.params.id);
    },
    methods: {
        fetchTasks(id) {
            axios.get('/api/tasks-by-projects/' + id)
                .then(res => {
                    this.tasks = res.data.data.tasks;
                    this.project = res.data.data.project;
                }).catch((err) => {
                    console.log(err);
                })
        },

        deleteTask(id) {
            var check = confirm("Are you sure ?");
            if (check) {
                axios.delete('/api/tasks/' + id)
                    .then(res => {
                        this.fetchTasks(this.$route.params.id);
                        this.deleteDone = true;
                    }).catch((err) => {
                        console.log(err);
                        this.$router.go()
                    })
            }
        }
    }
}

</script>

<style>

</style>