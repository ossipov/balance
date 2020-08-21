<template>
    <div class="text-right tracking-wide" :class="getClass()">
        {{dollar}}.<span :class="{'text-xs': !total,'text-xl': total}">{{cents}}</span>
    </div>
</template>

<script>
    export default {
        props: {
            value: String,
            total: String
        },
        computed: {
            dollar() {
                let formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                });
                return formatter.format(this.value/100).replace('-','- ').split('.')[0]
            },
            cents() {
                return this.value.slice(-2)
            }
        },
        methods: {
            getClass(){
                return {
                    'text-gray-600': this.value < 1 && !this.total,
                    'text-green-500': this.value > 0 || this.total,
                    'text-lg font-semibold': !this.total,
                    'text-3xl move-up': this.total,
                }
            }
        }
    }
</script>

<style lang="scss">
    .move-up {
        margin-top: -0.4rem;
    }
</style>
