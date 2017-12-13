<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prueba Vue.js</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        .plan_name {
            font-weight: bold;
            width: 100px;
            display: inline-block;
        }

        .plan_price {
            display: inline-block;
            width: 80px;
        }
    </style>
</head>
<body>

<div id="app">
    <pre> @{{ $data | json }}</pre>
    <div v-for="plan in plans">
        <plan :plan="plan" :active.sync="active"></plan>
    </div>
</div>

<template id="plan-template">
    <div>
        <span class="plan_name">@{{ plan.name }}</span>
        <span class="plan_price">@{{ plan.price }}/month</span>
        <button @click="setActivePlan"
                v-show="plan.name !== active.name"
        >
            @{{ isUpgrade ? "Upgrade" : "Downgrade" }}
        </button>
        <span v-else>
            Current Plan
        </span>
    </div>
</template>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            plans: [
                    {name: 'Enterprise', price: 300},
                    {name: 'Pro', price: 150},
                    {name: 'Personal', price: 50},
                    {name: 'Free', price: 0}
            ],
            active: {}
        },
        components: {
            plan: {
                template: '#plan-template',
                props: ['plan', 'active'],
                computed: {
                    isUpgrade: function () {
                        return (this.plan.price > this.active.price);
                    }
                },
                methods: {
                    setActivePlan: function () {
                        this.active = this.plan;
                    }
                }
            }
        }
    });
</script>

</body>
</html>