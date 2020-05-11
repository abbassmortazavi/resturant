<template>
    <div class="wrapper menu__container">
        <div class="row">
            <div class="col-md-8">
                <card-component>
                    <template slot="title">My Menu Items</template>
                    <template slot="body">
                        <div class="section">
                            <multiselect v-model="menu" :options="categories"></multiselect>
                        </div>
                        <menu-group :items="currentMenuItems"></menu-group>
                    </template>
                </card-component>
            </div>
            <div class="col-md-4">
                <card-component>
                    <template slot="title">Add menu Item</template>
                    <template slot="body">Form Will come to be here</template>
                </card-component>
            </div>
        </div>
    </div>
</template>
<script>
    import _ from 'lodash';
    import MenuGroup from "./MenuGroup";
    import Multiselect from 'vue-multiselect';
export default {
    props:[
        'items'
    ],
    data () {
        return {
            value: null,
            categories: [],
            menu: ''
        }
    },
    components:{
        Multiselect,
        MenuGroup
    },
    created() {
        _.forEach(this.items , (item , key)=>{
            this.categories.push(key);
        });
        this.menu = this.categories[0];
        console.log(this.categories);
    },
    computed:{
        currentMenuItems()
        {
            return this.items[this.menu];
        }
    }

}
</script>
