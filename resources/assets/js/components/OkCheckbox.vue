<template>
    <div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="all" v-model="all" @change="allClick">
                全选
            </label>
        </div>
        <div class="checkbox" v-for="v in lists">
            <label>
                <input type="checkbox" :name="input_name" :value="v.id" v-model="checks" @change="itemClick()">
                {{ v.name }}
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            input_name: {
                type: String,
                default: 'check'
            },
            lists: {
                type: Array,
                default: function () {
                    return [{'id': 2, 'name': 'iOS'}]
                }
            }
        },
        mounted() {
            for (let value of this.lists) {
                this.ids.push(value.id);
            }
            this.last = this.lists[0].id;
            this.checks.push(this.last)
        },
        data() {
            return {
                all: false,
                checks: [],
                last: '',
                ids: [],
            }
        },
        methods: {
            allClick() {
                this.checks = this.all ? this.ids : [this.last];
            },
            itemClick() {
                let index = this.checks.length - 1;

                if (index > -1) {
                    this.last = this.checks[index];
                }

                if (this.checks.length < 1) {
                    this.checks = [this.last];
                }

                this.all = !(this.checks.length < this.lists.length)
            },
        },
    }
</script>
