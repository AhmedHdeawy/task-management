<template>
    <div class="p-5 my-5 container">

        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center my-4">Create Project</h2>

                <p v-if="errors.length">
                    <b class="text-info">Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors" class="text-danger">{{ error }}</li>
                    </ul>
                </p>

                <form @submit.prevent="saveProject" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" v-model="name" id="name" aria-describedby="nameHelp">
                        <div id="nameHelp" class="form-text">Project name must be unique.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-primary" @click.prevent="$router.go(-1)">Back</button>
                </form>
            </div>
        </div>

        
    </div>

</template>
<script>

export default {
    name: "Create",
    data() {
        return {
            errors: [],
            name: ""
        }
    },
    methods: {
        saveProject() {
            axios.post('/api/projects', {
                name: this.name
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