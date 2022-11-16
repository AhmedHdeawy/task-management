<template>
    <div class="p-5 my-5 container">

        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center my-4">Update Task</h2>
                
                <div class="alert alert-success" role="alert" v-if="updateDone">
                    Task Updated Successfully
                </div>
                
                <p v-if="errors.length">
                    <b class="text-info">Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors" class="text-danger">{{ error }}</li>
                    </ul>
                </p>

                <form @submit.prevent="updateTask" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" v-model="task.name" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="text" class="form-control" v-model="task.priority" id="priority">
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
    name: "Edit_Task",
    data() {
        return {
            errors: [],
            task: {
                name: null,
                priority: null,
                project_id: null,
            },
            task_id: null,
            updateDone: false
        }
    },
    created() {
        this.fetchTask(this.$route.params.id);
        this.task_id = this.$route.params.id;
    },
    methods: {

        fetchTask(id) {
            axios.get('/api/tasks/' + id)
                .then(res => {
                    this.task = res.data.data;
                }).catch((err) => {
                    console.log(err);
                })
        },

        updateTask() {
            axios.put('/api/tasks/' + this.task_id, this.task)
                .then(res => {
                    this.updateDone = true;
                    setTimeout(() => {
                        this.$router.go(-1);    
                    }, 1500);
                    
                }).catch(error => {
                    Object.keys(error.response.data.errors).forEach(key => {
                        this.errors.push(error.response.data.errors[key]);
                    });
                })
        }
    }
}

</script>