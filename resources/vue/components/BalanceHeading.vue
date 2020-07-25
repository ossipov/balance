<template>
    <div class="balance-list__heading flex justify-between items-center pr-5" style="margin-bottom: 1.2rem; margin-top: 2.8rem;">
        <h3 class="uppercase tracking-wide text-sm text-gray-500 font-semibold">{{dayTitle}}</h3>
        <MoneyFormatter :value="sum.toString()"></MoneyFormatter>
    </div>
</template>

<script>
    import MoneyFormatter from "./MoneyFormatter";

    export default {
        components: {
            MoneyFormatter
        },
        props: {
            day: String,
            sum: String
        },
        mounted(){
            console.log(this.day)
        },
        computed: {
            dayTitle() {
                let now = new Date()
                let year = now.getFullYear().toString()

                let propsYear = this.day.slice(-4)

                if (propsYear === year) {
                    return this.day.replace(', ' + propsYear, '')
                }
                return this.day
            }
        }
    }
</script>
