<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
</head>
<body>

<div id="app">
    <form @submit.prevent="contar">
        <span class="error" v-show="! message">
            Debe escribir algo
        </span>

        <textarea v-model="message"></textarea>

        <button type="submit" v-show="message">
            Submit button
        </button>
    </form>

    <counter heading="likes"></counter>
    <counter heading="Dislikes"></counter>

    <h2> cuenta: @{{ count }}</h2>

    <h2>Skill: @{{ skill }}</h2>
    <input type="text" v-model="points">

    <pre> @{{ $data | json }}</pre>
</div>

<template id="counter-template">
    <h1>@{{heading}}</h1>
    <button @click="count +=1">Increment @{{ count }}</button>
</template>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    Vue.component('counter', {
      template: '#counter-template',
      data: function () {
          return {count: 0};
      },
      props: ['heading']
    });
    new Vue({
        el: 'body',
        data: {
            message: "",
            count: 0,
            points: 150
        },
        computed: {
          skill: function () {
              if (this.points <= 100){
                  return "beginner";
              }

              return "advanced";
          }  
        },
        methods: {
            contar: function () {
                this.count += 1;
            }
        }
    });
</script>

</body>
</html>