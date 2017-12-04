<template>
    <div id='example-3'>
        <template v-for="(item, k) in datas">
            <input type="checkbox" id="jack" :value="k" v-model="checked">
            <label for="jack">{{ item }}</label>
        </template>
        <br>
        <span>Checked names: {{ checked }}</span>
    </div>
</template>

<script>
    export default {
        prop:{

        },
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                datas : {
                  'a':'aaa',
                  'b':'bbb',
                  'ccc':'ccc',
                },
                checked : [],
            }
        }
    }
</script>
