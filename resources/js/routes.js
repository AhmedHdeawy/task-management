import Vue from 'vue'
import VueRouter from 'vue-router'
import Projects from "./views/projects/Index"
import Tasks from "./views/tasks/Index"
import Create from "./views/projects/Create";
import Create_Task from "./views/tasks/Create";
import Edit_Task from "./views/tasks/Edit";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'projects',
            component: Projects
        },
        {
            path: '/projects/create',
            name: 'projects',
            component: Create
        },
        {
            path: '/:id/tasks',
            name: 'tasks',
            component: Tasks
        },
        {
            path: '/:id/tasks/create',
            name: 'create_task',
            component: Create_Task
        },
        {
            path: '/tasks/:id/edit',
            name: 'edit_task',
            component: Edit_Task
        },
    ]
});

export default router;
