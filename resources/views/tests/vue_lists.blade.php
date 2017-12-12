<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prueba listas con Vue.js</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        .completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body>

<div id="app">
    <tasks :list="tasks"></tasks>
</div>

<template id="tasks-template">
    <h1>Mis tareas
        <span v-show="remaining">(@{{ remaining }})</span>
    </h1>
    <ul v-show="list.length">
        <li :class="{completed: task.completed}"
            v-for="task in list"
        @click="task.completed = !task.completed"
        >
        @{{ task.body }}
        <strong @click="deleteTask(task)">X</strong>
        </li>
    </ul>
    <p v-else>No hay tareas todavía</p>
    <button @click="clearCompleted">Clear Completed</button>
</template>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="vue/main.js"></script>

</body>
</html>