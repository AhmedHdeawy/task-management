<template>
    <div class="p-5 my-5 container">

        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center my-4">Create Task</h2>
                <p v-if="errors.length">
                    <b class="text-info">Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors" class="text-danger">{{ error }}</li>
                    </ul>
                </p>

                <form @submit.prevent="saveTask" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" v-model="name" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="text" class="form-control" v-model="priority" id="priority">
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-primary" @click.prevent="$router.go(-1)">Back</button>
                    </div>

                </form>
            </div>
        </div>

        
    </div>

</template>
<script>

export default {
    name: "Create_Task",
    data() {
        return {
            errors: [],
            projects: [],
            name: null,
            priority: null,
            project_id: null,
        }
    },
    created() {
        this.project_id = this.$route.params.id;
    },
    methods: {
        saveTask() {
            axios.post('/api/tasks', {
                name: this.name,
                priority: this.priority,
                project_id: this.project_id,
            })
                .then(res => {
                    this.$router.go(-1);
                }).catch(error => {
                    Object.keys(error.response.data.errors).forEach(key => {
                        this.errors.push(error.response.data.errors[key]);
                    });
                })
        }
    }
}

</script>